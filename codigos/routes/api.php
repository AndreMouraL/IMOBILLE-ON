<?php


use \App\Controller\Api;
use \App\Http\Response;



//ROTA PARA CADASTRO DE USUÁRIO
$obRouter->post("/api/register",[
    "middlewares" => [
        "requireLogout",
    ],
    function($request){
        return new Response(200, Api\UserApi::registerUser($request));
    }
]);



//ROTA PARA LOGIN DE USUÁRIO
$obRouter->post("/api/login",[
    "middlewares" => [
        "requireLogout",
    ],
    function($request){
        return new Response(200, Api\UserApi::loginUser($request));
    }
]);



//ROTA PARA ANÚNCIOS DA PLATAFORMA
$obRouter->get("/api/platform-advertisements",[
    function(){
        return new Response(200, Api\AdvertisementApi::getPlatformAdvertisementsCards());
    }
]);





//ROTA PARA VISUALIZAR ANÚNCIO ESPECÍFICO DA PLATAFORMA
$obRouter->get("/api/open-advertisement/{id}",[
    function($id){
        return new Response(200, Api\AdvertisementApi::getOpenAdvertisement($id));
    }
]);




//ROTA PARA ANÚNCIO GERENCIAR FAVORITOS
$obRouter->post("/api/manage-favorite",[
    "middlewares" => [
        "requireLogin",
    ],
    function($request){
        return new Response(200, Api\FavoriteApi::manageFavorite($request));
    }
]);


















