<?php

namespace App\Controller\Images;


use App\Utils\Image;
use App\Http\Response;

class AdvertisementImage {

    public static function getAdvertisementImage($relativeImagePath) {

        $relativeImagePath = "advertisements/$relativeImagePath";
        
        list($imageContent, $imageMimeType) = Image::getImage($relativeImagePath);

        return new Response(200, $imageContent, $imageMimeType);
    }
}



