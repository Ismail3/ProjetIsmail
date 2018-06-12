<?php
require_once(dirname(__FILE__) . '/AbstractModel.php');

class Personne extends AbstractModel
{

    /*
     * Attributs
     */
    public static $DEFAULT_IMAGE = "team0.jpg";
    public static $TABLE_NAME = "Personne";
    protected $id_personne;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $telephone;
    protected $adresse;
    protected $dateNaissance;
    protected $motDePasse;
    protected $image;
    protected $dateInscription;
    protected $type_personne;

    /**
     * Personne constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $email
     * @param $password
     * @return bool|mysqli_result
     */
    public static function connexion($email, $password)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "SELECT id , type_personne
                    FROM Personne P
                    WHERE P.email='$email'
                      and P.mot_de_passe='$password'
                ;";

        $result = $bdd->query($sql);
        $bdd->close();

        return $result;
    }

    /**
     * @param $nom
     * @param $prenom
     * @param $email
     * @param $date_naissance
     * @param $mot_de_passe
     * @param $type_compte
     * @param $image
     * @return int|mixed
     */
    public static function newUtilisateur($nom, $prenom, $email, $date_naissance, $mot_de_passe, $type_compte, $image)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $id_personne = -1;

        $sql = "INSERT INTO " . Personne::$TABLE_NAME . " (nom, prenom, email, date_naissance, mot_de_passe, type_personne,image)
                VALUES ('$nom','$prenom','$email','$date_naissance','$mot_de_passe','$type_compte','$image')
                ;";

