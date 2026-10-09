<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogTagController extends Controller
{
    public function index()
    {
        $data['blogs'] = BlogTag::all();
        return view('admin.blogTag.index', $data);
    }

    public function blog_tag_create(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('admin.blogTag.create');
        }
        if ($request->method() == 'POST') {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );
            if ($validator->passes()) {


                $res  = new BlogTag();
                $btn = $request->btnsubmit;
                $res->name = $request->name;
                $res->status = $request->status;
                $res->save();


                if ($btn == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'blog_tag.create')->with('success', 'Blog Tag Created successfully!');
                } else {
                    return redirect()->route(getRolePrefix() . 'blog_tag.index')->with('success', 'Blog Tag Created successfully!');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'blog_tag.create')->withErrors($validator)->withInput();
            }
        }
    }



    public function blog_tag_update(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $blogid = decode_string($id);

            $data['blog'] = BlogTag::find($blogid);
            if (empty($data['blog'])) {
                return redirect()->route(getRolePrefix() . 'blog_tag.index')->with('error', "Blog doesn't exist.");
            }
            return view('admin.blogTag.edit', $data);
        }
        if ($request->method() == 'POST') {
            $blogid = decode_string($id);
            $blog = BlogTag::find($blogid);
            if (empty($blog)) {
                return redirect()->route(getRolePrefix() . 'blog_tag.index')->with('error', "Blog doesn't exist.");
            } else {
                $request->validate([
                    'name' => 'required',
                ]);

                if (empty($blog)) {
                    return redirect()->route(getRolePrefix() . 'blog_tag.index')->with('error', "Blog doesn't exist.");
                }

                $btn = $request->btnsubmit;
                $blog->name = $request->name;
                $blog->status = $request->status;
                $blog->save();

                if ($btn == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'blog_tag.update', $blog->id)->with('success', 'Blog has Tag been updated successfully!');
                } else {
                    return redirect()->route(getRolePrefix() . 'blog_tag.index')->with('success', 'Blog Tag has been updated successfully.');
                }
            }
        }
    }

    public function blog_tag_delete($id)
    {
        $blog = BlogTag::find($id);
        if (empty($blog)) {
            return redirect()->route(getRolePrefix() . 'blog_tag.index')->with('error', "Blog doesn't exist.");
        }

        $blog->delete();
        return redirect()->route(getRolePrefix() . 'blog_tag.index')->with('success', 'Blog Tag deleted successfully.');
    }
    

    public function blog_tag_status(Request $request)
    {
        $blog = BlogTag::findOrFail($request->blog_id);
        $blog->status = $request->status;
        $blog->save();
        return response()->json(['message' => 'Blog Tag status updated successfully.']);
    }



}
