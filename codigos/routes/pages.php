<?php


use \App\Controller\Pages;
use \App\Http\Response;




//ROTA PARA CADASTRO DE USUÁRIO
$obRouter->get("/register",[
    "middlewares" => [
        "requireLogout",
    ],
    function(){
        return new Response(200, Pages\Register::getRegister());
    }
]);



//ROTA PARA LOGIN DE USUÁRIO
$obRouter->get("/login",[
    "middlewares" => [
        "requireLogout",
    ],
    function(){
        return new Response(200, Pages\Login::getLogin());
    }
]);



//ROTA PARA HOME 
$obRouter->get("/home",  [
    function () {
        return new Response(200, Pages\Home::getHome());
    }
]);




//ROTA PARA ANÚNCIOS DA PLATAFORMA 
$obRouter->get("/platform-advertisements",  [
    function ($request) {
        return new Response(200, Pages\PlatformAdvertisements::getPlatformAdvertisements());
    }
]);



//ROTA PARA ANÚNCIO ESPECÍFICO DA PLATAFORMA
$obRouter->get("/open-advertisement/{id}",  [
    function ($id) {
        return new Response(200, Pages\OpenAdvertisement::getOpenAdvertisement($id));
    }
]);




//ROTA PARA LOGOUT DE USÚARIO
$obRouter->get("/logout",  [
    "middlewares" => [
        "requireLogin",
    ],
    function ($request) {
        return new Response(200, Pages\Logout::getLogout($request));
    }
]);











