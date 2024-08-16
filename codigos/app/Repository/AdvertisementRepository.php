<?php

namespace App\Repository;

use App\Model\User;
use App\Model\Advertisement;
use App\Core\Database;
use \Exception;
use PDOStatement;

class AdvertisementRepository
{


    /**
     * Instância de Database
     *
     * @var Database
     */
    private Database $db;


    /**
     * Construtor da classe
     *
     * @param Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }




    /**
     * Metódo responsável por carregar as informações necessárias para um card de anúncio da plataforma
     *
     * @return PDOStatement
     */
    public function getCardInformationsByCondition($where = []): PDOStatement {

        try {

            $fields = [               
                "advertisement.id as id",
                "title", 
                "description",
                "imagePath",
                "businessValue",
                "street",
                "number",
                "municipality.name as municipality",
                "state.name as state"
            ];



            $join = [
                [
                    "table" => "property", 
                    "referencing" => "advertisement.property", 
                    "referenced" => "property.id"
                ],
                [
                    "table" => "address", 
                    "referencing" => "property.address", 
                    "referenced" => "address.id"
                ],
                [
                    "table" => "municipality", 
                    "referencing" => "address.municipality", 
                    "referenced" => "municipality.code"
                ],
                [
                    "table" => "state", 
                    "referencing" => "municipality.state", 
                    "referenced" => "state.code"
                ],
            ];



            return $this->db->select($fields, $join, $where, "publiDate DESC");
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
       
    }




    /**
     * Método responsável por carregar as informações necessárias para preencheer a página de um anúncio específico
     *
     * @param integer $id
     * @return PDOStatement
     */
    public function getAdvertisementInformationsById(int $id): PDOStatement{

        try {

            $fields = [
                "advertisement.id as advertisementId",
                "title", 
                "description",
                "advertisement.imagePath as imagePath",
                "businessValue",
                "publiDate",
                "businessType",
                "businessStatus",
                "builtUpArea",
                "bathNumber",
                "roomNumber",
                "parkingSpaces",
                "propertyType",
                "solarIncidence",
                "furnished",
                "pool",
                "barbecue",
                "sportsCourt",
                "municipality.name as municipality",
                "neighborhood",
                "street",
                "number",
                "ZIPcode",
                "complement",
                "state.name as state",
                "firstName",
                "lastName",
                "email",
                "phone",
                "instagram",
                "whatsapp"
            ];


            $join = [
                [
                    "table" => "user", 
                    "referencing" => "advertisement.user", 
                    "referenced" => "user.id"
                ],
                [
                    "table" => "property", 
                    "referencing" => "advertisement.property", 
                    "referenced" => "property.id"
                ],
                [
                    "table" => "address", 
                    "referencing" => "property.address", 
                    "referenced" => "address.id"
                ],
                [
                    "table" => "municipality", 
                    "referencing" => "address.municipality", 
                    "referenced" => "municipality.code"
                ],
                [
                    "table" => "state", 
                    "referencing" => "municipality.state", 
                    "referenced" => "state.code"
                ],
            ];

            $where = ["advertisement.id = " => $id];

            return $this->db->select($fields, $join, $where);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }


}
