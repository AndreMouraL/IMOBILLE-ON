<?php

namespace App\Controller\Pages;


use \Exception;
use \DateTime;
use \PDO;


use \App\Model\Favorite;
use \App\Model\Advertising;
use \App\Model\User;


use \App\Utils\View;


class OpenAdvertisement extends Page{

    public static function getOpenAdvertisement($id)
    {

        $content = View::render("pages/open-advertisement/index", [
            "advertisementId" => $id
        ]);

        return parent::getPage("Informações do Anúncio", $content);
    }
}


