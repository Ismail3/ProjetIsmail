<?php
require_once(dirname(__FILE__) . '/../basesDeDonnées/BdConnexion.php');


class Personne
{

    /*
     * Attributes
     */
    public static $DEFAULT_IMAGE ="team0.jpg";
    protected $id_personne;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $telephone;
    protected $adresse;
    protected $dateNaissance;
    protected $motDePasse;
    protected $image;
    protected $dateInscription;
    protected $type_personne;

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
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }



    /**
     * @return string
     */
    public function getTypePersonne()
    {
        return $this->type_personne;
    }

    /**
     * @param string $type_personne
     */
    public function setTypePersonne($type_personne)
    {
        $this->type_personne = $type_personne;
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
        $toString = $toString . "telephone : " . $this->telephone;
        $toString = $toString . "<br>";
        $toString = $toString . "telephone : " . $this->telephone;
        $toString = $toString . "<br>";
        $toString = $toString . "dateNaissance : " . $this->dateNaissance;
        $toString = $toString . "<br>";
        $toString = $toString . "motDePasse : " . $this->motDePasse;
        $toString = $toString . "<br>";
        $toString = $toString . "image : " . $this->image;
        $toString = $toString . "<br>";
        $toString = $toString . "dateInscription : " . $this->dateInscription;
        $toString = $toString . "<br>";
        $toString = $toString . "type_personne : " . $this->type_personne;
        $toString = $toString . "<br>";
        return $toString;
    }


}
