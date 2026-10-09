<?php

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

//encode 
if (!function_exists('encode_string')) {
    function encode_string($id)
    {
        $encodedId = rtrim(strtr(base64_encode($id), '+/', '-_'), '=');
        $shuffle = Str::random(10); // Generate a 10-character random string.
        $backShuffle = Str::random(15); // Generate a 15-character random string.
        $enc_string = $shuffle . $encodedId . $backShuffle;
        return $enc_string;
    }
}

//decode 
if (!function_exists('decode_string')) {
    function decode_string($id)
    {
        $encodedIdWithPadding = substr($id, 10, -15);
        $paddedEncodedId = $encodedIdWithPadding . str_repeat('=', 4 - strlen($encodedIdWithPadding) % 4);
        $encodedId = strtr($paddedEncodedId, '-_', '+/');
        $originalId = base64_decode($encodedId);
        return $originalId;
    }
}

//Category
function getCategories(){
    return Category::where('status', '1')->where('show_menu','1')->orderBy('name', 'ASC')->get();
}

function gethomeCategories(){
    return Category::where('status', '1')->where('show_home','1')->orderBy('name', 'ASC')->get();
}

function getfooterCategories(){
    return Category::where('status', '1')->orderBy('name', 'ASC')->limit(6)->get();
}

function getfooterCategories2(){
    return Category::where('status', '1')->orderBy('name', 'ASC')->skip(6)->take(6)->get();
}

//Brands
// function getBrands(){
//     return Brand::where('status', '1')->orderBy('name', 'ASC')->get();
// }
function getRolePrefix()
{
    if (Auth::guard('admin')->check()) {
        return 'admin.';
    } elseif (Auth::guard('agent')->check()) {
        return 'agent.';
    } elseif (Auth::guard('dealer')->check()) {
        return 'dealer.';
    }
    return 'admin.';
}


function getWebRolePrefix()
{
    if (Auth::guard('dealer')->check()) {
        return 'dealer.';
    } 
    return 'user.';
}


function getGuard() {
    if (request()->is('admin/*')) return 'web';
    if (request()->is('agentpanel/*')) return 'agent';
    if (request()->is('dealerpanel/*')) return 'dealer';
    return 'web';
}
//Current Auth
if (!function_exists('current_auth_user')) {
    function current_auth_user()
    {
        foreach (['admin', 'agent', 'dealer', 'web'] as $guard) {
            if (auth()->guard($guard)->check()) {
                return auth()->guard($guard)->user();
            }
        }
        return null;
    }
}


if (!function_exists('breakWords')) {
    function breakWords($text, $wordsPerLine = 5)
    {
        $words = explode(' ', $text);
        $chunks = array_chunk($words, $wordsPerLine);

        return implode('<br>', array_map(function ($chunk) {
            return implode(' ', $chunk);
        }, $chunks));
    }
}
