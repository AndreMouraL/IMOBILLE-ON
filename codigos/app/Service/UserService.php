<?php

namespace App\Service;

use App\Model\User;
use App\Repository\UserRepository;
use \Exception;

class UserService
{

    /**
     * Instância de UserRepository
     *
     * @var UserRepository
     */
    private UserRepository $userRepository;


    /**
     * Construtor da classe
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Método responsável por cadastrar um usuário
     *
     * @param array $userData
     * @return integer
     */
    public function registerUser(array $userData): int
    {

        try {
            //$this->validateUserData($userData);

            $user = new User();
            $user->register($userData);

            return $this->userRepository->insert($user);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }



    public function loginUser(string $identifier, string $password)
    {
        try{

           $statement = $this->userRepository->getByIdentifier($identifier);

           if ($statement->rowCount() == 0) {
                throw new Exception("Credenciais inválidas", 401); 
           }


           $user = $statement->fetchObject(User::class);


           if(!password_verify($password, $user->getPassword())) {
                throw new Exception("Credenciais inválidas", 401); 
           }


           if($user->getActived() == 0) {
                throw new Exception("Serviço indisponível", 401); 
           }

           $user->login();

        }catch (Exception $e){
            throw new Exception($e->getMessage(), $e->getCode());
        }

    }



    public function getUserById(int $id): ?User
    {
        try {
            $statement = $this->userRepository->getById($id);
            if ($statement->rowCount() == 0) {
                return null;
            }
            return $statement->fetchObject(User::class);
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar usuário", $e->getCode());
        }
    }



    private function validateUserData(array $userData)
    {
        if (empty($userData['firstName']) || empty($userData['lastName']) || empty($userData['email']) || empty($userData['password']) || empty($userData['cpf']) || empty($userData['phone'])) {
            throw new \InvalidArgumentException('Todos os campos obrigatórios devem ser preenchidos.');
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('O e-mail informado não é válido.');
        }
    }
}
