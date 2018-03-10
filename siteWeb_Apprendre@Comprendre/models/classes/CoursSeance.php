<?php

class CoursSeance
{
    /*
     * Attributes
     */
    private $id;
    private $cours;
    private $dateRealisation;
    private $duree;
    private $etat;
    private $listInscrit;

    /**
     * CoursSeance constructor.
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

    /**
     * @return Cours
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * @param Cours $cours
     */
    public function setCours($cours)
    {
        $this->cours = $cours;
    }

    /**
     * @return date
     */
    public function getDateRealisation()
    {
        return $this->dateRealisation;
    }

    /**
     * @param date $dateRealisation
     */
    public function setDateRealisation($dateRealisation)
    {
        $this->dateRealisation = $dateRealisation;
    }

    /**
     * @return float
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param float $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * 0 : propose
     * 1 : accepte
     * -1 : refuse
     * @return int
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * 0 : propose
     * 1 : accepte
     * -1 : refuse
     * @param int $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getListInscrit()
    {
        return $this->listInscrit;
    }

    /**
     * @param mixed $listInscrit
     */
    public function setListInscrit($listInscrit)
    {
        $this->listInscrit = $listInscrit;
    }
}