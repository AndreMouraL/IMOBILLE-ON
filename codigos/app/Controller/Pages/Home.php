<?php

namespace App\Controller\Pages;


use \App\Utils\View;
use \App\Model\User;



class Home extends Page {
    /**
     * Método responável por retornar o conteúdo (view) da home do site
     *
     * @return string
     */
    public static function getHome(){

        $user = new User();

        //DEFININDO ROTA E TITÚLO DO BOTÃO PRINCIPAL DA HOME DE ACORDO COM O STATUS DE SESSÃO DO USUÁRIO
        $homeButtonRoute = $user->isLogged() ? "platform-advertisements" : "register";
        $homeButtonTitle = $user->isLogged() ? "Buscar Anúncios da Plataforma" : "Cadastre-se Agora";


        //VIEW DA HOME
        $content = View::render("pages/home/index", [
            "homeButtonRoute" => $homeButtonRoute,
            "homeButtonTitle" => $homeButtonTitle,
        ]);

        //VIEW DA PÁGINA
        return parent::getPage("Início", $content, "style=\"overflow: hidden;\"");
    }


}