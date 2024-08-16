<?php

namespace App\Model;

use DateTime;
use App\Session\Session;

class User
{

  /**
   * Id do usuário
   *
   * @var integer
   */
  private int $id;


  /**
   * Primeiro nome do usuário
   *
   * @var string
   */
  private string $firstName;


  /**
   * Sobrenome do usuário
   *
   * @var string
   */
  private string $lastName;


  /**
   * Email do usuário
   *
   * @var string
   */
  private string $email;


  /**
   * Data de nascimento do usuário
   *
   * @var string
   */
  private string $birthDate;


  /**
   * Senha do usuário
   *
   * @var string
   */
  private string $password;


  /**
   * CPF do usuário
   *
   * @var string
   */
  private string $cpf;


  /**
   * Telefone do usuário
   *
   * @var string
   */
  private string $phone;

  /**
   * Instagram do usuário
   *
   * @var string
   */
  private string $instagram;


  /**
   * Whatsapp do usuário
   *
   * @var string
   */
  private string $whatsapp;


  /**
   * Data de cadastro do usuário
   *
   * @var string
   */

  private string $registerDate;


  /**
   * Caminho da foto de perfil do usuário
   *
   * @var string
   */
  private string $imagePath;


  /**
   * Privilégio do Usuário (Usuário, Moderador ou Administrador)
   *
   * @var string
   */
  private string $privilege;


  /**
   * Id da faixa salarial do usuário
   *
   * @var integer|null
   */
  private ?int $salaryRange;

  /**
   * Status Civil do usuário (Solteiro, Casado, Separado, Divorciado, Viúvo, União Estável, Outro)
   *
   * @var string
   */
  private ?string $maritalStatus;


  /**
   * Quantidade de filhos do usuário
   *
   * @var integer|null
   */
  private ?int $children;


  /**
   * Quantidade de automóveis
   *
   * @var integer|null
   */
  private ?int $automobiles;


  /**
   * Situação do usuário na plataforma (ativo/inativo)
   *
   * @var integer
   */
  private int $actived;


  /**
   * Id do endereço do usuário
   *
   * @var integer|null
   */
  private ?int $address;



  /**
   * Método responsável por retornar o ID do usuário
   *
   * @return integer
   */
  public function getId(): int
  {
    return $this->id;
  }


  /**
   * Método responsável por atribuir um ID ao usuário
   *
   * @param integer $id
   * @return void
   */
  public function setId(int $id): void
  {
    $this->id = $id;
  }


  /**
   * Método responsável por retornar o primeiro nome do usuário
   *
   * @return string
   */
  public function getFirstName(): string
  {
    return $this->firstName;
  }


  /**
   * Método responsável por atribuir o primeiro do nome do usuário
   *
   * @param string $firstName
   * @return void
   */
  public function setFirstName(string $firstName): void
  {
    $this->firstName = $firstName;
  }

  /**
   * Método responsável por retornat o sobrenome do usuário
   *
   * @return string
   */
  public function getLastName(): string
  {
    return $this->lastName;
  }


  /**
   * Método responsável por atribuir um sobrenome ao usuário
   *
   * @param string $lastName
   * @return void
   */
  public function setLastName(string $lastName): void
  {
    $this->lastName = $lastName;
  }


  /**
   * Método responsável por retornar o email do usuário
   *
   * @return string
   */
  public function getEmail(): string
  {
    return $this->email;
  }


  /**
   * Método responsável por atribuir um email ao usuário
   *
   * @param string $email
   * @return void
   */
  public function setEmail(string $email): void
  {
    $this->email = $email;
  }


  /**
   * Método responsável por retonar a data de nascimento do usuário
   *
   * @return string
   */
  public function getBirthDate(): string
  {
    return $this->birthDate;
  }


  /**
   * Método responsável por atribuir a data de nascimento do usuário
   *
   * @param string $birthDate
   * @return void
   */
  public function setBirthDate(string $birthDate): void
  {
    $this->birthDate = $birthDate;
  }


  /**
   * Método responsável por retornar a senha do usuário
   *
   * @return string
   */
  public function getPassword(): string
  {
    return $this->password;
  }

  /**
   * Método responsável por atribuir uma senha ao usuário
   * 
   * @param string $password
   * @return void
   */

  public function setPassword(string $password): void
  {
    $this->password = $password;
  }


