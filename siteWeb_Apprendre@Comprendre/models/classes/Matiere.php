<?php
require_once(dirname(__FILE__) . '/AbstractModel.php');

class Matiere extends AbstractModel
{
    /*
     * Attributs
     */
    public static $TABLE_NAME="Matiere";
    private $id;
    private $nom;

    /**
     * Matiere constructor.
     */
    public function __construct()
    {
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

    /*
     * Méthodes
     */

    public static function getListeMatiere()
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select * from " . Matiere::$TABLE_NAME . ";";
        $result = $bdd->query($sql);
        $bdd->close();

        return $result;
    }


}
