<?php
require_once(dirname(__FILE__) . '/AbstractModel.php');

class Administrateur extends Personne
{
    /*
     * Attributes
     */
    private $id;
    public static $TABLE_NAME="Administrateur";


    /**
     * Administrateur constructor.
     */
    public function __construct()
    {
    }

    /**
     * Cette fonction permet d'obtenir une personne à partir de son Id
     * @param $id
     * @return bool|mysqli_result
     */
    public static function getUtilisateur($id)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,date_inscription,type_personne, telephone, adresse, mot_de_passe, image
                FROM Personne P
                WHERE P.id='$id'
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

}
