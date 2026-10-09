<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCode;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class TwoFactorAuthController extends Controller
{
    public function index()
    {
        $user = User::find('1');
        return view('auth.2fa', compact('user'));
    }

    public function handle2FAOption(Request $request)
    {
        $method = $request->input('method');
        $user = User::find('1');
        switch ($method) {
            case 'email':
                return $this->generateEmailOTP($user);
            case 'phone':
                return $this->generatePhoneOTP($user);
            default:
                return redirect()->back()->withErrors(['Invalid 2FA method']);
        }
    }

    function generatePhoneOTP(User $user)
    {
        $sendtodevice = $user->phone;
        $code = rand(100000, 999999);
        $now = now();
        $verification_type = '1';
        $api_key = env('MOBILE_API_KEY');
        $api_sender = env('MOBILE_API_SENDER');
        $api_link = env('MOBILE_API_LINK');
        UserCode::updateOrCreate([
            'user_id' => auth()->user()->id,
            'code' => $code,
            'verification_request' => $sendtodevice,
            'verification_type' => $verification_type,
            'status' => '1',
        ]);
        $message_template = 'Your OTP for logging into Manish Tiwari CRM OTP is ' . $code . '. Valid for the next 2 min. Do not share with anyone.';
        try {
            $json_request = array(
                'apikey' => $api_key,
                'senderid' => $api_sender,
                'number' => $sendtodevice,
                'message' => $message_template,
                'format' => 'json'
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_link);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_request));
            $result = curl_exec($ch);
            curl_close($ch);
            //dd($result);
            return view('auth.2fa-verify', compact('verification_type', 'sendtodevice', 'code'));
        } catch (Exception $e) {
            info("Error: " . $e->getMessage());
        }
    }

    //Email Otp
    function generateEmailOTP(User $user)
    {
        $sendtoname = $user->name;
        $sendtodevice = $user->email;
        $toname = auth()->user()->name;
        $code = rand(100000, 999999);
        $expirytime = now()->subMinutes(2);
        $verification_type = '2';
        $api_key = env('EMAIL_API_KEY');
        $api_link = env('EMAIL_API_LINK');
        $api_sender_email = env('EMAIL_SENDER_EMAIL');
        $api_sender_name = env('EMAIL_SENDER_NAME');
        UserCode::updateOrCreate([
            'user_id' => auth()->user()->id,
            'code' => $code,
            'verification_request' => $sendtodevice,
            'verification_type' => $verification_type,
            'status' => '1',
        ]);
        $message_subject = 'OTP for your Trust Haven Solution store sign-in';
        $message_template = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <meta name="x-apple-disable-message-reformatting" /> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <meta name="color-scheme" content="light dark" /> <meta name="supported-color-schemes" content="light dark" /> <title>OTP Verification Code</title></head> <body><div style="margin:0;padding:0;"> <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td align="left"> <table border="0" cellpadding="0" cellspacing="0" style="max-width:700px;width:100%;border-collapse:collapse;"> <tr> <td style="padding:20px 0;"><a href="https://www.trusthavensolution.com/" target="_blank" style="display:inline-block;"> <img src="https://trusthavensolution.com/images/logo-png.png" alt="Trust Haven Solution" style="height:60px;width:auto;display:block;"> </a> </td> </tr> <tr> <td style="padding:8px 0 0;font-size:24px;line-height:32px;color:#222;"> <strong>Hi ' . $toname . '!</strong> </td> </tr> <tr> <td style="padding:20px 0 0;font-size:14px;line-height:24px;color:#555;"> Use the following one-time password (OTP) to sign in to your Trust Haven Solution Store account.<br> This OTP will be valid for 2 minutes till <strong>' . $expirytime . '</strong>. </td> </tr> <tr> <td style="padding:20px 0;font-size:28px;line-height:32px;color:#0a3161;"> <strong>' . $code . '</strong> </td> </tr> <tr> <td style="padding:20px 0 0;font-size:14px;line-height:24px;color:#555;"> For further clarifications, please contact <a href="mailto:help@trusthavensolution.com" style="color:#2696eb;text-decoration:none;">help@trusthavensolution.com</a>. </td> </tr> <tr> <td style="padding:20px 0 0;font-size:14px;line-height:24px;color:#555;"> Regards,<br> <strong>Trust Haven Solution Team</strong><br> <a href="https://trusthavensolution.com/" target="_blank" style="color:#2696eb;text-decoration:none;">www.trusthavensolution.com</a> </td> </tr> <tr> <td style="padding:20px 0;"> <hr style="border:0;border-top:3px solid #b41e45;margin:0;"> </td> </tr> <tr> <td style="padding:0px 0;font-size:12px;line-height:22px;color:#333;"> Trust Haven Solution INC, 6915 Jennie Anne Ct, Bakersfield, CA, 93313.<br> Toll free: +1800-235-0122. </td></tr></table></td></tr></table></div></body> </html>';
        try {
            $data = array(
                "sender" => array(
                    "email" => $api_sender_email,
                    "name" => $api_sender_name
                ),
                "to" => array(
                    array(
                        "name" => $sendtoname,
                        "email" => $sendtodevice
                    )
                ),
                "Cc" => array(
                    array(
                        "name" => 'Trust Haven Solution',
                        "email" => 'ankit.cotginanalytics@gmail.com'
                    )
                ),
                "subject" => $message_subject,
                "htmlContent" => $message_template
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_link);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'Api-Key: ' . $api_key;
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            curl_close($ch);
            return view('auth.2fa-verify', compact('verification_type', 'sendtodevice', 'code'));
        } catch (Exception $e) {
            info("Error: " . $e->getMessage());
        }
    }

    // In Case of Resend
    // public function resend(Request $request){
    //     $method = $request->verifimethod;
    //     $user = User::find('1');
    //     switch ($method) {
    //         case 'email':
    //             return $this->generateresendEmailOTP($user);
    //         case 'phone':
    //             return $this->generateresendPhoneOTP($user);
    //         default:
    //         return response()->json(['status' => 'error', 'message' => 'Invalid 2FA method'], 400);
    //     }
    // }

    // function generateresendPhoneOTP(User $user)
    // {
    //     $sendtodevice = $user->phone;
    //     $code = rand(100000, 999999);
    //     $now = now();
    //     $verification_type = '1';
    //     $api_key = env('MOBILE_API_KEY');
    //     $api_sender = env('MOBILE_API_SENDER');
    //     $api_link = env('MOBILE_API_LINK');
    //     UserCode::updateOrCreate([
    //         'user_id' => auth()->user()->id,
    //         'code' => $code,
    //         'verification_request' => $sendtodevice,
    //         'verification_type' => $verification_type,
    //         'status' => '1',
    //     ]);
    //     $message_template = 'Your OTP for logging into Manish Tiwari CRM OTP is '.$code.'. Valid for the next 2 min. Do not share with anyone.';
    //     try {
    //         $json_request = array(
    //             'apikey' => $api_key,
    //             'senderid' => $api_sender,
    //             'number' => $sendtodevice,
    //             'message' => $message_template,
    //             'format' => 'json'
    //         );
    //         $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_URL,$api_link);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_request));
    //         $result = curl_exec($ch);
    //         curl_close($ch);
    //         //dd($result);
    //         return response()->json(['status' => 'success', 'message' => 'Phone OTP sent successfully']);
    //     } catch (Exception $e) {
    //         return response()->json(['status' => 'error', 'message' => 'Failed to send OTP. Please try again.']);
    //     }
    // }

    // //Email Otp
    // function generateresendEmailOTP(User $user)
    // {
    //     $sendtoname = $user->name;
    //     $sendtodevice = $user->email;
    //     $toname = auth()->user()->name;
    //     $code = rand(100000, 999999);
    //     $expirytime = now()->subMinutes(2);
    //     $verification_type = '2';
    //     $api_key = env('EMAIL_API_KEY');
    //     $api_link = env('EMAIL_API_LINK');
    //     $api_sender_email = env('EMAIL_SENDER_EMAIL');
    //     $api_sender_name = env('EMAIL_SENDER_NAME');
    //     UserCode::updateOrCreate([
    //         'user_id' => auth()->user()->id,
    //         'code' => $code,
    //         'verification_request' => $sendtodevice,
    //         'verification_type' => $verification_type,
    //         'status' => '1',
    //     ]);
    //     $message_subject = 'OTP for your Trust Haven Solution store sign-in';
    //     $message_template = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <meta name="x-apple-disable-message-reformatting" /> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> <meta name="color-scheme" content="light dark" /> <meta name="supported-color-schemes" content="light dark" /> <title>OTP Verification Code</title></head> <body><div style="margin:0;padding:0;"> <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td align="left"> <table border="0" cellpadding="0" cellspacing="0" style="max-width:700px;width:100%;border-collapse:collapse;"> <tr> <td style="padding:20px 0;"><a href="https://www.trusthavensolution.com/" target="_blank" style="display:inline-block;"> <img src="https://trusthavensolution.com/images/logo-png.png" alt="Trust Haven Solution" style="height:60px;width:auto;display:block;"> </a> </td> </tr> <tr> <td style="padding:8px 0 0;font-size:24px;line-height:32px;color:#222;"> <strong>Hi '.$toname.'!</strong> </td> </tr> <tr> <td style="padding:20px 0 0;font-size:14px;line-height:24px;color:#555;"> Use the following one-time password (OTP) to sign in to your Trust Haven Solution Store account.<br> This OTP will be valid for 2 minutes till <strong>'.$expirytime.'</strong>. </td> </tr> <tr> <td style="padding:20px 0;font-size:28px;line-height:32px;color:#0a3161;"> <strong>'.$code.'</strong> </td> </tr> <tr> <td style="padding:20px 0 0;font-size:14px;line-height:24px;color:#555;"> For further clarifications, please contact <a href="mailto:help@trusthavensolution.com" style="color:#2696eb;text-decoration:none;">help@trusthavensolution.com</a>. </td> </tr> <tr> <td style="padding:20px 0 0;font-size:14px;line-height:24px;color:#555;"> Regards,<br> <strong>Trust Haven Solution Team</strong><br> <a href="https://trusthavensolution.com/" target="_blank" style="color:#2696eb;text-decoration:none;">www.trusthavensolution.com</a> </td> </tr> <tr> <td style="padding:20px 0;"> <hr style="border:0;border-top:3px solid #b41e45;margin:0;"> </td> </tr> <tr> <td style="padding:0px 0;font-size:12px;line-height:22px;color:#333;"> Trust Haven Solution INC, 6915 Jennie Anne Ct, Bakersfield, CA, 93313.<br> Toll free: +1800-235-0122. </td></tr></table></td></tr></table></div></body> </html>';
    //     try {
    //         $data = array(
    //             "sender" => array(
    //                 "email" => $api_sender_email,
    //                 "name" => $api_sender_name
    //             ),
    //             "to" => array(
    //                 array(
    //                     "name" => $sendtoname,
    //                     "email" => $sendtodevice
    //                 )
    //             ),
    //             "Cc" => array(
    //                 array(
    //                     "name" => 'Trust Haven Solution',
    //                     "email" => 'ankit.cotginanalytics@gmail.com'
    //                 )
    //             ),
    //             "subject" => $message_subject,
    //             "htmlContent" => $message_template
    //         );
    //         $ch = curl_init();
    //         curl_setopt($ch, CURLOPT_URL,$api_link);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //         curl_setopt($ch, CURLOPT_POST, 1);
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    //         $headers = array();
    //         $headers[] = 'Accept: application/json';
    //         $headers[] = 'Api-Key: '.$api_key;
    //         $headers[] = 'Content-Type: application/json';  
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //         $result = curl_exec($ch);
    //         curl_close($ch);
    //         return response()->json(['status' => 'success', 'message' => 'Email OTP sent successfully']);
    //     } catch (Exception $e) {
    //         return response()->json(['status' => 'error', 'message' => 'Failed to send OTP. Please try again.']);
    //     }
    // }


    public function otpverification(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|min:6|max:6',
        ]);
      //  dd(auth()->user());
       // $userId = auth()->user()->id;
        $guard = getGuard();
        $user = Auth::guard($guard)->user();
       //  dd($guard);
        $otpCode = trim($validated['code']);
        $otp = UserCode::where('user_id', $user->id)
            ->where('code', $otpCode)
            ->where('status', '1')
            ->latest()
            ->first();
        if (!$otp) {
            //return redirect()->back()->with('error', 'Invalid OTP code.');
            return response()->json(['status' => 'error', 'message' => 'Invalid OTP code.'], 422);
        } elseif ($otp->updated_at < now()->subMinutes(2)) {
            //return redirect()->back()->with('error', 'OTP has expired. Please request a new one.');
            return response()->json(['status' => 'error', 'message' => 'OTP has expired. Please request a new one.'], 422);
        }
        $otp->update(['status' => '0']);
        //Session::put('user_2fa', $user->id);
        Session::put($guard . '_2fa_verified', $user->id);
        //return redirect()->route('admin.home');
        return response()->json(['status' => 'success', 'message' => 'OTP verified successfully.']);
    }
    
}
