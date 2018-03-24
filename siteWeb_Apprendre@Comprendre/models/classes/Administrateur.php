<?php

class Administrateur extends Personne
{
    /*
     * Attributes
     */
    private $id;
    public static $TABLE_NAME="Administrateur";


    /**
     * Administrateur constructor.
     */
    public function __construct()
    {
    }


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



}
