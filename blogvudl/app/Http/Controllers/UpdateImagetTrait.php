<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


trait UpdateImagetTrait
{    
    /**
     * uploadimage
     *
     * @param  mixed $image
     * @param  mixed $newname
     * @param  mixed $folder
     * @return void
     */
    public function uploadimage($image, $newname, $folder)
    {
        if (file($image)) {
            $file_name = $image->getClientoriginalName();
            $resize= Image::make($image->getRealPath());
            $resize->resize(150,300,function ($constraint) {
            $constraint->aspectRatio();
            });
            
            $file_name = explode(".", $resize);
            $ext = end($file_name);

            $new_name = $newname . uniqid() . '.' . $ext.'jpg';
            
            $image->storeAs($folder, $new_name, 'public');
            $image = $new_name;
        }
        return $image;
    }
    
    /**
     * deleteImage
     *
     * @param  mixed $pathImg
     * @param  mixed $folder
     * @return void
     */
    public function deleteImage($pathImg, $folder)
    {
        if ($pathImg) {
            $destinationPath = 'public/' . $folder . '/' . $pathImg;
            if (file_exists($destinationPath)) {
                unlink($destinationPath);
            }
        }
    }
}
