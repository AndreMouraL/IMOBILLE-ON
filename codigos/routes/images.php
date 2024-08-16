<?php

use \App\Controller\Images;
use \App\Http\Response;


// Get News Image
$obRouter->get("/image/advertisement/{relativeImagePath}", [
    function ($relativeImagePath) {
       return Images\AdvertisementImage::getAdvertisementImage($relativeImagePath);
    }
]);


