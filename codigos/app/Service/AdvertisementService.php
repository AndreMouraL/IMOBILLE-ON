<?php

namespace App\Service;

use App\Model\User;
use App\Repository\UserRepository;

use App\Model\Advertisement;
use App\Repository\AdvertisementRepository;

use App\Model\Favorite;
use App\Repository\FavoriteRepository;


use \Exception;
use \PDO;
use \DateTime;


class AdvertisementService
{

    /**
     * Instância de AdvertisementRepository
     *
     * @var AdvertisementRepository
     */
    private AdvertisementRepository $advertisementRepository;


    /**
     * Instância de FavoriteService
     *
     * @var FavoriteService
     */
    private FavoriteService $favoriteService;



    /**
     * Construtor da classe
     *
     * @param AdvertisementRepository $advertisementRepository
     * @param FavoriteRepository $favoriteRepository
     */
    public function __construct(AdvertisementRepository $advertisementRepository, FavoriteService $favoriteService)
    {
        $this->advertisementRepository = $advertisementRepository;
        $this->favoriteService = $favoriteService;
    }



    /**
     * Método responsável por processar informações para os cards dos anúncios 
     *
     * @return array
     */
    public function getPlatformAdvertisementsCards(): array
    {
        try {

            $advertisements = [];

            $statement = $this->advertisementRepository->getCardInformationsByCondition([]);

            if($statement->rowCount() > 0) {

                $user = new User();
                $userIsLogged = $user->isLogged();

                $favorites = [];

                if ($userIsLogged) {
                    $userId =   $user->getLoggedInfo()["id"];
                    $favorites = $this->favoriteService->getFavoritesAdvertisementsByUser($userId);
                }


                while ($advertisingObject = $statement->fetch(PDO::FETCH_ASSOC)) {

                    $address = $this->processAdress(
                        $advertisingObject["street"] ?? "", 
                        $advertisingObject["number"] ?? "", 
                        $advertisingObject["municipality"] ?? "",
                        $advertisingObject["state"] ?? ""
                    );

    
                    $AdvertisingsArray = [
                        "id" => $advertisingObject["id"] ?? "",
                        "image" => ($advertisingObject["imagePath"] ?? "") . "/imagem_1.jpeg",
                        "title" =>  $advertisingObject["title"] ?? "",
                        "businessValue" => number_format(($advertisingObject["businessValue"] ?? 0), 2, ',', '.'),
                        "description" => $advertisingObject["description"] ?? "",
                        "address" =>  $address,
                        "isLogged" => $userIsLogged ? true : false,
                        "favorite" => $userIsLogged ? in_array($advertisingObject["id"] ?? "", $favorites) : false
                    ];
    
                    array_push($advertisements, $AdvertisingsArray);
                }

            }

            return $advertisements;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Método responsável por processar as informações para a página de um a anúncio
     *
     * @param integer $id
     * @return array
     */
    public function getOpenAdvertisement(int $id){

        try {

            $arguments = [];


            $statement = $this->advertisementRepository->getAdvertisementInformationsById($id);


            if($statement->rowCount() == 1) {

                $user = new User();
                $userIsLogged = $user->isLogged();

                $favorites = [];

                if ($userIsLogged) {
                    $userId =   $user->getLoggedInfo()["id"];
                    $favorites = $this->favoriteService->getFavoritesAdvertisementsByUser($userId);
                }


                $advertisingObject = $statement->fetch(PDO::FETCH_ASSOC);


                $address = $this->processAdress(
                    $advertisingObject["street"] ?? "", 
                    $advertisingObject["number"] ?? "", 
                    $advertisingObject["municipality"] ?? "",
                    $advertisingObject["state"] ?? ""
                );

                $imagePathsArray = self::getFilesFromDirectory(
                    __DIR__ . "/../../resources/images/advertisements/" .($advertisingObject["imagePath"] ?? "")
                );


                $arguments = [
                    "imagePaths" => $imagePathsArray,
                    "title" =>  $advertisingObject["title"] ?? "",
                    "businessValue" => number_format(($advertisingObject["businessValue"] ?? 0), 2, ',', '.'),
                    "description" => $advertisingObject["description"] ?? "",
                    "businessType" => $advertisingObject["businessType"] ?? "",
                    "publiDate" => (new DateTime($advertisingObject["publiDate"]))->format("d/m/Y") ?? "",
                    "address" =>  $address,
                    "name" => ($advertisingObject["firstName"] ?? "") . " " . ($advertisingObject["lastName"] ?? ""),
                    "builtUpArea" => $advertisingObject["builtUpArea"] ?? "",
                    "bathNumber" => $advertisingObject["bathNumber"] ?? "",
                    "roomNumber" => $advertisingObject["roomNumber"] ?? "",
                    "parkingSpaces" => $advertisingObject["parkingSpaces"] ?? "",
                    "propertyType" => $advertisingObject["propertyType"] ?? "",
                    "solarIncidence" => $advertisingObject["solarIncidence"] ?? "",
                    "furnished" => ($advertisingObject["furnished"] ?? "") ? "Mobiliado" : "Não mobiliado",
                    "pool" => ($advertisingObject["pool"] ?? "") ? "Possui" : "Não possui",
                    "barbecue" => ($advertisingObject["barbecue"] ?? "") ? "Possui" : "Não possui",
                    "sportsCourt" => ($advertisingObject["sportsCourt"] ?? "") ? "Possui" : "Não possui",
                    "phone" => $advertisingObject["phone"] ?? "",
                    "whatsapp" => $advertisingObject["whatsapp"] ?? "",
                    "instagram" => $advertisingObject["instagram"] ?? "",
                    "email" => $advertisingObject["email"] ?? "",
                    "favoriteChecked" => in_array($advertisingObject["advertisementId"] ?? "", $favorites) ? true : false,
                    "isLogged" =>  $userIsLogged ? true : false,
                    "advertisementId" =>  $advertisingObject["advertisementId"] ?? "",
                ];

            }

            return $arguments;

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }



    /**
     * Método responsável por retonar um array com os caminhos dos arquivos do anúncio
     *
     * @param string $directory
     * @return array
     */
    private function getFilesFromDirectory($directory) {


        if (!is_dir($directory)) {
            return [];
        }
    

        $files = scandir($directory);
    

        $files = array_filter($files, function($file) use ($directory) {
            return is_file($directory . DIRECTORY_SEPARATOR . $file);
        });
    

        $lastFolder = basename($directory);
    

        $files = array_map(function($file) use ($directory, $lastFolder) {
            return $lastFolder . DIRECTORY_SEPARATOR . $file;
        }, $files);
    
        return $files;
    }



    /**
     * Método responsável por processar o endereço e e concatená-lo as informações separando-as por vírgulas
     *
     * @param string $street
     * @param string $number
     * @param string $municipality
     * @param string $state
     * @return string
     */
    private function processAdress(string $street, string $number, string $municipality, string $state): string {
        try{

            $address = [];

            if (!empty($street)) {
                array_push($address, $street);
            }

            if (!empty($number)) {
                array_push($address, $number);
            }

            if (!empty($municipality)) {
                array_push($address, $municipality);
            }

            if (!empty($state)) {
                array_push($address, $state);
            }


            return implode(", ", $address);

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }



}
