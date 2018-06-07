<?php
require_once(dirname(__FILE__) . '/AbstractModel.php');

/**
 * Class Cours
 */
class Cours extends AbstractModel
{
    /*
     * Attributs
     */
    /**
     * @var
     */
    protected $id;
    /**
     * @var
     */
    protected $nom;
    /**
     * @var
     */
    protected $description;
    /**
     * @var
     */
    protected $tarif;
    /**
     * @var
     */
    protected $dateProposition;
    /**
     * @var
     */
    protected $auteur;
    /**
     * @var
     */
    protected $typeAuteur;
    /**
     * @var
     */
    protected $matiere;
    /**
     * @var
     */
    protected $niveauEtude;
    /**
     * @var string
     */
    public static $TABLE_NAME = "Cours";

    /**
     * Cours constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public static function getNombreCours()
    {
        $nbCours = 0;

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select count(*) as nbCours from Cours ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $nbCours = $row['nbCours'];
            }
        }

        $bdd->close();

        return intval($nbCours);
    }

    /**
     * @param $idMatiere
     * @return int
     */
    public static function getNbCoursParMatiere($idMatiere)
    {
        $nbCours = 0;

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select count(*) as nbCours from Cours where matiere=" . $idMatiere . " ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $nbCours = $row['nbCours'];
            }
        }

        $bdd->close();

        return intval($nbCours);
    }

    public static function getNbCoursParNiveauEtude($idNiveauEtude)
    {
        $nbCours = 0;

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select count(*) as nbCours from Cours where niveau_etude_min=" . $idNiveauEtude . " ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $nbCours = $row['nbCours'];
            }
        }

        $bdd->close();

        return intval($nbCours);
    }

    public static function supprCours($idCours)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "Delete from Cours
                WHERE id=$idCours
                ;";

        echo $sql;


        $mysqli_result = $bdd->query($sql);
        $bdd->close();

        echo $mysqli_result;
        return $mysqli_result;
    }

    public static function recherche($valeurRecherchee)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id as id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur, C.matiere, C.niveau_etude_min, C.niveau_etude_max, M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax
                WHERE M.id = C.matiere and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max and C.nom like '%" . $valeurRecherchee . "%' and en_ligne=1
                ORDER BY date_creation DESC";

        $result = $bdd->query($sql);

        $bdd->close();

        return $result;
    }

    /*
     * Getter & Setter
     */

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

    /*
     * Méthodes
     */

    /**
     * Cette fonction permet de créer un nouveau à partir d'un ensemble de données
     *
     * @param $enseignant
     * @param $nom
     * @param $description
     * @param $tarif
     * @param $matiere
     * @param $niveauEtudeMin
     * @param $niveauEtudeMax
     * @return int|mixed
     */
    public static function nouveauCours($enseignant, $nom, $description, $tarif, $matiere, $niveauEtudeMin, $niveauEtudeMax)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $id_cours = -1;
        $id_auteur = $enseignant->getIdPersonne();

        $sql = "INSERT INTO " . Cours::$TABLE_NAME . " (nom, description, tarif, id_auteur, matiere, niveau_etude_min, niveau_etude_max)
                VALUES ('$nom','$description',$tarif,$id_auteur,$matiere,$niveauEtudeMin,$niveauEtudeMax)
                ;";

//        echo $sql;

        if ($bdd->query($sql) === TRUE) {
            $id_cours = $bdd->insert_id;
        }
        $bdd->close();
        return $id_cours;
    }

    /**
     * Cette fonction permet de changer de le statut d'un cours, il passe en ligne si il était hors ligne et la réciproque
     *
     * @param $id
     * @param $en_ligne
     * @return bool|mysqli_result
     */
    public static function publierCours($id, $en_ligne)
    {

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "UPDATE Cours
                SET en_ligne='$en_ligne'
                WHERE id=$id
                ;";

//        echo $sql;

        $query = $bdd->query($sql);
        $bdd->close();
        return $query;
    }

    /**
     * Cette fonction permet de modifier les informations relatives à un cours déja créé
     *
     * @param $id
     * @param $enseignant
     * @param $nomCours
     * @param $descriptionCours
     * @param $tarifCours
     * @param $matiereCours
     * @param $niveauEtudeMinCours
     * @param $niveauEtudeMaxCours
     * @param $enLigne
     * @return int|mixed
     */
    public static function majCours($id, $enseignant, $nomCours, $descriptionCours, $tarifCours, $matiereCours, $niveauEtudeMinCours, $niveauEtudeMaxCours, $enLigne)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "UPDATE Cours
                SET id_auteur=$enseignant, nom='$nomCours', description='$descriptionCours', tarif=$tarifCours, matiere=$matiereCours, niveau_etude_min=$niveauEtudeMinCours, niveau_etude_max=$niveauEtudeMaxCours, en_ligne=$enLigne
                WHERE id=$id
                ;";

//        echo $sql;


        if ($bdd->query($sql) === TRUE) {
            $id_cours = $bdd->insert_id;
        } else {
            $id_cours = -1;
        }
        $bdd->close();
        echo $id_cours;
        return $id_cours;
    }

    /**
     * Cette fonction permet de récupérer un cour déja créé à partir de son id
     *
     * @param $idCours
     * @return bool|mysqli_result
     */
    public static function getCours($idCours)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur, C.matiere, C.niveau_etude_min, C.niveau_etude_max, M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom, C.en_ligne
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax
                WHERE M.id = C.matiere and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max and C.id = $idCours
                ;";
//        echo "<br/><br/><br/>";
//        echo $sql;
        $result = $bdd->query($sql);

        $bdd->close();

        return $result;
    }

    /**
     * Cette fonction permet d'obtenir la liste de tous les cours
     *
     * @return bool|mysqli_result
     */
    public static function getListeDesCours($limit)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur, C.matiere, C.niveau_etude_min, C.niveau_etude_max, M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax
                WHERE M.id = C.matiere and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
                ORDER BY date_creation DESC
                LIMIT $limit;";
        $result = $bdd->query($sql);

        $bdd->close();

        return $result;
    }

    /**
     * Cette fonction permet d'obtenir la liste des cours d'un enseignant
     *
     * @param $idpersonne
     * @return bool|mysqli_result
     */
    public static function getListeDesCoursEnseignant($idpersonne)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur, C.matiere, C.niveau_etude_min, C.niveau_etude_max, M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom, en_ligne
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax
                WHERE M.id = C.matiere and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max and C.id_auteur = " . $idpersonne . "
                ORDER BY date_creation DESC";
        $result = $bdd->query($sql);

        $bdd->close();

        return $result;
    }
}
