<?php

require __DIR__ . "/../includes/app.php";

use \App\Http\Router;
use \App\Http\Middleware\Queue;

//INICIA O ROUTER
$obRouter = new Router(URL);

//INCLUI AS ROTAS DE PÁGINAS
include __DIR__ . "/../routes/pages.php";


//INCLUI AS ROTAS DE API's
include __DIR__ . "/../routes/api.php";


//INCLUI AS ROTAS PARA IMAGENS
include __DIR__ . "/../routes/images.php";



// MIDDLEWARE MAPPING
Queue::setMap([
    "requireLogout" => \App\Http\Middleware\RequireLogout::class,
    "requireLogin" => \App\Http\Middleware\RequireLogin::class,
    "requireAdmin" => \App\Http\Middleware\RequireAdmin::class,
]);


Queue::setDefault([]);

//IMPRIME O RESPONSE DA ROTA
$obRouter->run()->sendResponse();












