<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm(): View
    {
        return view('front.forget-password');
    }

    public function submitForgetPasswordForm(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $resetUrl = route('reset.password.get', $token);
        $api_key          = env('EMAIL_API_KEY');
        $api_sender_email = env('EMAIL_SENDER_EMAIL');
        $api_sender_name  = env('EMAIL_SENDER_NAME');
        $message_subject = 'Reset Password';
        $message_template = '<html> <body style="font-family: Arial, sans-serif;"> <h2>Password Reset Request</h2> <p>Hello,</p> <p>You requested to reset your password. Click the link below to reset it:</p> <p><a href="' . $resetUrl . '" style="background:#0a3161;color:#fff;padding:10px 20px; text-decoration:none;border-radius:5px;">Reset Password</a> </p> <p>If you did not request this, please ignore this email.</p> <br> <p>Regards,<br><strong>realState24world Team</strong></p> </body> </html>';
        $data = [
            "sender" => [
                "email" => $api_sender_email,
                "name"  => $api_sender_name
            ],
            "to" => [
                [
                    "email" => $request->email,
                    "name"  => $request->email
                ]
            ],
            "subject" => $message_subject,
            "htmlContent" => $message_template
        ];
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => "https://api.brevo.com/v3/smtp/email",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "content-type: application/json",
                "api-key: " . $api_key
            ],
        ]);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err) {
            return back()->with('error', 'Email could not be sent. cURL Error: ' . $err);
        }
        return back()->with('message', 'We have e-mailed your password reset link!');
    }



    public function showResetPasswordForm($token): View
    {
        $resetData = DB::table('password_reset_tokens')
        ->where('token', $token)
        ->first();

        if (!$resetData) {
            abort(404, 'Invalid or expired password reset link.');
        }
        return view('front.forgetPasswordLink', ['token' => $token, 'email' => $resetData->email]);
    }


    public function submitResetPasswordForm(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
