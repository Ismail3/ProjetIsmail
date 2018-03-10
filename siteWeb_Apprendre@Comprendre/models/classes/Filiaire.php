<?php

class Filiaire
{
    /*
     * Attributes
     */
    private $id;
    private $nom;

    /**
     * Filiaire constructor.
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




}
