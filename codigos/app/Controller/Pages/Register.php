<?php

namespace App\Controller\Pages;


use \App\Utils\View;


class Register {
    /**
     * Método responsável por retornar o conteúdo (view) da página de cadastro de usuário
     *
     * @return string
     */
    public static function getRegister(){

        return View::render("pages/register/index");
    }
}