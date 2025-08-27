<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use File;

trait FileUploadTrait
{


    function uploadImage(Request $request, $inputName, $oldPath=NULL,  $path = "/uploads")
    {

        if ($request->hasFile($inputName)) {

            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' .$ext; // image.extension

            $image->move(public_path($path), $imageName);

            //delete previous iamge file if exists
            // if($oldPath && File::exists(public_path($oldPath))){
            //     File::delete(public_path($oldPath));
            // }
            return $path.'/'.$imageName;
        }
          return NULL;
    }
}
