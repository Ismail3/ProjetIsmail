<?php

class Cours
{
    /*
     * Attributes
     */
    protected $id;
    protected $nom;
    protected $description;
    protected $tarif;
    protected $dateProposition;
    protected $auteur;
    protected $typeAuteur;
    protected $matiere;
    protected $niveauEtude;

    /**
     * Cours constructor.
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * @param float $tarif
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;
    }

    /**
     * @return date
     */
    public function getDateProposition()
    {
        return $this->dateProposition;
    }

    /**
     * @param date $dateProposition
     */
    public function setDateProposition($dateProposition)
    {
        $this->dateProposition = $dateProposition;
    }

    /**
     * @return Personne
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param Personne $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * @return Matiere
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param Matiere $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
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
     * 0 : enseignant
     * 1 : eleve
     * @return int
     */
    public function getTypeAuteur()
    {
        return $this->typeAuteur;
    }

    /**
     * 0 : enseignant
     * 1 : eleve
     * @param int $typeAuteur
     */
    public function setTypeAuteur($typeAuteur)
    {
        $this->typeAuteur = $typeAuteur;
    }
}
