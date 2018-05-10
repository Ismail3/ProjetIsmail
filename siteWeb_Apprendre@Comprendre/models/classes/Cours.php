<?php
require_once(dirname(__FILE__) . '/AbstractModel.php');

class Cours extends AbstractModel
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

    public static function getListeDesCours()
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
                LIMIT 5;";
        $result = $bdd->query($sql);

        $bdd->close();
    }
}
