<?php

namespace App\Controller\Api;

use App\Service\UserService;
use App\Repository\UserRepository;


use App\Core\Database;
use \DateTime;
use \Exception;
use \App\Http\Request;

class UserApi
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
     * Método responsável por cadastar um usuário na plataforma
     *
     * @param Request $request
     * @return string
     */
    public static function registerUser(Request $request): string
    {
        try {

            self::initialize();

            $formFields = $request->getPostVars();

            $formFields["cpf"] = preg_replace("/[^0-9]/", "", $formFields["cpf"] ?? "");
            $formFields["phone"] = preg_replace("/[^0-9]/", "", $formFields["phone"] ?? "");
            $formFields["whatsapp"] = preg_replace("/[^0-9]/", "", $formFields["whatsapp"] ?? "");


            $userData = [
                "firstName" => $formFields["firstName"] ?? "",
                "lastName" => $formFields["lastName"] ?? "",
                "email" => $formFields["email"] ?? "",
                "birthDate" => $formFields["birthDate"] ?? "",
                "password" => $formFields["password"] ?? "",
                "confirmPassword" => $formFields["confirmPassword"] ?? "",
                "cpf" => $formFields["cpf"] ?? "",
                "phone" => $formFields["phone"] ?? "",
                "instagram" => $formFields["instagram"] ?? "",
                "whatsapp" =>  $formFields["whatsapp"] ?? "",
                "registerDate" => (new DateTime())->format("Y-m-d H:i:s"),
                "imagePath" => "undraw-profile.svg",
                "privilege" => "Usuário"
            ];

            self::$userService->registerUser($userData);

            return json_encode([
                "success" => true,
                "message" => "Conta criada com sucesso!",
            ]);
        } catch (Exception $e) {
            return json_encode([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }




    /**
     * Método responsável por efetuar o login de um usuário na plataforma
     *
     * @param Request $request
     * @return string
     */
    public static function loginUser(Request $request): string
    {
        try {

            self::initialize();

            $formFields = $request->getPostVars();


            $identifier = $formFields["identifier"];
            $password = $formFields["password"];



            self::$userService->loginUser($identifier, $password);

            return json_encode([
                "success" => true,
                "message" => "Usuário autenticado!",
            ]);

        } catch (Exception $e) {
            return json_encode([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
}
