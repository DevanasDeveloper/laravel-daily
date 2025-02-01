<?php

namespace App\Http;

use Illuminate\Support\Str;

class Helper {

    public static function uploadFile($file,$storage_url,$public_url){
        $extension = $file->getClientOriginalExtension();
        $filename = Str::random(32) . time() . '.' . $extension;
        $filepath = $storage_url . $filename;
        $file->storeAs($public_url, $filename);
        return $filepath;
    }
}