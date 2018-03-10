<?php

class Enseignant extends Personne
{
    /*
     * Attributes
     */
    private $typeEnseignant;

    /**
     * Enseignant constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return string     */
    public function getTypeEnseignant()
    {
        return $this->typeEnseignant;
    }

    /**
     * @param string$typeEnseignant
     */
    public function setTypeEnseignant($typeEnseignant)
    {
        $this->typeEnseignant = $typeEnseignant;
    }




}
