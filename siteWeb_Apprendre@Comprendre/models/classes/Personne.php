<?php

class Personne
{
    /*
     * Attributes
     */
    protected $id_personne;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $dateNaissance;
    protected $motDePasse;
    protected $image;
    protected $dateInscription;

    /**
     * Personne constructor.
     */
    public function __construct()
    {
    }

    /*
     * Getters & Setters
     */

    /**
     * @return int
     */
    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    /**
     * @param int $id_personne
     */
    public function setIdPersonne($id_personne)
    {
        $this->id_personne = $id_personne;
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return date
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param date $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * @param string $motDePasse
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return date
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param date $dateInscription
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $toString = "";
        $toString = $toString . "id_personne : " . $this->id_personne;
        $toString = $toString . "<br>";
        $toString = $toString . "nom : " . $this->nom;
        $toString = $toString . "<br>";
        $toString = $toString . "prenom : " . $this->prenom;
        $toString = $toString . "<br>";
        $toString = $toString . "email : " . $this->email;
        $toString = $toString . "<br>";
        $toString = $toString . "dateNaissance : " . $this->dateNaissance;
        $toString = $toString . "<br>";
        $toString = $toString . "motDePasse : " . $this->motDePasse;
        $toString = $toString . "<br>";
        $toString = $toString . "image : " . $this->image;
        $toString = $toString . "<br>";
        $toString = $toString . "dateInscription : " . $this->dateInscription;
        $toString = $toString . "<br>";
        return $toString;
    }


}
