<?php
require_once(dirname(__FILE__) . '/Personne.php');

class Eleve extends Personne
{
    /*
     * Attributes
     */
    private $id;
    private $niveauEtude;
    private $filiaire;
    public static $TABLE_NAME="Eleve";

    /**
     * Eleve constructor.
     */
    public function __construct()
    {

    }

    public static function getListeEleves()
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,NE.nom as niveau_etude
                FROM Eleve E, NiveauEtude NE, Personne P
                WHERE E.id_personne = P.id and E.niveau_etude = NE.id
                LIMIT 8
                ;";
        $result = $bdd->query($sql);

        $bdd->close();

        return $result;
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

    public function __toString()
    {
        $toString = parent::__toString(); // TODO: Change the autogenerated stub

        $toString = $toString . "niveau_etude : " . $this->niveauEtude;
        $toString = $toString . "<br>";
        return $toString;
    }


}
