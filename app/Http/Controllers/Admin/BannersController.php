<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Banners;
use Illuminate\Http\Request;
use App\Helpers\Log;

class BannersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:banner-list|banner-create|banner-edit|banner-delete', ['only' => ['index','show']]);
         $this->middleware('permission:banner-create', ['only' => ['create','store']]);
         $this->middleware('permission:banner-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:banner-delete', ['only' => ['destroy']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data['onebanners'] = Banners::where('banner_type', '1')->orderBy('display_order', 'ASC')->get();
        $data['twobanners'] = Banners::where('banner_type', '2')->orderBy('display_order', 'ASC')->get();
        $data['threebanners'] = Banners::where('banner_type', '3')->orderBy('display_order', 'ASC')->get();
        $data['fourbanners'] = Banners::where('banner_type', '4')->orderBy('display_order', 'ASC')->get();
        return view('admin.banners.index', $data); 
    }

    public function create(Request $request){
        if ($request->isMethod('GET')) {
            return view('admin.banners.create');
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(),
                [
                    'btitle' => 'required|max:255',
                    'bimage' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    'bsort' => 'required',
                    'bstatus' => 'required',
                ],
                [
                    'btitle.required' => 'Banner Title must be required',
                    'btitle.max' => 'Banner Title not more then 255 words',
                    'bimage.required' => 'Banner Image must be required',
                    'bimage.mimes' => 'Banner Image must be jpg, png, jpeg, webp format',
                    'bimage.max' => 'Banner Image size must not exceed 1MB',
                    'bsort.required' => 'Banner Display order required',
                    'bstatus.required' => 'Banner Status must be required',
                ]
            );
            if ($validator->passes()){
                $banner = 'banner_'.time().'.'.$request->bimage->extension();  
                $request->bimage->move(public_path('uploads/banner'), $banner);
                $bann = new Banners;
                if($request->hasFile('mimage')){
                    $request->validate([
                        'mimage' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $mobilebanner = 'mobile_'.uniqid().'.'.$request->mimage->extension();  
                    $request->mimage->move(public_path('uploads/banner'), $mobilebanner);
                    $bann->mobile_image = $mobilebanner;
                }
                $bann->title = $request->btitle;
                $bann->redirect_url = $request->burl;
                $bann->description = $request->bdescription;
                $bann->banner_type = $request->btype;
                $bann->display_order = $request->bsort;
                $bann->last_date = $request->last_date;
                $bann->status = $request->bstatus;
                $bann->image = $banner;
                $bann->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Banner', 'New Banner Created', 'Create', $bann);
                //=====logs=====
                return redirect()->route(getRolePrefix().'banners.index')->with('success','Banner has been created successfully.');
            } else {
                return redirect()->route(getRolePrefix().'banners.create')->withInput()->withErrors($validator);
            }
        }
    }

    public function edit($id, Request $request){
        $bann = Banners::find($id);
        if(empty($bann)){
            return redirect()->route(getRolePrefix().'banners.index')->with('error', "Banner Doesn't Exist.");
        }
        return view('admin.banners.edit',compact('bann'));
    }

    public function update($id, Request $request)
    {
        $banner = Banners::find($id);
        if(empty($banner)){
            return redirect()->route(getRolePrefix().'banners.index')->with('error', "Banner Doesn't Exist.");
        }
        $validator = Validator::make($request->all(),
            [
                'btitle' => 'required|max:255',
                'bsort' => 'required',
                'bstatus' => 'required',
            ],
            [
                'btitle.required' => 'Banner Title must be required',
                'btitle.max' => 'Banner Title not more then 255 words',
                'bsort.required' => 'Banner Display order required',
                'bstatus.required' => 'Banner Status must be required',
            ]
        );
        if ($validator->passes()){
            /* for image*/
            if($request->hasFile('bimage')){
                $request->validate([
                    'bimage' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $imageName = 'banner_'.time().'.'.$request->bimage->extension();  
                $request->bimage->move(public_path('uploads/banner'), $imageName);
                $banner->image = $imageName;
            }
            /* for mobile image*/
            if($request->hasFile('mimage')){
                $request->validate([
                    'mimage' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $mobilebanner = 'mobile_'.uniqid().'.'.$request->mimage->extension();  
                $request->mimage->move(public_path('uploads/banner'), $mobilebanner);
                $banner->mobile_image = $mobilebanner;
            }
            /* end image*/
            $banner->title = $request->btitle;
            $banner->description = $request->bdescription;
            $banner->redirect_url = $request->burl;
            $banner->banner_type = $request->btype;
            $banner->display_order = $request->bsort;
            $banner->last_date = $request->last_date;
            $banner->status = $request->bstatus;
            $banner->save();
            //=====logs=====
            $logInstance = new Log();
            $logInstance->addToLog('Banner', 'Banner Updated', 'Update', $banner);
            //=====logs=====
            return redirect()->route(getRolePrefix().'banners.index')->with('success','Banner has been updated successfully.');
        } else {
            return redirect()->route(getRolePrefix().'banners.edit', $id)->withErrors($validator);
        }
    }

    public function status(Request $request) {
        $request->validate([
            'banner_id' => 'required|exists:banners,id',
            'status' => 'required|boolean',
        ]);
        $bann = Banners::find($request->banner_id);
        if (empty($bann)) {
            return response()->json(['message' => "Banner doesn't exist."], 404);
        }
        $bann->status = $request->status;
        $bann->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Banner', 'Banner Status Updated', 'Update', $bann);
        //=====logs=====
        return response()->json(['message' => 'Banner status updated successfully.'], 200);
    }
    

    public function destroy($id) {
        $bannitem = Banners::find($id);
        if(empty($bannitem)){
            return redirect()->route(getRolePrefix().'banners.index')->with('error', "Banner Doesn't Exist.");
        }
        if(!empty($bannitem->image)){
            if (file_exists(public_path('uploads/banner/' . $bannitem->image))) {
                unlink(public_path('uploads/banner/' . $bannitem->image));
            }
        }
        if(!empty($bannitem->mobile_image)){
            if (file_exists(public_path('uploads/banner/' . $bannitem->mobile_image))) {
                unlink(public_path('uploads/banner/' . $bannitem->mobile_image));
            }
        }
        $bannitem->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Banner', 'Banner Deleted', 'Delete', $bannitem);
        //=====logs=====
        return redirect()->route(getRolePrefix().'banners.index')->with('success','Banner deleted successfully.');
    }
}