  /**
   * Método responsável por retornar o cpf do usuário
   *
   * @return string
   */
  public function getCpf(): string
  {
    return $this->cpf;
  }


  /**
   * Método responsável por atribuir um cpf ao usuário
   *
   * @param string $cpf
   * @return void
   */
  public function setCpf(string $cpf): void
  {
    $this->cpf = $cpf;
  }


  /**
   * Método responsável por retornar o telefone do usuário
   *
   * @return string
   */
  public function getPhone(): string
  {
    return $this->phone;
  }


  /**
   * Método responsável por atribuir um telefone ao usuário
   *
   * @param string $phone
   * @return void
   */
  public function setPhone(string $phone): void
  {
    $this->phone = $phone;
  }


  /**
   * Método responsável por retornar o instagram do usuário
   *
   * @return string
   */
  public function getInstagram(): string
  {
    return $this->instagram;
  }


  /**
   * Método responsável por atribuir um sinatgram ao usuário
   *
   * @param string $instagram
   * @return void
   */
  public function setInstagram(string $instagram): void
  {
    $this->instagram = $instagram;
  }


  /**
   * Método responsável por retornar o whatsapp do usuário
   *
   * @return string
   */
  public function getWhatsapp(): string
  {
    return $this->whatsapp;
  }


  /**
   * Método responsável por atribuir um whatsapp ao usuário
   *
   * @param string $whatsapp
   * @return void
   */
  public function setWhatsapp(string $whatsapp): void
  {
    $this->whatsapp = $whatsapp;
  }


  /**
   * Método responsável por retornar a data de registro do usuário
   *
   * @return string
   */
  public function getRegisterDate(): string
  {
    return $this->registerDate;
  }


  /**
   * Método responsável por atribuir uma data de registro ao usuário
   *
   * @param string $registerDate
   * @return void
   */
  public function setRegisterDate(string $registerDate): void
  {
    $this->registerDate = $registerDate;
  }


  /**
   * Método responsável por retonar o caminho da imagem de perfil do usuário
   *
   * @return string
   */
  public function getImagePath(): string
  {
    return $this->imagePath;
  }


  /**
   * Método responsável por atribuir um caminho para a foto de perfil do usuário
   *
   * @param string $imagePath
   * @return void
   */
  public function setImagePath(string $imagePath): void
  {
    $this->imagePath = $imagePath;
  }


  /**
   * Método responsável por retornar o nível de privilégio do usuário
   *
   * @return string
   */
  public function getPrivilege(): string
  {
    return $this->privilege;
  }


  /**
   * Método responsável por atribuir um nível de privilégio sao usuário
   *
   * @param string $privilege
   * @return void
   */
  public function setPrivilege(string $privilege): void
  {
    $this->privilege = $privilege;
  }


  /**
   * Método responsável por retonar a faixa salarial do usuário
   *
   * @return integer|null
   */
  public function getSalaryRange(): ?int
  {
    return $this->salaryRange;
  }


  /**
   * Método responsável por atribuir uma faixa salarial ao usuário
   *
   * @param integer|null $salaryRange
   * @return void
   */
  public function setSalaryRange(?int $salaryRange): void
  {
    $this->salaryRange = $salaryRange;
  }


  /**
   * Método responsável por retornar o status civil do usuário
   *
   * @return string|null
   */
  public function getMaritalStatus(): ?string
  {
    return $this->maritalStatus;
  }


  /**
   * Método responsável por atribuir um status civil ao usuário
   *
   * @param string|null $maritalStatus
   * @return void
   */
  public function setMaritalStatus(?string $maritalStatus): void
  {
    $this->maritalStatus = $maritalStatus;
  }


  /**
   * Método responsável por retonar a quantidade de filhos do usuário
   *
   * @return integer|null
   */
  public function getChildren(): ?int
  {
    return $this->children;
  }


  /**
   * Métodod responsável por atribuir a quantidade de filhos do usuário
   *
   * @param integer|null $children
   * @return void
   */
  public function setChildren(?int $children): void
  {
    $this->children = $children;
  }


  /**
   * Método responsável por retornar a quantidade de automóveis do usuário
   *
   * @return integer|null
   */
  public function getAutomobiles(): ?int
  {
    return $this->automobiles;
  }


  /**
   * Método responsável por atribuir a quantidade de automóveis do usuário
   *
   * @param integer|null $automobiles
   * @return void
   */
  public function setAutomobiles(?int $automobiles): void
  {
    $this->automobiles = $automobiles;
  }


