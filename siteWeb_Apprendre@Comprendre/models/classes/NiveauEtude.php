<?php
require_once(dirname(__FILE__) . '/AbstractModel.php');

class NiveauEtude extends AbstractModel
{
    /*
     * Attributs
     */
    public static $TABLE_NAME="NiveauEtude";
    private $id;
    private $nom;
    private $value;

    /**
     * NiveauEtude constructor.
     */
    public function __construct()
    {
    }

    /*
     * Méthodes
     */

    public static function getListeNiveauEtude()
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select * from " . NiveauEtude::$TABLE_NAME ;//. " where id!=11;";
        $result = $bdd->query($sql);
        $bdd->close();

        return $result;
    }

    public static function getListeNbCoursNiveauEtude()
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "SELECT NE.nom, count(*) as nb
                FROM NiveauEtude NE, Cours C, SeanceCours SC
                WHERE NE.nom like '%'
                and C.niveau_etude_min <= NE.id
                and C.niveau_etude_max >= NE.id
                and C.id = SC.proposition_cours
                group by NE.id
                order by NE.id
                ;
";
//        echo $sql;
        $result = $bdd->query($sql);
        $bdd->close();

        return $result;
    }

    /*
     * Getters and Setters
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
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getNiveauEtudeNom($niveau_etude)
    {
        $niveau_etude_nom = '';
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT nom
                FROM NiveauEtude
                WHERE id = $niveau_etude
                ;";

        $result = $bdd->query($sql);

        $bdd->close();

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $niveau_etude_nom = $row['nom'];
            }
        } else {
            echo "getNiveauEtudeNom : 0 results";
        }


        return $niveau_etude_nom;
    }
}
