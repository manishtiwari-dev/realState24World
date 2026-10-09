<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Category;
use App\Models\Dealer;
use App\Models\Properties;
use App\Models\Enquiry;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{

    public function search(Request $request)
    {
        $query = Properties::query();
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('keyword', 'LIKE', "%{$keyword}%")
                    ->orWhere('address', 'LIKE', "%{$keyword}%")
                    ->orWhere('city', 'LIKE', "%{$keyword}%")
                    ->orWhere('landmark', 'LIKE', "%{$keyword}%")
                    ->orWhere('description', 'LIKE', "%{$keyword}%")
                    ->orWhere('metatitle', 'LIKE', "%{$keyword}%")
                    ->orWhere('metakeyword', 'LIKE', "%{$keyword}%")
                    ->orWhere('metadescription', 'LIKE', "%{$keyword}%");
            });
        }
        if ($request->has('preference') && is_array($request->preference)) {
            $query->whereIn('type', $request->preference);
        }
        switch ($request->sort) {
            case 'price_low':
                $query->orderBy('amount', 'asc');
                break;
            case 'price_high':
                $query->orderBy('amount', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'popularity':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->latest();
        }
        if ($request->filled('budget')) {
            switch ($request->budget) {
                case "0-1Lakh":
                    $query->whereBetween('amount', [0, 100000]);
                    break;
                case "1Lakh-10Lakh":
                    $query->whereBetween('amount', [100000, 1000000]);
                    break;
                case "10Lakh-20Lakh":
                    $query->whereBetween('amount', [1000000, 2000000]);
                    break;
                case "20Lakh-30Lakh":
                    $query->whereBetween('amount', [2000000, 3000000]);
                    break;
                case "30Lakh-40Lakh":
                    $query->whereBetween('amount', [3000000, 4000000]);
                    break;
                case "40Lakh-50Lakh":
                    $query->whereBetween('amount', [4000000, 5000000]);
                    break;
                case "50Lakh-1Crore":
                    $query->whereBetween('amount', [5000000, 10000000]);
                    break;
                case "Above1Crore":
                    $query->where('amount', '>=', 10000000);
                    break;
            }
        }
        if ($request->has('comm_bhk_type') && is_array($request->comm_bhk_type)) {
            $query->whereIn('bedrooms', $request->comm_bhk_type);
        }
        if ($request->filled('min_price')) {
            $query->where('amount', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('amount', '<=', $request->max_price);
        }
        $query->with('dealer');
        $countproperty = $query->count();
        $properties = $query->latest()->paginate(9);
        $categoriesData = Category::orderBy('name', 'ASC')->get();
        $stateData = State::orderBy('name', 'ASC')->get();
        //dd($request->all(), $properties);
        return view('front.property-search', [
            'properties'   => $properties,
            'categoriesData'   => $categoriesData,
            'stateData'   => $stateData,
            'countproperty' => $countproperty,
            'keyword'      => $request->keyword,
            'type'         => $request->type,
            'budget'       => $request->budget,
            'min_price'    => $request->min_price,
            'max_price'    => $request->max_price,
            'preference'   => $request->preference,
            'comm_bhk_type' => $request->comm_bhk_type,
            'memtype_arr'  => $request->memtype_arr,
        ]);
    }

    public function filter_properties(Request $request)
    {
        $keyword   = $request->input('keyword');
        $status    = $request->input('status');
        $cities    = $request->input('cities');
        $category  = $request->input('category');
        $bedrooms  = $request->input('bedrooms');
        $bathrooms = $request->input('bathrooms');
        $floors    = $request->input('floors');
        $elevator  = $request->input('elevator', []);
        $laundry   = $request->input('laundry', []);
        $kitchen   = $request->input('kitchen', []);
        $ac        = $request->input('ac', []);
        $query = Properties::query();
        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%");
        }
        if ($status) {
            $query->where('property_type', $status);
        }
        if ($cities) {
            $query->where('state_id', $cities);
        }
        if ($category) {
            $query->where('type', $category);
        }
        if ($bedrooms) {
            $query->where('bedrooms', $bedrooms);
        }
        if ($bathrooms) {
            $query->where('bathrooms', $bathrooms);
        }
        // if ($floors) {
        //     $query->where('floors', $floors);
        // }
        if (!empty($elevator)) {
            $query->where('elevator', '1');
        }
        if (!empty($laundry)) {
            $query->where('laundry', '1');
        }
        if (!empty($kitchen)) {
            $query->where('kitchen', '1');
        }
        if (!empty($ac)) {
            $query->where('air_conditioning', '1');
        }
        $properties = $query->get();
        $html = view('front.property-filter-data', compact('properties'))->render();
        return response()->json([
            'html' => $html,
        ]);
    }



    public function property(Request $request, $id)
    {
        $data['resultcategories'] = Category::where('slug', $id)->first();
        $data['total_properties'] = Properties::where('category_id', $data['resultcategories']->id)->where('status', 1)->count();
        $data['categoriesData'] = Category::orderBy('name', 'ASC')->get();
        $data['stateData'] = State::orderBy('name', 'ASC')->get();
        $query = Properties::with('dealer')->where('category_id', $data['resultcategories']->id)->where('status', 1);
        switch ($request->sort) {
            case 'price_low':
                $query->orderBy('amount', 'asc');
                break;
            case 'price_high':
                $query->orderBy('amount', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'popularity':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->latest();
        }
        $data['properties'] = $query->paginate(9)->appends($request->query());
        return view('front.property', $data);
    }


    public function property_list(Request $request)
    {
        $data['resultcategories'] = '';
        $data['total_properties'] = Properties::where('status', 1)->count();
        $data['categoriesData'] = Category::orderBy('name', 'ASC')->get();
        $data['stateData'] = State::orderBy('name', 'ASC')->get();
        $query = Properties::with('dealer')->where('status', 1);
        switch ($request->sort) {
            case 'price_low':
                $query->orderBy('amount', 'asc');
                break;
            case 'price_high':
                $query->orderBy('amount', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'popularity':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->latest();
        }
        $data['properties'] = $query->paginate(9)->appends($request->query());
        return view('front.property', $data);
    }

    public function propertyDetail($slug)
    {
        $data['propertiesrow'] = Properties::with('dealer', 'reviews')->where('slug', $slug)->where('status', 1)->first();
        $data['propertiesrow']->increment('views');
        $data['similar_property'] = Properties::with('dealer')->where('status', 1)->where('id', '!=', $data['propertiesrow']->id)->limit(4)->get();
        $data['reviewCount'] = $data['propertiesrow']->reviews->count();
        $data['averageRating'] = round($data['propertiesrow']->reviews->avg('rating'), 1);
        return view('front.property-detail', $data);
    }


    public function enquiry_property(Request $request)
    {
        $agentid = $request->agent_id;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        //   dd($request->all());
        if ($validator->passes()) {
            $enquiry = new Enquiry;
            $enquiry->name = $request->name;
            $enquiry->property_id    = $request->property_id ?? null;
            $enquiry->project_id     = $request->project_id ?: null;
            $enquiry->pg_property_id = $request->pg_property_id ?: null;
            $enquiry->dealer_id      = $agentid ?? null;
            $enquiry->enquiry_type = !empty($agentid) ? 2 : 1;
            $enquiry->phone = $request->phone;
            $enquiry->email = $request->email;
            $enquiry->message = $request->message;
            $enquiry->save();
            // === 📧 Email Sending via API ===
            // try {
            //     $sendtoname = '';
            //     $sendtodevice = '';
            //     $api_key = env('EMAIL_API_KEY');
            //     $api_link = env('EMAIL_API_LINK');
            //     $api_sender_email = env('EMAIL_SENDER_EMAIL');
            //     $api_sender_name = env('EMAIL_SENDER_NAME');
            //     $message_subject = 'Enquiry  from Property.';

            //     // Blade view to HTML
            //     $message_template = '';

            //     $data = [
            //         "sender" => [
            //             "email" => $api_sender_email,
            //             "name" =>  $api_sender_name
            //         ],
            //         "to" => [
            //             [
            //                 "name" => $sendtoname,
            //                 "email" => $sendtodevice
            //             ]
            //         ],
            //         "Cc" => [
            //             [
            //                 "name" => 'Real state',
            //                 "email" => 'manish.cotginanalytics@gmail.com'
            //             ]
            //         ],
            //         "subject" => $message_subject,
            //         "htmlContent" => $message_template
            //     ];

            //     $ch = curl_init();
            //     curl_setopt($ch, CURLOPT_URL, $api_link);
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //     curl_setopt($ch, CURLOPT_POST, 1);
            //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            //     $headers = array();
            //     $headers[] = 'Accept: application/json';
            //     $headers[] = 'Api-Key: ' . $api_key;
            //     $headers[] = 'Content-Type: application/json';
            //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //     $result = curl_exec($ch);
            //     curl_close($ch);
            // } catch (\Exception $e) {
            // } 
            return redirect()->back()->with('success', 'Message has been sent successfully.');
        } else {
            return redirect()->back()->withErrors($validator);
            
        }
    }


    public function property_enquiry(Request $request)
    {
        $dealerId = $request->input('dealerId');
        $dealer   = Dealer::find($dealerId);
        if (!$dealer) {
            return response()->json([
                'id'      => '1',
                'name'    => 'realState24world',
                'image'   => url('images/blank-img.jpg'),
            ]);
        }
        if (!empty($dealer->profile_photo)) {
            $dealerimage = url('uploads/dealer/' . $dealer->profile_photo);
        } else {
            $dealerimage = url('images/blank-img.jpg');
        }
        return response()->json([
            'id'      => $dealer->id,
            'name'    => $dealer->name,
            'image'   => $dealerimage,
        ]);
    }



    public function property_enquiry_form(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'phone'       => 'required|string|min:8|max:15',
            'email'       => 'required|email',
        ]);
        $enquiry = new Enquiry;
        $enquiry->name = $request->name;
        $enquiry->property_id = $request->property_id;
        $agentid = $request->dealer_id;
        $enquiry->dealer_id = $agentid ?? '';
        $enquiry->phone = $request->phone;
        $enquiry->email = $request->email;
        $enquiry->message = $request->message;
        $enquiry->save();
        return response()->json([
            'success' => true,
            'message' => 'Your request has been sent successfully!'
        ]);
    }

    public function review(Request $request)
    {
        $agentid = ($request->agent_id);

        $validator = Validator::make($request->all(), [
            'reviewname' => 'required',
            'rating' => 'required',
            'reviewemail' => 'required',

        ]);
        if ($validator->passes()) {
            $review = new Review;
            $btn_type = $request->btnsubmit;
            $review->name = $request->reviewname;
            $review->property_id = $request->property_id ?? '';
            $review->project_id =  $request->project_id ?? '';
            $review->pg_property_id =  $request->pg_property_id ?? '';

            $review->dealer_id = $agentid ?? '';
            $review->review_type = !empty($agentid) ? 2 : 1;
            $review->rating = $request->rating;
            $review->email = $request->reviewemail;
            $review->comment = $request->comment;
            $review->save();

            if ($agentid) {
                return redirect()->route('agent.detail', ['id' => encode_string($agentid)])->with('success', 'Thank you for your review!');
            } elseif ($request->project_id) {
                return redirect()->route('project.detail', ['id' => encode_string($request->project_id)])->with('success', 'Thank you for your review!');
            } elseif ($request->pg_property_id) {
                return redirect()->route('pg.detail', ['id' => encode_string($request->project_id)])->with('success', 'Thank you for your review!');
            } else {
                return redirect()->route('property.detail', $request->slug)->with('success', 'Thank you for your review!');
            }
        } else {
            if ($agentid) {
                return redirect()->route('agent.detail', ['id' => encode_string($agentid)])->withErrors($validator);
            } elseif ($request->project_id) {
                return redirect()->route('project.detail', ['id' => encode_string($request->project_id)])->withErrors($validator);
            } elseif ($request->pg_property_id) {
                return redirect()->route('pg.detail', ['id' => encode_string($request->project_id)])->withErrors($validator);
            } else {
                return redirect()->route('property.detail', $request->slug)->withErrors($validator);
            }
        }
    }
}