  /**
   * Método responsável por retonar o status de atividade do usuário na plataforma
   *
   * @return integer|null
   */
  public function getActived(): ?int
  {
    return $this->actived;
  }


  /**
   * Método responsável por atribuir um status de atividade ao usuário
   *
   * @param integer $actived
   * @return void
   */
  public function setActived(int $actived): void
  {
    $this->actived = $actived;
  }


  /**
   * Método responsável por retornar o ID do endereço do usuário
   *
   * @return integer|null
   */
  public function getAddress(): ?int
  {
    return $this->address;
  }


  /**
   * Método responsável por atribuir o ID do endereço do usuário
   *
   * @param integer|null $address
   * @return void
   */
  public function setAddress(?int $address): void
  {
    $this->address = $address;
  }



  /**
   * Método responsável por setar os atributos obrigatórios ao cadstro de usuário
   *
   * @param array $userData
   * @return void
   */
  public function register(array $userData): void
  {
    $this->firstName = $userData["firstName"];
    $this->lastName = $userData["lastName"];
    $this->email = $userData["email"];
    $this->birthDate = $userData["birthDate"];
    $this->password = $userData["password"];
    $this->cpf = $userData["cpf"];
    $this->phone = $userData["phone"];
    $this->instagram = $userData["instagram"];
    $this->whatsapp = $userData["whatsapp"];
    $this->registerDate =  $userData["registerDate"];
    $this->imagePath = $userData["imagePath"];
    $this->privilege = $userData["privilege"];
  }



  /**
   * Método responsável por logar o usuário no sistema, atribuindo os seus dados de sessão
   *
   * @return void
   */
  public function login(): void
  {
    (new Session())->init();

    $_SESSION["user"] = [
      "id" => $this->id ?? "",
      "firstName" => $this->firstName ?? "",
      "lastName" => $this->lastName ?? "",
      "email" => $this->email ?? "",
      "cpf" => $this->cpf ?? "",
      "imagePath" => $this->imagePath ?? "",
      "privilege" => $this->privilege ?? "",
      "logged" => true
    ];
  }



  /**
   * Método responsável por retonar as informações de sessão do usuário
   *
   * @return array|string
   */
  public function getLoggedInfo()
  {
    (new Session())->init();
    return $_SESSION["user"] ?? "";
  }


  /**
   * Método responsável por setar as informações de sessão do usuário
   *
   * @return void
   */
  public function setLoggedInfo()
  {
    (new Session())->init();
    $this->id = $_SESSION["user"]["id"] ?? "";
    $this->firstName = $_SESSION["user"]["firstName"] ?? "";
    $this->lastName = $_SESSION["user"]["lastName"] ?? "";
    $this->email = $_SESSION["user"]["email"] ?? "";
    $this->cpf = $_SESSION["user"]["cpf"] ?? "";
    $this->imagePath = $_SESSION["user"]["imagePath"] ?? "";
    $this->privilege =  $_SESSION["user"]["privilege"] ?? "";
  }


  /**
   * Método responsável por verificar se o usuário é um usuário comum
   *
   * @return boolean
   */
  public function isCommon()
  {
    (new Session())->init();
    return $this->isLogged() && $_SESSION["user"]["privilege"] == "Usuário";
  }


  /**
   * Método responsável por verificar se o usuário é um administrador
   *
   * @return boolean
   */
  public function isAdmin()
  {
    (new Session())->init();
    return $this->isLogged() && $_SESSION["user"]["privilege"] == "Administrador";
  }


  /**
   * Método responsável por verificar se o usuário é um moderador
   *
   * @return boolean
   */
  public function isMode()
  {
    (new Session())->init();
    return $this->isLogged() && $_SESSION["user"]["privilege"] == "Moderador";
  }


  /**
   * Método responsável por remover as variáveis e destruit a sessão do usuário, deslogando-o
   *
   * @return void
   */
  public function logout()
  {
    $sessionName = sha1("imobile_on" . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

    (new Session())->init();
    unset($_SESSION["user"]);
    $_SESSION['destroyed'] = time();
    setcookie($sessionName, "", time() - 3600, "/");
  }



  /**
   * Método que verifica se o usuário está logado
   *
   * @return boolean
   */
  public function isLogged()
  {
    (new Session())->init();
    return isset($_SESSION["user"]["logged"]) && $_SESSION["user"]["logged"] == true;
  }
}
