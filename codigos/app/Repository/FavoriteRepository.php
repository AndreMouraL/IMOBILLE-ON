<?php

namespace App\Repository;


use \App\Core\Database;
use Exception;
use PDOStatement;



class FavoriteRepository {


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
     * Método responsável por buscar os anúncios favoritos de um usuário pelo seu ID
     *
     * @param int $userId
     * @return PDOStatement
     */
    public function getByUser(int $userId): PDOStatement{

        try {

            $where = [
                "user = " => $userId
            ];

            return $this->db->select(["*"], [], $where);
        } catch (Exception $e) {
            throw new Exception("Erro ao carregar anúncios favoritos!", $e->getCode());
        }
        
    }




        /**
     * Método responsável por buscar os anúncios favoritos de um usuário pelo seu ID
     *
     * @param int $userId
     * @return PDOStatement
     */
    public function getAllInformationsByUser(int $userId): PDOStatement{

        try {

            $fields = [
                "favorite.id as favoriteId",
                "favorite.advertisement as advertisementId",
                "favorite.user as userId",
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
                    "table" => "advertisement", 
                    "referencing" => "advertisement.id", 
                    "referenced" => "favorite.advertisement"
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



            $where = [
                "user = " => $userId
            ];

            return $this->db->select( $fields, $join, $where);
        } catch (Exception $e) {
            throw new Exception("Erro ao carregar anúncios favoritos!", $e->getCode());
        }
        
    }



    public function insert(array $fields) {

        try {

            return $this->db->insert($fields);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }


    public function delete($where) {

        try {

            return $this->db->delete($where);

        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }





}
