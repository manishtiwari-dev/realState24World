<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blogs;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {
        $data['blogs'] = Blogs::all();
        return view('admin.blog.index', $data);
    }

    public function blog_create(Request $request)
    {
        if ($request->method() == 'GET') {
            $data['blogs_tag'] = BlogTag::where('status', 1)->get();

            return view('admin.blog.create', $data);
        }
        if ($request->method() == 'POST') {
            //   dd($request->all());
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'slug' => 'required|unique:blog',
                    'subtitle' => 'required',
                    'description' => 'required',
                    'date' => 'required',
                    'banner' => 'required|image|mimes:jpg,png,jpeg,webp,svg',
                    'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp,svg',
                ]
            );
            if ($validator->passes()) {
                //   dd($request->all());

                $checkslug = Blogs::where('slug', Str::slug($request->slug))->first();
                if ($checkslug) {
                    return redirect()->route(getRolePrefix() . 'blog.create')->with('error', 'Slug Already Exist!')->withInput();
                }
                $res  = new Blogs();
                if ($request->hasFile('multiple_images')) {
                    $request->validate([
                        'multiple_images.*' => 'image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);

                    $uploadedImages = [];

                    foreach ($request->file('multiple_images') as $file) {
                        $imageName = 'banner_' . time() . '_' . uniqid() . '.' . $file->extension();
                        $file->move(public_path('uploads/blog'), $imageName);
                        $uploadedImages[] = $imageName;
                    }

                    $res->multiple_images = json_encode($uploadedImages);
                }

                $bannerImage = 'banner' . time() . '.' . $request->banner->extension();
                $request->banner->move(public_path('uploads/blog'), $bannerImage);
                $res->banner = $bannerImage;

                $thumbnailImage = 'thumbnail' . time() . '.' . $request->thumbnail->extension();
                $request->thumbnail->move(public_path('uploads/blog'), $thumbnailImage);
                $res->thumbnail = $thumbnailImage;
                $btn = $request->btnsubmit;
                $res->title = $request->title;
                $res->author = $request->author;
                $res->slug = Str::slug($request->slug);;
                $res->subtitle = $request->subtitle;
                $res->date = $request->date;
                $res->description = $request->description;
                $res->banner_alt = $request->banner_alt;
                $res->thumbnail_alt = $request->thumbnail_alt;
                $res->status = $request->status;
                $res->is_popular = $request->is_popular;
                $res->display_order = $request->display_order;
                $res->meta_title = $request->meta_title;
                $res->meta_keyword = $request->meta_keyword;
                $res->meta_description = $request->meta_description;
                $res->tag_id = json_encode($request->tag_id);
                $res->save();





                if ($btn == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'blog.create')->with('success', 'Blog Created successfully!');
                } else {
                    // Redirect to the home index route with a success message
                    return redirect()->route(getRolePrefix() . 'blog.index')->with('success', 'Blog Created successfully!');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'blog.create')->withErrors($validator)->withInput();
            }
        }
    }


    public function blog_update(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $blogid = decode_string($id);

            $data['blog'] = Blogs::find($blogid);
            if (empty($data['blog'])) {
                return redirect()->route(getRolePrefix() . 'blog.index')->with('error', "Blog doesn't exist.");
            }

            $data['blogs_tag'] = BlogTag::where('status', 1)->get();


            return view('admin.blog.edit', $data);
        }
        if ($request->method() == 'POST') {
            $blogid = decode_string($id);

            $blog = Blogs::find($blogid);
            if (empty($blog)) {
                return redirect()->route(getRolePrefix() . 'blog.index')->with('error', "Blog doesn't exist.");
            } else {
                $request->validate([
                    'title' => 'required',
                    'slug' => 'required|unique:blog,slug,' . $blog->id . ',id',
                    'subtitle' => 'required',
                    'description' => 'required',
                    'date' => 'required',
                ]);

                if (empty($blog)) {
                    return redirect()->route(getRolePrefix() . 'blog.index')->with('error', "Blog doesn't exist.");
                }


                if ($request->hasFile('thumbnail')) {
                    $thumbnailImage = 'thumbnail' . time() . '.' . $request->thumbnail->extension();
                    $request->thumbnail->move(public_path('uploads/blog'), $thumbnailImage);
                    $blog->thumbnail = $thumbnailImage;
                }

                if ($request->hasFile('banner')) {
                    $bannerImage = 'banner' . time() . '.' . $request->banner->extension();
                    $request->thumbnail->move(public_path('uploads/blog'), $bannerImage);
                    $blog->banner = $bannerImage;
                }



                if ($request->hasFile('multiple_images')) {
                    $request->validate([
                        'multiple_images.*' => 'image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $uploadedImages = [];
                    foreach ($request->file('multiple_images') as $file) {
                        $imageName = 'banner_' . time() . '_' . uniqid() . '.' . $file->extension();
                        $file->move(public_path('uploads/blog'), $imageName);
                        $uploadedImages[] = $imageName;
                    }
                    $existingImages = json_decode($blog->multiple_images, true) ?? [];
                    $allImages = array_merge($existingImages, $uploadedImages);
                    $blog->multiple_images = json_encode($allImages);
                }



                $btn = $request->btnsubmit;
                $blog->author = $request->author;
                $blog->title = $request->title;
                $blog->slug = Str::slug($request->slug);
                $blog->subtitle = $request->subtitle;
                $blog->date = $request->date;
                $blog->description = $request->description;
                $blog->banner_alt = $request->banner_alt;
                $blog->thumbnail_alt = $request->thumbnail_alt;
                $blog->status = $request->status;
                $blog->is_popular = $request->is_popular;
                $blog->display_order = $request->display_order;
                $blog->meta_title = $request->meta_title;
                $blog->meta_keyword = $request->meta_keyword;
                $blog->meta_description = $request->meta_description;
                $blog->tag_id = json_encode($request->tag_id);
                $blog->save();


                if ($btn == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'blog.update', $blog->id)->with('success', 'Blog has been updated successfully!');
                } else {
                    return redirect()->route(getRolePrefix() . 'blog.index')->with('success', 'Blog has been updated successfully.');
                }
            }
        }
    }

    public function blog_delete($id)
    {
        $blog = Blogs::find($id);
        if (empty($blog)) {
            return redirect()->route(getRolePrefix() . 'blog.index')->with('error', "Blog doesn't exist.");
        }
        if (!empty($blog->thumbnail)) {
            if (file_exists(public_path('uploads/blog/' . $blog->thumbnail))) {
                unlink(public_path('uploads/blog/' . $blog->thumbnail));
            }
        }
        if (!empty($blog->banner)) {
            if (file_exists(public_path('uploads/blog/' . $blog->banner))) {
                unlink(public_path('uploads/blog/' . $blog->banner));
            }
        }

        $blog->delete();
        return redirect()->route(getRolePrefix() . 'blog.index')->with('success', 'Blog deleted successfully.');
    }

    public function blog_status(Request $request)
    {
        $blog = Blogs::findOrFail($request->blog_id);
        $blog->status = $request->status;
        $blog->save();
        return response()->json(['message' => 'Blog status updated successfully.']);
    }

    public function deleteImage(Request $request)
    {
        $property = Blogs::findOrFail($request->id);

        $imageToDelete = $request->input('image');
        $imagePath = public_path('uploads/blog/' . $imageToDelete);

        // Remove image from disk if it exists
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Remove image from JSON array
        $images = json_decode($property->multiple_images, true);

        if (($key = array_search($imageToDelete, $images)) !== false) {
            unset($images[$key]);
            $property->multiple_images = json_encode(array_values($images));
            $property->save();
        }

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
