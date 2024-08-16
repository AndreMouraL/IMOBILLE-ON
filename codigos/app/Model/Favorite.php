<?php


namespace App\Model;


use \App\Core\Database;


class Favorite {


    /**
     * ID do favorito
     *
     * @var integer|null
     */
    public ?int $id;


    /**
     * ID do anúncio do favorito
     *
     * @var integer
     */
    public int $advertisement;


    /**
     * ID do usuário do favorito
     *
     * @var integer
     */
    public int $user;

}
