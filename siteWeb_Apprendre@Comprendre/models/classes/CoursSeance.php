<?php
require_once(dirname(__FILE__) . '/AbstractModel.php');

class CoursSeance extends AbstractModel
{
    /*
     * Attributs
     */
    private $id;
    private $cours;
    private $dateRealisation;
    private $duree;
    private $etat;
    private $listInscrit;

    /*
     * Constructeur
     */
    public function __construct()
    {
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

    /**
     * CoursSeance Methodes
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

    /*
     * Méthodes
     */

    /**
     *
     */
    public static function getListeDesSeancesCoursProposition()
    {
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
                P.nom as nom_participant,P.prenom as prenom_participant,P.email as email_participant,P.date_naissance as date_naissance_participant, P.type_personne as type_personne_participant
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax, SeanceCours S, Personne P
                WHERE M.id = C.matiere
                and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
                and S.proposition_cours = C.id and P.id = S.participant
                ORDER BY date_realisation DESC
                LIMIT 5;";
        $result = $bdd->query($sql);
        $bdd->close();
    }

    public static function getListeDesSeancesCoursDemande()
    {
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
                WHERE M.id = C.matiere
                and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
                and S.proposition_cours = C.id and P.id = C.id_auteur
                ORDER BY date_realisation DESC
                LIMIT 5;
                ";
        $result = $bdd->query($sql);

        $bdd->close();
    }
}