<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index()
    {
        $data['faq'] = Faq::all();
        return view('admin.faq.index', $data);
    }


    public function create(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('admin.faq.create');
        }
        if ($request->method() == 'POST') {

            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'answer' => 'required',
                 'navigation_type' => 'required',

            ]);
            if ($validator->passes()) {

                $res = new Faq();
                $btn_type = $request->btnsubmit;
                $res->navigation_type = $request->navigation_type;
                $res->question = $request->question;
                $res->answer = $request->answer;
                $res->status = $request->status;
                $res->display_order = $request->display_order;
                $res->save();
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix().'faq.create')->with('success', 'FAQ Created successfully!');;
                } else {
                    return redirect()->route(getRolePrefix().'faq.index')->with('success', 'FAQ Created successfully!');
                }
            } else {
                return redirect()->route(getRolePrefix().'faq.create')->withErrors($validator)->withInput();
            }
        }
    }

    public function update(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $faqid = decode_string($id);
            $data['faq'] = Faq::find($faqid);
            if (empty($data['faq'])) {
                return redirect()->route(getRolePrefix().'faq.index')->with('error', "FAQ doesn't exist.");
            }
            return view('admin.faq.edit', $data);
        }
        if ($request->method() == 'POST') {

            $validator = Validator::make($request->all(), [
                'question' => 'required',
                'answer' => 'required',
                'navigation_type' => 'required',
            ]);
            if ($validator->passes()) {
                 $faqid = decode_string($id);
                $faq = Faq::find($faqid);
                if (empty($faq)) {
                    return redirect()->route(getRolePrefix().'faq.index')->with('error', "FAQ doesn't exist.");
                }
                $btn_type = $request->btnsubmit;
                $faq->navigation_type = $request->navigation_type;
                $faq->question = $request->question;
                $faq->answer = $request->answer;
                $faq->status = $request->status;
                $faq->display_order = $request->display_order;
                $faq->save();
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix().'faq.update', $id)->with('success', 'FAQ Updated successfully!');;
                } else {
                    return redirect()->route(getRolePrefix().'faq.index')->with('success', 'FAQ Updated successfully!');
                }
            } else {
                return redirect()->route(getRolePrefix().'faq.update', $id)->withErrors($validator)->withInput();
            }
        }
    }

    public function delete($id)
    {
        $faq = Faq::find($id);
        if (empty($faq)) {
            return redirect()->route(getRolePrefix().'faq.index')->with('error', "FAQ doesn't exist.");
        }

        $faq->delete();
        return redirect()->route(getRolePrefix().'faq.index')->with('success', 'FAQ deleted successfully.');
    }

    public function status(Request $request)
    {
        $faq = Faq::findOrFail($request->faq_id);
        $faq->status = $request->status;
        $faq->save();
        return response()->json(['message' => 'FAQ status updated successfully.']);
    }
}
