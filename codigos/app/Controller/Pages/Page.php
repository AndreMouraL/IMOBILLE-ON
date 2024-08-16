<?php


namespace App\Controller\Pages;

use \App\Utils\View;
use App\Service\UserService;
use App\Core\Database;
use App\Repository\UserRepository;
use App\Model\User;
use \Exception;


class Page
{


    /**
     * Instância de UserService
     *
     * @var UserService|null
     */
    private static ?UserService $userService = null;



    /**
     * Método responsável por inicializar o UserService estaticamente
     * 
     * @return void
     */
    public static function initialize(): void
    {
        if (self::$userService === null) {
            $db = new Database("user");
            $userRepository = new UserRepository($db);
            self::$userService = new UserService($userRepository);
        }
    }



    /**
     * Método responsável por retornar o contéudo (view) da topbar da página genérica
     *
     * @return string
     */
    private static function getTopbar()
    {
        try {

            $user = new User();

            //VERIFICA SE O USúARIO ESTÁ LOGADO
            if ($user->isLogged()) {



                //RECUPERA O PRIMEIRO NOME E O CAMINHO DA IMAGEM DE PERFIL
                $userInfo = $user->getLoggedInfo();
                $userFirstName = $userInfo["firstName"] ?? "";
                $userImagePath = $userInfo["imagePath"] ?? "";




                //PROCESSA O CONTEÚDO DAS INFORMAÇÕES DO USUÁRIO
                $topbarRight = View::render("components/topbar/user-information", [
                    "userFirstName" => $userFirstName,
                    "userImagePath" => $userImagePath
                ]);


                //BUSCA O CONTEÚDO DA BUSCA PERSONALIZADA
                $personSearch =  View::render("components/topbar/person-search");
            } else {

                //PROCESSA CONTEÚDO ALTERNATIVO PARA ITENS DA TOPBAR CASO O USUÁRIO NÃO ESTEJA LOGADO
                $topbarRight = View::render("components/topbar/register-login-buttons");
                $personSearch = "";
            }

            //RETORNA O CONTEÚDO GERAL DA TOPBAR
            return View::render("components/topbar/index", [
                "topbarRight" => $topbarRight,
                "personSearch" => $personSearch
            ]);
        } catch (Exception $e) {

            //LIMPA O CONTEÚDO DOS ITEMS DA TOPBAR CASO ALGUM ERRO OCORRA 
            return View::render("components/topbar/index", [
                "topbarRight" => "",
                "personSearch" => ""
            ]);
        }
    }




    /**
     * Método responsável por retornar o contéudo (view) da sidebar da página genérica
     *
     * @return string
     */
    private static function getSidebar()
    {
        $user = new User();

        //LÓGICA PARA AS FUNCIONALIDADES DA SIDEBAR DE ACORDO COM O NÍVEL DE USUÁRIO
        $userItems = $user->isLogged() ? View::render("components/sidebar/user-items") : "";
        $adminItems =  $user->isAdmin() ? View::render("components/sidebar/admin-items") : "";
        $modeItems = ($user->isAdmin() || $user->isMode()) ? View::render("components/sidebar/mode-items", [
            "adminItems" => $adminItems
        ]) : "";



        //REORNO DA SIDEBAR
        return View::render("components/sidebar/index", [
            "userItems" => $userItems,
            "modeItems" => $modeItems,
            "adminItems" => $adminItems
        ]);
    }




    /**
     * Método responsável por retornar o conteúdo (view) da página genérica
     *
     * @return string
     */
    public static function getPage($title, $content, $overflow = "style=\"overflow: auto;\"")
    {
        return View::render("pages/index", [
            "title" => $title,
            "content" => $content,
            "overflow" => $overflow,
            "sidebar" => self::getSidebar(),
            "topbar" => self::getTopbar()
        ]);
    }
}
