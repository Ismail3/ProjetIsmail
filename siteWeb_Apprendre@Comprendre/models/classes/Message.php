<?php

class Mesage
{
    /*
     * Attributes
     */
    private $id;
    private $value;
    private $expediteur;
    private $receveur;
    private $dateEnvoie;

    /**
     * Mesage constructor.
     */
    public function __construct()
    {
    }

    /*
     * Getters and Setters
     */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getExpediteur()
    {
        return $this->expediteur;
    }

    /**
     * @param mixed $expediteur
     */
    public function setExpediteur($expediteur)
    {
        $this->expediteur = $expediteur;
    }

    /**
     * @return mixed
     */
    public function getReceveur()
    {
        return $this->receveur;
    }

    /**
     * @param mixed $receveur
     */
    public function setReceveur($receveur)
    {
        $this->receveur = $receveur;
    }

    /**
     * @return mixed
     */
    public function getDateEnvoie()
    {
        return $this->dateEnvoie;
    }

    /**
     * @param mixed $dateEnvoie
     */
    public function setDateEnvoie($dateEnvoie)
    {
        $this->dateEnvoie = $dateEnvoie;
    }
}
