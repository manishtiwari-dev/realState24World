<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutCorePoint;
use App\Models\AboutPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function update(Request $request)
    {
        // Find the existing Home record by ID
        $aboutlist = About::where('id', 1)->first();
        if ($aboutlist) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'subtitle' => 'required',
                'description' => 'required',

            ]);
            if ($validator->passes()) {
                //UPDATE

                if ($request->hasFile('banner')) {
                    $bannerImage = 'about' . time() . '.' . $request->banner->extension();
                    $request->banner->move(public_path('uploads/about'), $bannerImage);
                    $aboutlist->banner = $bannerImage;
                }

                $aboutlist->title = $request->title;
                $aboutlist->subtitle = $request->subtitle;
                $aboutlist->description = $request->description;
                $aboutlist->alt = $request->alt;
                $aboutlist->meta_title = $request->meta_title;
                $aboutlist->meta_keyword = $request->meta_keyword;
                $aboutlist->meta_description = $request->meta_description;
                $aboutlist->save();


                // Redirect to the home index route with a success message
                return redirect()->route(getRolePrefix().'about.index')->with('success', 'About Page Updated successfully!');
            } else {
                return redirect()->route(getRolePrefix().'about.index')->withErrors($validator)->withInput();
            }
        } else {
            //create
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'subtitle' => 'required',
                'description' => 'required',
                'banner' => 'required|image|mimes:jpg,png,jpeg,webp,svg',
            ]);
            if ($validator->passes()) {
                $res  = new About();
                $bannerImage = 'about' . time() . '.' . $request->banner->extension();
                $request->banner->move(public_path('uploads/about'), $bannerImage);
                $res->banner = $bannerImage;


                $res->title = $request->title;
                $res->subtitle = $request->subtitle;
                $res->description = $request->description;
                $res->alt = $request->alt;
                $res->meta_title = $request->meta_title;
                $res->meta_keyword = $request->meta_keyword;
                $res->meta_description = $request->meta_description;
                $res->save();
                $p_title = $request->point_title;


                // Redirect to the home index route with a success message
                return redirect()->route(getRolePrefix().'about.index')->with('success', 'About Page Created successfully!');
            } else {
                return redirect()->route(getRolePrefix().'about.index')->withErrors($validator)->withInput();
            }
        }
    }

    public function edit_about_page()
    {
        $data['aboutData'] = About::where('id', 1)->first();
        return view('admin.about.index', $data);
    }
}
