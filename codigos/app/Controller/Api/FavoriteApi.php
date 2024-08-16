<?php

namespace App\Controller\Api;

use App\Service\FavoriteService;
use App\Repository\FavoriteRepository;


use App\Core\Database;
use \DateTime;
use \Exception;
use \App\Http\Request;
use App\Model\Favorite;



class FavoriteApi
{


    /**
     * Instância de FavoriteService
     *
     * @var FavoriteService|null
     */
    private static ?FavoriteService $favoriteService = null;



    /**
     * Método responsável por inicializar o UserService estaticamente
     * 
     * @return void
     */
    public static function initialize(): void
    {
        if (self::$favoriteService === null) {
            $db = new Database("favorite");
            $favoriteRepository = new favoriteRepository($db);
            self::$favoriteService = new favoriteService($favoriteRepository);
        }
    }


    /**
     * Método responsável por cadastar um usuário na plataforma
     *
     * @param Request $request
     * @return string
     */
    public static function manageFavorite(Request $request): string
    {
        try {

            self::initialize();

            $formFields = $request->getBodyVars();


            $advertisementId = $formFields["advertisementId"] ?? "";
            $favorite = $formFields["favorite"] ?? "";



            self::$favoriteService->manageFavorites($advertisementId, $favorite);


            return json_encode([
                "success" => true,
                "message" => "Anúncio " . ($favorite == "true" ?  "favoritado" : "desfavoritado") . " com sucesso!"
            ]);
        } catch (Exception $e) {
            return json_encode([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }




    /**
     * Método responsável por carregar os anúncios favoritos de um usuário
     *
     * @return array
     */
    public static function getMyFavorites(): string
    {
        try {

            self::initialize();

            $data = self::$favoriteService->getMyFavorites();


            return json_encode([
                "success" => true,
                "data" => $data
            ]);
        } catch (Exception $e) {
            return json_encode([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }


}
