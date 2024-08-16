<?php

namespace App\Repository;

use App\Model\User;
use App\Core\Database;
use \Exception;
use PDOStatement;

class UserRepository
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
     * Método responsável por inserir o usuário no banco de dados
     *
     * @param User $user
     * @return integer
     */
    public function insert(User $user)
    {

        try {
            $fields = [
                "firstName" => $user->getfirstName(),
                "lastName" => $user->getlastName(),
                "email" => $user->getEmail(),
                "birthDate" => $user->getBirthDate(),
                "password" => $user->getPassword(),
                "cpf" => $user->getCpf(),
                "phone" => $user->getPhone(),
                "instagram" => $user->getInstagram(),
                "whatsapp" => $user->getWhatsapp(),
                "registerDate" => $user->getRegisterDate(),
                "privilege" => $user->getPrivilege()
            ];

            return $this->db->insert($fields);
        } catch (Exception $e) {
            throw new Exception("Erro ao cadastrar usuário", $e->getCode());
        }
    }


    /**
     * Método responsável por buscar informações de um usuário pelo identificador (email ou cpf)
     *
     * @param string $identifier
     * @return PDOStatement
     */
    public function getByIdentifier($identifier): PDOStatement
    {
        try {

            $where = [
                "email = " => $identifier,
                "OR cpf = " => $identifier
            ];

            return $this->db->select(["*"], [], $where);
        } catch (Exception $e) {
            throw new Exception("Erro ao carregar usuário!", $e->getCode());
        }
    }



    /**
     * Método responsável por buscar informações de um usuário pelo ID
     *
     * @param string $identifier
     * @return PDOStatement
     */
    public function getById(int $id): PDOStatement
    {
        try {
            $where = ["id = " => $id];
            return $this->db->select(["*"], [], $where);
        } catch (Exception $e) {
            throw new Exception("Erro ao carregar usuário!", $e->getCode());
        }
    }


}
