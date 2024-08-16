<?php

namespace App\Controller\Api;

use App\Service\UserService;
use App\Repository\UserRepository;


use App\Service\AdvertisementService;
use App\Repository\AdvertisementRepository;


use App\Service\FavoriteService;
use App\Repository\FavoriteRepository;



use App\Core\Database;;
use \DateTime;
use \Exception;
use \App\Http\Request;


class AdvertisementApi
{


    /**
     * Instância de AdvertisementService
     *
     * @var AdvertisementService|null
     */
    private static ?AdvertisementService $advertisementService = null;


    /**
     * Instância de FavotireService
     *
     * @var FavoriteService|null
     */
    private static ?FavoriteService $favoriteService = null;



    /**
     * Método responsável por inicializar o AdvertisementService estaticamente
     * 
     * @return void
     */
    public static function initialize(): void
    {
        if (self::$advertisementService === null && self::$favoriteService === null) {
            $advertisementDb = new Database("advertisement");
            $advertisementRepository = new AdvertisementRepository($advertisementDb);
            
            $favoriteDb = new Database("favorite");
            $favoriteRepository = new FavoriteRepository($favoriteDb);

            self::$favoriteService = new FavoriteService($favoriteRepository);
            self::$advertisementService = new AdvertisementService($advertisementRepository, self::$favoriteService);
        }
    }




    /**
     * Método responsável por cadastrar um anúncio na plataforma
     *
     * @param Request $request
     * @return string
     */
    public static function registerAdvertisement(Request $request): string
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

            //self::$advertisementService->registerUser($userData);

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
     * Método responsável por buscar as informações necessárias para construir um card de anúncio
     *
     * @return string
     */
    public static function getPlatformAdvertisementsCards()
    {

        try {

            self::initialize();

            $data = self::$advertisementService->getPlatformAdvertisementsCards();


            return json_encode([
                "success" => true,
                "data" => $data,
            ]);


        } catch (Exception $e) {

            return json_encode([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }




    /**
     * Método responsável por buscar as informações de um anúncio específico da plataforma
     *
     * @param integer $id
     * @return string
     */
    public static function getOpenAdvertisement(int $id){

        try {

            self::initialize();

            $arguments = self::$advertisementService->getOpenAdvertisement($id);


            return json_encode([
                "success" => true,
                "data" => $arguments,
            ]);

        } catch (Exception $e) {
            return json_encode([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }

}
