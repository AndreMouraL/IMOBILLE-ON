<?php

namespace App\Session;


use Exception;

class Session {

    /**
     * Método responsável por iniciar uma sessão não ativa
     *
     * @return void
     */
    public function init() {

        //VERIFICA SE A SESSÃO NÃO ESTÁ ATIVA
        if(session_status() !== PHP_SESSION_ACTIVE){

            //INICIA E REGENERA O ID DA SESSÃO
            $this->start();
            $this->regenerate_id();
        }
    }


    /**
     * Método responsável por iniciar uma sessão
     *
     * @return void
     */
    private function start() {

        //DEFINE O E ATRIBUI O NOME DA SESSÃO
        $sessionName = sha1("imobile_on" . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
        session_name($sessionName);

        //INICIA A SESSÃO
        session_start();

        //EXPIRA A SESSÃO SE ESTA JÁ TIVER SIDO DESTRUÍDA ANTERIOMENTE
        if (isset($_SESSION['destroyed'])) {

            unset($_SESSION["user"]);
            setcookie($sessionName, "", time() - 3600, "/");
            throw new Exception("Sessão expirada", 403);
       }

    }


    /**
     * Método responsável por regenerar a sessão 
     *
     * @return void
     */
    private function regenerate_id() {

        //DEFINE O NOME DA SESSÃO
        $sessionName = sha1("imobile_on" . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

        //RECUPERA OS DADOS DE SESSÃO
        $sessionAttributes = $_SESSION;

        //REMOVE OS DADOS DE SESSÃO CASO O USUÁRIO ESTEJA LOGADO
        if (isset($_SESSION["user"])){
            unset($_SESSION["user"]);
        }

        //ADICIONA A CHAVE DESTROYED AOS DADOS DE SESSÃO, CONTENDO O UNIX TIMESTAMP DO MOMENTO DE ENCERRAMENTO
        $_SESSION["destroyed"] = time();

        //GERA UM ID VÁLIDO DE SESSÃO
        $newSessionId = session_create_id();

        //ENCERRA A SESSÃO DE FATO, SETANDO UM TEMPO DE EXPIRAÇÃO DO PASSADO AO COOKIE DE SESSÃO
        session_commit();
        setcookie($sessionName, "", time() - 3600, "/");

        //INICIA UMA SESSÃO COM O NOVO ID, COM O NOME DEFINIDO E COM A PROPRIEDADE USE STRICT MODE DESATIVADA
        session_id($newSessionId);
        ini_set("session.use_strict_mode", 0);
        session_name($sessionName);
        session_start();

        //SETA OS DADOS DE SESSÃO DA SESSÃO ANTERIOR
        $_SESSION = $sessionAttributes;

        //PAUSA A SESSÃO  TEMPORIAMENTE PARA ATIVAR A PROPRIEDADE USE STRICT MODE
        session_commit();
        ini_set("session.use_strict_mode", 1);

        //REINICIA A SESSÃO
        session_name($sessionName);
        session_start();

    }






}