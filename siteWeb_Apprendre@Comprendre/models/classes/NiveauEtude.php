<?php

class NiveauEtude
{
    /*
     * Attributes
     */
    public static $TABLE_NAME="NiveauEtude";
    private $id;
    private $nom;
    private $value;

    /**
     * NiveauEtude constructor.
     */
    public function __construct()
    {
    }

    /*
     * Getters and Setters
     */

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
