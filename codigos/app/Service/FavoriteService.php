<?php

namespace App\Service;

use App\Model\User;
use App\Repository\UserRepository;

use App\Model\Advertisement;
use App\Repository\AdvertisementRepository;

use App\Model\Favorite;
use App\Repository\FavoriteRepository;



use \Exception;
use PDO;



class FavoriteService
{


    /**
     * Instância de FavoriteRepository
     *
     * @var FavoriteRepository
     */
    private FavoriteRepository $favoriteRepository;



    /**
     * Construtor da classe
     *
     * @param FavoriteRepository $favoriteRepository
     */
    public function __construct(FavoriteRepository $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }




    /**
     * Método responsável por retornar um array com os IDS dos anúncios favoritos de um usuário
     *
     * @return array
     */

     public function getFavoritesAdvertisementsByUser(int $userId): array {

        try{

            $statement = $this->favoriteRepository->getByUser($userId);

            $favorites = [];

            if ($statement->rowCount() > 0) {
                while ($favoriteObject = $statement->fetchObject(Favorite::class)) {
                    array_push($favorites, $favoriteObject->advertisement);
                }
            }

            return $favorites;

        }catch(Exception $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }



    public function manageFavorites($advertisementId, $favorite){

        try {

            $user = new User();
            $userId = $user->getLoggedInfo()["id"];

            if($favorite == "true"){

                $fields = [
                    "advertisement" => $advertisementId, 
                    "user" => $userId
                ];

                $this->favoriteRepository->insert($fields);

            } else {

                $where = [
                    "advertisement = " =>  $advertisementId,
                    "AND user = " => $userId
                ];

                $this->favoriteRepository->delete($where);
            }


        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }


    public function getMyFavorites(){

        try {

            $user = new User();
            $userId = $user->getLoggedInfo()["id"];


            $statement = $this->favoriteRepository->getAllInformationsByUser($userId);

            $favorites = [];

            if ($statement->rowCount() > 0) {
                while ($favoriteObject = $statement->fetch(PDO::FETCH_ASSOC)) {
                    array_push($favorites, $favoriteObject->advertisement);
                }
            }




        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }


}
