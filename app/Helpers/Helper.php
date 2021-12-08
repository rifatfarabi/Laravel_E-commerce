<?php

//Global image file uploader

use Illuminate\Support\Facades\Auth;

function uploadImage($request, $arribute_name, $save_path, $width = null, $height = null, $imageName = null){

    if($request->hasFile($arribute_name)){

        $image = $request->file($arribute_name);
        $filename = $imageName ? $imageName .'.'. $image->getClientOriginalExtension() : $image->hashName();

        $location = public_path($save_path);

        // If directory doesn't exists create directory first
        File::isDirectory($location) or File::makeDirectory($location, 0777, true, true);
        $filepath = public_path($save_path.'/'.$filename); // make new location to the created folder

        Image::make($image)->resize($width, $height, function($constraint){
            $constraint->aspectRatio();
        })->save($filepath);

        return $filename;
   }

   return null;

}


//Global image file uploader
function uploadFile($request, $arribute_name, $save_path, $fileName = null){

    if($request->hasFile($arribute_name)){

        $file = $request->file($arribute_name);
        $filename = $fileName ? $fileName .'.'. $file->getClientOriginalExtension() : $file->hashName();

        $location = public_path($save_path);

        // If directory doesn't exists create directory first
        File::isDirectory($location) or File::makeDirectory($location, 0777, true, true);
        $filepath = public_path($save_path.'/'.$filename); // make new location to the created folder

        $file->move($location, $filepath);

        return $filename;
   }

   return null;

}

// Global File deleter
function deleteOldFile($filename, $filepath){
    if($filename && file_exists(public_path()."/".$filepath."/".$filename)) {
        unlink(public_path()."/".$filepath."/".$filename);
    }
}

function getRole(){

    if(request()->routeIs("api.*"))
        $role = request()->header('role');
    else
        $role = \Cookie::get("role");

    return hasRole($role) ? $role : "admin";
}

function hasRole($role){

    if(Auth::check()){
       return Auth::user()->roles()->where('title', $role)->first() ? true : false;
    }

    return false;
}


//Global image upload editor
//function editImage($request, $name, $path, $imageName, $old_image ){
//    if($request->hasFile($name)){
//        $image = $request->file($name);
//        $filename = $imageName .'.'. $image->getClientOriginalExtension();
//        $location = public_path($path.'/'.$filename);
//        Image::make($image)->save($location);
//        $im = $path.'/'.$filename;
//        if(strlen($old_image) > 0 && file_exists(base_path().'/public/'.$old_image)) {
//            unlink(base_path().'/public/'.$old_image);
//        }
//        return $im;
//    }
//    return ' ';
//}



function getUserCurrency(){

    if(request()->routeIs("api.*")){
        return request()->currency ?? config('settings.currency');
    }

    return request()->session()->get('currency') ?? config('settings.currency');
}

function currency($amount, $from = null, $to = null, $format=true){

    if(!$amount){
        return null;
    }

    $from = strtoupper($from ?: config('settings.currency'));
    $to = strtoupper($to ?: getUserCurrency());

    try{

        $fromCurrency = \App\Models\Currency::where('code', $from)->first();
        $toCurrency = \App\Models\Currency::where('code', $to)->first();

        if ($from === $to) {
            $value = $amount;
        } else {
            $value = ($amount * $toCurrency->exchange_rate) / $fromCurrency->exchange_rate;
        }

        if(!$format) return $value;

        if($toCurrency->position == "left")
            return $toCurrency->symbol.$value;
        else
            return $value.$toCurrency->symbol;

    }catch(\Exception $e){
        return null;
    }
}



// Get User IP Address
function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_FORWARDED'])) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

    return $ipaddress;
}



function getOrderStatus($i){

    $statuses = [
        "PENDING",
        "AWAITING_PAYMENT",
        "PROCESSING",
        "READY TO DISPATC",
        "PICKED UP",
        "IN WAREHOUSE",
        "ON THE WAY",
        "SHIPPED",
        "CANCELLED",
        "RETURNED",
        "DISPUTED",
        "REFUNDED"
    ];

    return $statuses[$i];
}

function getOrderStatusColor($i){
    $statuses = [
        "Teal",
        "Olive",
        "Blue",
        "Purple",
        "Lime",
        "Navy",
        "Maroon",
        "Green",
        "Red",
        "Yellow",
        "Aqua",
        "Fuchsia"
    ];

    return $statuses[$i];
}
