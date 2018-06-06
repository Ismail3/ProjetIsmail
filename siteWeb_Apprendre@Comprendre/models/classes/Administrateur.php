<?php
require_once(dirname(__FILE__) . '/AbstractModel.php');

class Administrateur extends Personne
{
    /*
     * Attributs
     */
    private $id;
    public static $TABLE_NAME="Administrateur";


    /*
     * Constructeur
     */
    public function __construct()
    {
    }

    private static function initAdministrateur($row)
    {
        $administrateur = new Administrateur();
        $administrateur->setIdPersonne($row["id"]);
        $administrateur->setNom($row["nom"]);
        $administrateur->setPrenom($row["prenom"]);
        $administrateur->setEmail($row["email"]);
        $administrateur->setTelephone($row["telephone"]);
        $administrateur->setDateNaissance($row["date_naissance"]);
        $administrateur->setDateInscription($row["date_inscription"]);
        $administrateur->setTypePersonne($row["type_personne"]);
        $administrateur->setAdresse($row["adresse"]);
        $administrateur->setMotDePasse($row["mot_de_passe"]);
        $administrateur->setImage($row["image"]);

        return $administrateur;
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

    /*
     * Méthodes
     */

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

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                return Administrateur::initAdministrateur($row);
            }
        }
        else {
            return 0;
        }    }
}