//        echo $sql;

        if ($bdd->query($sql) === TRUE) {
            $id_personne = $bdd->insert_id;
        }
        $bdd->close();
        return $id_personne;
    }

    /**
     * @param $id_personne
     * @param $type_compte
     * @return int|mixed
     */
    public static function createPersonneType($id_personne, $type_compte)
    {
        $idTypeCompte = -1;

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "INSERT INTO " . $type_compte . " (id_personne)
                VALUES ('$id_personne')
                ;";

        if ($bdd->query($sql) === TRUE) {
//            session_start();
            $idTypeCompte = $bdd->insert_id;
        }

        $bdd->close();

        return $idTypeCompte;
    }

    /**
     * @param $ageMin
     * @param $ageMax
     * @return bool|mysqli_result
     */
    public static function countUserBetweenAge($ageMin, $ageMax)
    {
        $dateNaissanceMin = date('Y - m - d', strtotime(date("Y-m-d") . " - " . ($ageMin) . " year"));
        $dateNaissanceMax = date('Y - m - d', strtotime(date("Y-m-d") . " - " . ($ageMax) . " year"));
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "select count(*) from Personne where date_naissance < '$dateNaissanceMin' and date_naissance >='$dateNaissanceMax'";
        $result = $bdd->query($sql);
        $bdd->close();

        return $result;
    }

    public static function getMinAge()
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        $sql = "select max(date_naissance) as ageMin from Personne ;";
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

        $sql = "select min(date_naissance) as ageMax from Personne ;";
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

        $sql = "select min(date_inscription) as minDate from ".Personne::$TABLE_NAME." ;";
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
        $maxDate = "2017-03";

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select max(date_inscription) as maxDate from ".Personne::$TABLE_NAME." ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $maxDate = $row['maxDate'];
            }
        }

        $bdd->close();

        return date('Y-M', strtotime($maxDate));
    }

    public static function countPersonneIncritBetweenDate($dateMin, $dateMax)
    {
        $dateTimeMin =  date('Y-m-d H:i:s', strtotime($dateMin));
        $dateTimeMax =  date('Y-m-d H:i:s', strtotime($dateMax));
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();

        $sql = "select count(*) from ".Personne::$TABLE_NAME." where date_inscription < '$dateTimeMax' and date_inscription >='$dateTimeMin'";
//        echo $sql;
        $result = $bdd->query($sql);
        $bdd->close();

        return $result;
    }

    /*
     * Getters & Setters


    /**
     * @return int
     */
    public function getIdPersonne()
    {
        return $this->id_personne;
    }

    /**
     * @param int $id_personne
     */
    public function setIdPersonne($id_personne)
    {
        $this->id_personne = $id_personne;
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return date
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * @param date $dateNaissance
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    /**
     * @return string
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * @param string $motDePasse
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return date
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param date $dateInscription
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }


    /**
     * @return string
     */
    public function getTypePersonne()
    {
        return $this->type_personne;
    }

    /**
     * @param string $type_personne
     */
    public function setTypePersonne($type_personne)
    {
        $this->type_personne = $type_personne;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        $toString = "";
        $toString = $toString . "id_personne : " . $this->id_personne;
        $toString = $toString . "<br>";
        $toString = $toString . "nom : " . $this->nom;
        $toString = $toString . "<br>";
        $toString = $toString . "prenom : " . $this->prenom;
        $toString = $toString . "<br>";
        $toString = $toString . "email : " . $this->email;
        $toString = $toString . "<br>";
        $toString = $toString . "telephone : " . $this->telephone;
        $toString = $toString . "<br>";
        $toString = $toString . "telephone : " . $this->telephone;
        $toString = $toString . "<br>";
        $toString = $toString . "dateNaissance : " . $this->dateNaissance;
        $toString = $toString . "<br>";
        $toString = $toString . "motDePasse : " . $this->motDePasse;
        $toString = $toString . "<br>";
        $toString = $toString . "image : " . $this->image;
        $toString = $toString . "<br>";
        $toString = $toString . "dateInscription : " . $this->dateInscription;
        $toString = $toString . "<br>";
        $toString = $toString . "type_personne : " . $this->type_personne;
        $toString = $toString . "<br>";
        return $toString;
    }

    /**
     * @return string
     */
    public function getMiniature()
    {
        $personne = '<div >
            <div >
                <img src="../../../ressources/images/' . $this->image . '" alt="' . $this->nom . ' ' . $this->prenom . '" height="256">
                <div class="w3-container">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                <h3>' . $this->nom . ' ' . $this->prenom . '</h3>
                            </td>
                            <td style="text-align: right">
                            <h1 class="w3-tag w3-blue-grey w3-round">
                                ' . $this->id_personne . ' 
                            </h1>
                            </td>
                        </tr>
                    </table>
                    <p style="text-align: center">';
        $personne = $personne . "dateNaissance : " . $this->dateNaissance;
        $personne = $personne . "<br>";
        $personne = $personne . "dateInscription : " . $this->dateInscription;
        $personne = $personne . "<br>";
        $personne = $personne . "type_personne : " . $this->type_personne;
        $personne = $personne . "<br>";
        $personne = $personne . '</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> ' . $this->email . ' </button>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-phone"></i> ' . $this->telephone . ' </button>
                    </p>
                </div>
            </div>
        </div>';

        $toString = "<div>";

        $toString = $toString . "</div>";
        return $personne;
    }

    /**
     * @param $nom
     * @param $prenom
     * @param $adresse
     * @param $email
     * @param $tel
     * @param $mot_de_passe
     * @param $image
     * @return bool|mysqli_result
     */
    public function update($nom, $prenom, $adresse, $email, $tel, $mot_de_passe, $image)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        $sql = "";
        $id = $this->getIdPersonne();
        $date_naissance = $this->getDateNaissance();

        if (strcmp($image, "") == 0) {
            $sql = "UPDATE Personne
                SET nom='$nom', prenom='$prenom',email='$email',adresse='$adresse',date_naissance='$date_naissance',telephone='$tel',mot_de_passe='$mot_de_passe'
                WHERE id=$id
                ;";
        } else {
            $sql = "UPDATE Personne
                SET nom='$nom', prenom='$prenom',email='$email',adresse='$adresse',date_naissance='$date_naissance',telephone='$tel',mot_de_passe='$mot_de_passe',image='$image'
                WHERE id=$id
                ;";
        }
        $query = $bdd->query($sql);
        $bdd->close();
        return $query;
    }

    /**
     * @param $niveau_etude
     * @return bool|mysqli_result
     */
    public function updateEleve($niveau_etude)
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        $sql = "";
        $id = $this->getIdPersonne();

        $sql = "UPDATE Eleve
                SET niveau_etude='$niveau_etude'
                WHERE id=$id
                ;";

        $query = $bdd->query($sql);
        $bdd->close();
        return $query;
    }


}
