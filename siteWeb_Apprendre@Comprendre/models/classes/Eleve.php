<?php
require_once(dirname(__FILE__) . '/Personne.php');

class Eleve extends Personne
{
    /*
     * Attributs
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

        $sql = "SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,NE.nom as niveau_etude,image
                FROM Eleve E, NiveauEtude NE, Personne P
                WHERE E.id_personne = P.id and E.niveau_etude = NE.id
                LIMIT 8
                ;";
        $result = $bdd->query($sql);

        $bdd->close();

        return $result;
    }

    public static function getUtilisateur($id)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,date_inscription,type_personne,NE.nom as niveau_etude, telephone, adresse, mot_de_passe, image
                FROM Eleve E, NiveauEtude NE, Personne P
                WHERE E.id_personne = P.id
                      and E.niveau_etude = NE.id
                      and P.id='$id'
                ;";
        $result = $bdd->query($sql);

        $bdd->close();

        return $result;
    }

    /**
     * @return int
     */
    public static function getNombreEleves()
    {
        $nbEleve = 0;

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select count(*) as nbEleve from Eleve ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $nbEleve = $row['nbEleve'];
            }
        }

        $bdd->close();

        return $nbEleve;
    }

    public static function getMinAge()
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        $sql = "select max(date_naissance) as ageMin from Personne where type_personne='".Eleve::$TABLE_NAME."';";
        $result = $bdd->query($sql);
        $bdd->close();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return intval(date('Y', strtotime(date("Y") . " - " . date('Y', strtotime($row["ageMin"])) . " year")));
            }
        }
        return 0;
    }

    /**
     * @return bool|mysqli_result
     */
    public static function getMaxAge()
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "select min(date_naissance) as ageMax from Personne where type_personne='".Eleve::$TABLE_NAME."';";
        $result = $bdd->query($sql);
        $bdd->close();


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return intval(date('Y', strtotime(date("Y") . " - " . date('Y', strtotime($row["ageMax"])) . " year")));
            }
        }

        return 0;
    }

    public static function getMinDate()
    {
        $minDate = "2013-12";

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select min(date_inscription) as minDate from ".Personne::$TABLE_NAME." where type_personne='".Eleve::$TABLE_NAME."' ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $minDate = $row['minDate'];
            }
        }

        $bdd->close();

        return date('Y-M', strtotime($minDate));
    }

    public static function getMaxDate()
    {
        $minDate = "2013-12";

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select max(date_inscription) as maxDate from ".Personne::$TABLE_NAME." where type_personne='".Eleve::$TABLE_NAME."' ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $minDate = $row['maxDate'];
            }
        }

        $bdd->close();

        return date('Y-M', strtotime($minDate));
    }

    public static function countPersonneIncritBetweenDate($dateMin, $dateMax)
    {
        $dateTimeMin =  date('Y-m-d H:i:s', strtotime($dateMin));
        $dateTimeMax =  date('Y-m-d H:i:s', strtotime($dateMax));
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "select count(*) from ".Personne::$TABLE_NAME." where date_inscription < '$dateTimeMax' and date_inscription >='$dateTimeMin' and type_personne='".Eleve::$TABLE_NAME."'";
        echo $sql;
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
