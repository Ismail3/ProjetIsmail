<?php

class Eleve extends Personne
{
    /*
     * Attributes
     */
    private $niveauEtude;
    private $filiaire;

    /**
     * Eleve constructor.
     */
    public function __construct()
    {


    }

    /**
     * @return NiveauEtude
     */
    public function getNiveauEtude()
    {
        return $this->niveauEtude;
    }

    /**
     * @param NiveauEtude $niveauEtude
     */
    public function setNiveauEtude($niveauEtude)
    {
        $this->niveauEtude = $niveauEtude;
    }

    /**
     * @return Filiaire
     */
    public function getFiliaire()
    {
        return $this->filiaire;
    }

    /**
     * @param Filiaire $filiaire
     */
    public function setFiliaire($filiaire)
    {
        $this->filiaire = $filiaire;
    }
}
