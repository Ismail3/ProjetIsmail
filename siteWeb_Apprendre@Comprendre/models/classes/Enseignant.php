<?php
require_once(dirname(__FILE__) . '/Personne.php');

class Enseignant extends Personne
{
    /*
     * Attributs
     */
    private $id;
    private $typeEnseignant;
    public static $TABLE_NAME = "Enseignant";


    /**
     * Enseignant constructor.
     */
    public function __construct()
    {
    }

    public static function getUtilisateur($id)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,date_inscription,type_personne, telephone, adresse, mot_de_passe, image
                FROM Enseignant E, Personne P
                WHERE E.id_personne = P.id
                      and P.id='$id'
                ;";
        $result = $bdd->query($sql);

        $bdd->close();

        return $result;
    }

    /**
     * @return int
     */
    public static function getNombreEnseignants()
    {
        $nbEnseignant = 0;

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select count(*) as nbEnseignant from Enseignant ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $nbEnseignant = $row['nbEnseignant'];
            }
        }

        $bdd->close();

        return $nbEnseignant;
    }

    public static function getMinAge()
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        $sql = "select max(date_naissance) as ageMin from Personne where type_personne='".Enseignant::$TABLE_NAME."';";
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

        $sql = "select min(date_naissance) as ageMax from Personne where type_personne='".Enseignant::$TABLE_NAME."';";
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

        $sql = "select min(date_inscription) as minDate from ".Personne::$TABLE_NAME." where type_personne='".Enseignant::$TABLE_NAME."' ;";
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

        $sql = "select max(date_inscription) as maxDate from ".Personne::$TABLE_NAME." where type_personne='".Enseignant::$TABLE_NAME."' ;";
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

        $sql = "select count(*) from ".Personne::$TABLE_NAME." where date_inscription < '$dateTimeMax' and date_inscription >='$dateTimeMin' and type_personne='".Enseignant::$TABLE_NAME."'";
//        echo $sql;
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
     * @return string
     */
    public function getTypeEnseignant()
    {
        return $this->typeEnseignant;
    }

    /**
     * @param string $typeEnseignant
     */
    public function setTypeEnseignant($typeEnseignant)
    {
        $this->typeEnseignant = $typeEnseignant;
    }

    public function getListeDesCours()
    {
        $idEnseignant = $this->getIdPersonne();
        return Cours::getListeDesCoursEnseignant($idEnseignant);
//        $bd = new BdConnexion();
//
//        // Create connection
//        $bdd = $bd->openConn();
//        // Check connection
//        if ($bdd->connect_error) {
//            die("Connection failed: " . $bdd->connect_error);
//        }
//
//        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur, C.matiere, C.niveau_etude_min, C.niveau_etude_max, M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom, en_ligne
//                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax
//                WHERE C.id_auteur = " . $idEnseignant . " and M.id = C.matiere and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
//                ORDER BY date_creation DESC
//                LIMIT 5;";
//
//        $result = $bdd->query($sql);
//        $bdd->close();
//
//        return $result;

    }

    public function getListeMatièresEnseigner()
    {
        $idEnseignant = $this->getIdPersonne();
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT E.enseignant, M.nom as matiere, NE.nom as niveau_etude, NE.id as id_niveau_etude
                FROM Enseigner E, Matiere M, NiveauEtude NE
                WHERE E.enseignant = $idEnseignant and E.matiere = M.id and E.niveau_etude = NE.id
                ORDER BY matiere
                ;";

        $result = $bdd->query($sql);
        $bdd->close();

        return $result;
    }

    public function getListeSeanceCoursDemande(){
        $idEnseignant = $this->getIdPersonne();
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur,
                M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom,
                S.date_inscription, S.date_realisation, S.participant, S.duree, S.etat,
                P.nom as nom_auteur,P.prenom as prenom_auteur,P.email as email_auteur,P.date_naissance as date_naissance_auteur, P.type_personne as type_personne_auteur
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax, SeanceCours S, Personne P
                WHERE S.participant = $idEnseignant and M.id = C.matiere
                and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
                and S.proposition_cours = C.id and P.id = C.id_auteur
                ORDER BY date_realisation DESC
                LIMIT 5;
                ";
        $result = $bdd->query($sql);

        $bdd->close();

        return $result;
    }
    public function getListeSeanceCoursProposition()
    {
        $bd = new BdConnexion();
        $idEnseignant = $this->getIdPersonne();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur,
                M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom,
                S.date_inscription, S.date_realisation, S.participant, S.duree, S.etat,
                P.nom as nom_participant,P.prenom as prenom_participant,P.email as email_participant,P.date_naissance as date_naissance_participant, P.type_personne as type_personne_participant
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax, SeanceCours S, Personne P
                WHERE C.id_auteur = $idEnseignant and M.id = C.matiere
                and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
                and S.proposition_cours = C.id and P.id = S.participant
                ORDER BY date_realisation DESC
                LIMIT 5;";
        $result = $bdd->query($sql);

        $bdd->close();

        return $result;
    }


}
