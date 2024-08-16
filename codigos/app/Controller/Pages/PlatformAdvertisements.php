<?php
namespace App\Controller\Pages;

use \App\Utils\View;


/**
 * Método responsável por retornar o conteúdo (view) dos anúncios da plataforma
 */
class PlatformAdvertisements extends Page {

    public static function getPlatformAdvertisements() {

        $content = View::render("pages/platform-advertisements/index", [
        ]);
        return parent::getPage("Anúncios da Plataforma", $content, "style=\"overflow: hidden;\"");
    }
}