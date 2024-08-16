<?php

namespace App\Controller\Pages;


use App\Model\User;


class Logout {
    /**
     * Método responsável por deslogar o usuário e redirecioná-lo para a home
     *
     * @return void
     */
    public static function getLogout($request) {
        $user = new User();
        $user->logout();
        $request->getRouter()->redirect("/home");
    }

}