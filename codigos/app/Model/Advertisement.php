<?php


namespace App\Model;


use \App\Core\Database;



class Advertisement {


    /**
     * ID do anúncio
     *
     * @var integer|null
     */
    public ?int $id;


    /**
     * ID da propriedade do anúncio
     *
     * @var integer
     */
    public int $property;


    /**
     * ID do usuário do anúncio
     *
     * @var integer
     */
    public int $user;


    /**
     * Título do anúncio
     *
     * @var string
     */
    public string $title;


    /**
     * Descrição do anúncio
     *
     * @var string
     */
    public string $description;


    /**
     * Caminho da pasta das imagens do anúncio
     *
     * @var string
     */
    public string $imagePath;


    /**
     * Valor do anúncio
     *
     * @var float
     */
    public float $businessValue;


    /**
     * Data de publicação do anúncio
     *
     * @var string
     */
    public string $publiDate;


    /**
     * Tipo de negociação
     *
     * @var string
     */
    public int $businessType;


    /**
     * Status da negociação
     *
     * @var string
     */
    public int $businessStatus;



}