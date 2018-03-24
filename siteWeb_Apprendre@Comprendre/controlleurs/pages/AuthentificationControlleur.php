<?php
require_once(dirname(__FILE__) . '/../AbstractControlleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/Personne.php');
require_once(dirname(__FILE__) . '/../../models/classes/Administrateur.php');
require_once(dirname(__FILE__) . '/../../models/classes/Eleve.php');
require_once(dirname(__FILE__) . '/../../models/classes/Enseignant.php');

class AuthentificationControlleur extends AbstractControlleur
{

    public function displayNavBar()
    {
        if ($this->isUserConnected()) {
            echo '<!-- Navbar (sit on top) -->
                <div class="w3-top">
                    <div class="w3-bar w3-white w3-card" id="myNavbar">
                        <a href="../../../index.php#home"
                           class="w3-bar-item w3-button w3-wide">
                            <img id="logo_header" src="../../../ressources/images/Logo_Apprendre@Comprendre%20Light_Alpha.png" alt="LOGOA@C"/>
                        </a>
                        <!-- Right-sided navbar links -->
                        <div class="w3-right w3-hide-small">
                
                            <a href="../enseignant/tableauDeBord.php" class="w3-bar-item w3-button"><i
                                    class="fa fa-user"></i> Tableau de bord</a>
                        </div>
                        <!-- Hide right-floated links on small screens and replace them with a menu icon -->
                
                        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
                           onclick="w3_open()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Sidebar on small screens when clicking the menu icon -->
                <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none"
                     id="mySidebar">
                    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
                    <a href="#team" onclick="w3_close()"
                       class="w3-bar-item w3-button">Tableau de bord</a>
                </nav>
                ';
        } else {
            echo '<!-- Navbar (sit on top) -->
                <div class="w3-top">
                    <div class="w3-bar w3-white w3-card" id="myNavbar">
                        <a href="../../../index.php#home"
                           class="w3-bar-item w3-button w3-wide">
                            <img id="logo_header" src="../../../ressources/images/Logo_Apprendre@Comprendre%20Light_Alpha.png" alt="LOGOA@C"/>
                        </a>
                        <!-- Right-sided navbar links -->
                        <div class="w3-right w3-hide-small">
                
                            <a href="authentification.php" class="w3-bar-item w3-button"><i
                                        class="fa fa-user"></i> Authentification</a>
                        </div>
                        <!-- Hide right-floated links on small screens and replace them with a menu icon -->
                
                        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
                           onclick="w3_open()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Sidebar on small screens when clicking the menu icon -->
                <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none"
                     id="mySidebar">
                    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
                    <a href="#team" onclick="w3_close()"
                       class="w3-bar-item w3-button">Authentification</a>
                </nav>
                                
                ';
        }
    }

    public function displayHeader()
    {
        echo '<!-- Header with full-height image -->
        <header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
            <div class="w3-display-left w3-text-white full-width-div" style="padding:48px">
                <span class="w3-jumbo w3-hide-small"></span><br>
                <div align="center">
                    <h1><strong> Aprendre@Comprendre</strong></h1>
                    <span class="w3-xxlarge w3-hide-large w3-hide-medium">Start something that matters</span><br>
                    <span class="w3-large">Stop wasting valuable time with projects that just isn\'t you.</span>
                    <p><a href="connexion.php"
                          class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Connexion</a>
                        <a href="inscription.php"
                           class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Inscription</a>
                    </p>
                </div>
            </div>
            <div class="w3-display-bottomleft w3-text-grey w3-large" style="padding:24px 48px">
                <i class="fa fa-facebook-official w3-hover-opacity"></i>
                <i class="fa fa-instagram w3-hover-opacity"></i>
                <i class="fa fa-snapchat w3-hover-opacity"></i>
                <i class="fa fa-pinterest-p w3-hover-opacity"></i>
                <i class="fa fa-twitter w3-hover-opacity"></i>
                <i class="fa fa-linkedin w3-hover-opacity"></i>
            </div>
        
        </header>';
    }

    public function displayConnexion()
    {
        if ($this->isUserConnected()) {
            $this->displayConnexionConnected();
        } else {
            $this->displayConnexionUnConnected();
        }
    }

    public function uConnexion()
    {
        echo "coucou";
        if (isset($_POST['btnConnexionUtilisateur'])) {
            if ($this->formulaireConnexionComplet()) {

                $bdd = $this->getDb()->openConn();

                $email = $_POST['inputEmailConnexion'];
                $password = $_POST['inputPasswordConnexion'];

                $sql = "SELECT id , type_personne
                    FROM Personne P
                    WHERE P.email='$email'
                      and P.mot_de_passe='$password'
                ;";
                $result = $bdd->query($sql);
                if ($result->num_rows > 0) {
                    session_start();
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                        $this->connexionUtilisateur($bdd, $row);

                    }
                } else {
                    echo "Vous êtes actuellement déconnecté";
                }

                $this->getDb()->closeConn();
            }
        }
    }


    function displayEleve($id, $nom, $prenom, $email, $date_naissance, $niveau_etude)
    {
        $eleve = '<div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team2.jpg" alt="John" style="width:100%">
                <div class="w3-container">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                <h3>' . $nom . ' ' . $prenom . '</h3>
                            </td>
                            <td style="text-align: right">
                                ' . $id . ' 
                                                    <p class="w3-opacity">' . $niveau_etude . ' </p>

                            </td>
                        </tr>
                    </table>

                    <p style="text-align: center">' . $date_naissance . '</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> ' . $email . ' </button>
                    </p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-book"></i> Cours</button>
                    </p>
                </div>
            </div>
        </div>';

        echo $eleve;
    }

    public function displayInscription()
    {
        if ($this->isUserConnected()) {
            $this->displayInscriptionConnected();
        } else {
            $this->displayInscriptionUnConnected();
        }
    }

    public function displayInscriptionUnConnected()
    {
        $email = $_POST['inputEmailInscription'];
        $mot_de_passe = $_POST['inputPasswordInscription'];
        $mot_de_passe_confirm = $_POST['inputPasswordConfirmInscription'];
        $nom = $_POST['inputNomInscription'];
        $prenom = $_POST['inputPrenomInscription'];
        $date_naissance = $_POST['inputDateNaisssanceInscription'];
        $type_compte = $_POST['inputTypeCompteInscription'];

        $widget = '
        <!-- Promo Section - "We know design" -->
        <div id="inscription" class="w3-container w3-dark-grey" style="padding:128px 16px">
            <div class="w3-row-padding">
                <div class="w3-col m6">
                    <form action="./inscription.php" method="post">
                        <fieldset>';
        $widget = $widget . '
                            <legend>Inscription</legend>
                            <div class="form-group">
                                <label for="inputNomInscription">Nom</label>
                                <input type="text" class="form-control" 
                                name="inputNomInscription"
                                id="inputNomInscription" aria-describedby="nomHelp" 
                                placeholder="Entrer votre NOM"
                                value="' . $nom . '">
                                <small id="nomHelp" class="form-text text-muted">UPPER CASE</small>
                            </div>';
        $widget = $widget . '
                            <div class="form-group">
                                <label for="inputPrenomInscription">Prénom</label>
                                <input type="text" class="form-control" 
                                name="inputPrenomInscription"
                                id="inputPrenomInscription" aria-describedby="prénomHelp" placeholder="Entrer votre Prénom"
                                value="' . $prenom . '">
                                <small id="prénomHelp" class="form-text text-muted">Normal case</small>
                            </div>';
        $widget = $widget . '                            <div class="form-group">
                                <label for="inputDateNaisssanceInscription">Date de naissance</label>
                                <input type="date" class="form-control" 
                                name="inputDateNaisssanceInscription"
                                id="inputDateNaisssanceInscription"
                                value="' . $date_naissance . '">
                            </div>';
        $widget = $widget . '                            <div class="form-group">
                                <label for="inputEmailInscription">Email address</label>
                                <input type="email" class="form-control" 
                                name="inputEmailInscription"
                                id="inputEmailInscription" aria-describedby="emailHelp" placeholder="Enter email"
                                value="' . $email . '">
                                <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
                            </div>';
        $widget = $widget . '
                            <div class="form-group">
                                <label for="inputPasswordInscription">Password</label>
                                <input type="password" class="form-control" 
                                name="inputPasswordInscription"
                                id="inputPasswordInscription" placeholder="Password"
                                value="' . $mot_de_passe . '">
                            </div>';
        $widget = $widget . '                            <div class="form-group">
                                <input type="password" class="form-control" 
                                name="inputPasswordConfirmInscription"
                                id="inputPasswordConfirmInscription" placeholder="Confirm password"
                                value="' . $mot_de_passe_confirm . '">
                            </div>';

        if ($type_compte == 'Eleve') {
            $widget = $widget . '                            <fieldset class="form-group">
                                <legend>TypeDeCompte</legend>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="inputTypeCompteInscription" id="inputTypeCompteInscription1" value="Eleve" checked="">
                                        Éleve
                                    </label>
                                    <br>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="inputTypeCompteInscription" id="inputTypeCompteInscription2" value="Enseignant">
                                        Enseignant
                                    </label>
                                </div>';
        } else {
            $widget = $widget . '                            <fieldset class="form-group">
                                <legend>TypeDeCompte</legend>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="inputTypeCompteInscription" id="inputTypeCompteInscription1" value="Eleve">
                                        Éleve
                                    </label>
                                    <br>
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="inputTypeCompteInscription" id="inputTypeCompteInscription2" value="Enseignant" checked="">
                                        Enseignant
                                    </label>
                                </div>';
        }
        $widget = $widget . '        
                            </fieldset>
                                <button name="btnInscriptionUtilisateur" id="btnInscriptionUtilisateur" value="btnInscriptionUtilisateur" type="submit" class="btn btn-primary" value = "Envoyer">Submit</button>
                        </fieldset>
                    </form>
                </div>
                <div class="w3-col m6">
                    <img class="w3-image w3-round-large" src="../../../ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                         width="700" height="394">
                </div>
            </div>
        </div>';

        echo $widget;
    }

    public function displayInscriptionConnected()
    {
        $personne = $_SESSION["utilisateur"];

        $widget = '
        <!-- Promo Section - "We know design" -->
        <div id="inscription" class="w3-container w3-dark-grey" style="padding:128px 16px">
            <div class="w3-row-padding">
                <div class="w3-col m6">
                    <form action="./inscription.php" method="post">
                        <fieldset>';
        $widget = $widget . '
                            <legend>Inscription</legend>';
        $widget = $widget . $personne;
        $widget = $widget . '        
                            </fieldset>
                                    <a href="../enseignant/tableauDeBord.php">                                   
                                    <button type="submit" class="btn btn-primary">Tableau de bord</button>
                                    </a>                        </fieldset>
                    </form>
                </div>
                <div class="w3-col m6">
                    <img class="w3-image w3-round-large" src="../../../ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                         width="700" height="394">
                </div>
            </div>
        </div>';

        echo $widget;
    }

    /**
     * Fonction permettant de gérer l'inscription des utilisateurs
     */
    public function uInscription()
    {
        if (!$this->isUserConnected()) {


            if (isset($_POST['btnInscriptionUtilisateur'])) {
                if ($this->formulaireInscriptionComplet()) {
                    $email = $_POST['inputEmailInscription'];
                    $mot_de_passe = $_POST['inputPasswordInscription'];
                    $mot_de_passe_confirm = $_POST['inputPasswordConfirmInscription'];
                    $nom = $_POST['inputNomInscription'];
                    $prenom = $_POST['inputPrenomInscription'];
                    $date_naissance = $_POST['inputDateNaisssanceInscription'];
                    $type_compte = $_POST['inputTypeCompteInscription'];
                    $image = Personne::$DEFAULT_IMAGE;
                    if ($this->validerMotDePasse($mot_de_passe, $mot_de_passe_confirm)) {
                        $this->insertPersonne($nom, $prenom, $email, $date_naissance, $mot_de_passe, $type_compte,$image);
                    }
                }
            }
        }
    }



    public function displayFooter()
    {
        echo '<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
    <a href="#home" class="w3-button w3-light-grey"><i
            class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
    <div class="w3-xlarge w3-section">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
    <p>  <p>Réalisé par Ismail SOSSE ALAOUI</p>
    </p>
</footer>';
    }

    private function formulaireConnexionComplet()
    {
        $formulaire_complet = true;

        $email = $_POST['inputEmailConnexion'];
        $mot_de_passe = $_POST['inputPasswordConnexion'];

        if (empty($email)) {
            echo("email manquant");
            $formulaire_complet = false;
        }
        if (empty($mot_de_passe)) {
            echo("mot_de_passe manquant");
            $formulaire_complet = false;
        }

        return $formulaire_complet;
    }


    private function formulaireInscriptionComplet()
    {
        $formulaire_complet = true;

        $email = $_POST['inputEmailInscription'];
        $mot_de_passe = $_POST['inputPasswordInscription'];
        $mot_de_passe_confirm = $_POST['inputPasswordConfirmInscription'];
        $nom = $_POST['inputNomInscription'];
        $prenom = $_POST['inputPrenomInscription'];
        $date_naissance = $_POST['inputDateNaisssanceInscription'];
        $type_compte = $_POST['inputTypeCompteInscription'];

        if (empty($email)) {
            echo("email manquant");
            $formulaire_complet = false;
        }
        if (empty($mot_de_passe)) {
            echo("mot_de_passe manquant");
            $formulaire_complet = false;
        }
        if (empty($mot_de_passe_confirm)) {
            echo("mot_de_passe_confirm manquant");
            $formulaire_complet = false;
        }
        if (empty($nom)) {
            echo("nom manquant");
            $formulaire_complet = false;
        }
        if (empty($prenom)) {
            echo("prenom manquant");
            $formulaire_complet = false;
        }
        if (empty($date_naissance)) {
            echo("date_naissance manquant");
            $formulaire_complet = false;
        }
        if (empty($type_compte)) {
            echo("type_compte manquant");
            $formulaire_complet = false;
        }

        return $formulaire_complet;
    }

    private function insertPersonne($nom, $prenom, $email, $date_naissance, $mot_de_passe, $type_compte, $image)
    {
        $bdd = $this->getDb()->openConn();

        $sql = "INSERT INTO Personne (nom, prenom, email, date_naissance, mot_de_passe, type_personne,image)
                VALUES ('$nom','$prenom','$email','$date_naissance','$mot_de_passe','$type_compte','$image')
                ;";

        if ($bdd->query($sql) === TRUE) {
            session_start();
            $id_personne = $bdd->insert_id;

            $id = $this->createPersonneType($bdd, $id_personne, $type_compte);
            $personne = new Personne();

            if (strcmp($type_compte, Eleve::$TABLE_NAME) === 0) {
                $personne = new Eleve();
            } else {
                $personne = new Enseignant();

            }

            $personne->setIdPersonne($id_personne);
            $personne->setId($id);
            $personne->setNom($nom);
            $personne->setPrenom($prenom);
            $personne->setEmail($email);
            $personne->setDateNaissance($date_naissance);
            $personne->setTypePersonne($type_compte);
            $personne->setImage($image);
            $_SESSION["utilisateur"] = $personne;
//            echo "<br>";
//            echo "New record Personne created successfully. Last inserted ID is: " . $_SESSION["utilisateur"];
//            echo "<br>";


        } else {
            echo "Error: " . $sql . "<br>" . $bdd->error;
            echo "<br>";
            echo "_SESSION:utilisateur = " . $_SESSION["utilisateur"];
            echo "<br>";
        }

        $this->getDb()->closeConn();
    }

    private function createPersonneType($bdd, $id, $type_compte)
    {
        $idTypeCompte = -1;
        $sql = "INSERT INTO " . $type_compte . " (id_personne)
                VALUES ('$id')
                ;";

        if ($bdd->query($sql) === TRUE) {
            $idTypeCompte = $bdd->insert_id;
            echo "New record " . $type_compte . " created successfully. Last inserted ID is: " . $idTypeCompte;
            echo "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $bdd->error;
        }

        return $idTypeCompte;
    }

    private function displayConnexionConnected()
    {
        $widget = '<!-- Promo Section - "We know design" -->
            <div id="connexion" class="w3-container w3-light-grey" style="padding:128px 16px">
                <div class="w3-row-padding">
                    <div class="w3-col m6">';
        $widget = $widget . $this->getUserConnected();
        $widget = $widget . '
                                    <a href="../enseignant/tableauDeBord.php">                                   
                                    <button type="submit" class="btn btn-primary">Tableau de bord</button>
                                    </a>
                    </div>
                    <div class="w3-col m6">
                        <img class="w3-image w3-round-large" src="../../../ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                             width="700" height="394">
                    </div>
                </div>
            </div>
            ';
        echo $widget;
    }

    private function displayConnexionUnConnected()
    {
        $email = $_POST['inputEmailConnexion'];
        $mot_de_passe = $_POST['inputPasswordConnexion'];
        echo '<!-- Promo Section - "We know design" -->
                <div id="connexion" class="w3-container w3-light-grey" style="padding:128px 16px">
                    <div class="w3-row-padding">
                        <div class="w3-col m6">
                            <form action="connexion.php" method="post">
                                <fieldset>
                                    <legend>Connexion</legend>
                                    <div class="form-group">
                                        <label for="inputEmailConnexion">Email address</label>
                                        <input name="inputEmailConnexion" type="email" class="form-control" id="inputEmailConnexion" aria-describedby="emailHelp" placeholder="Enter email"
                                        value="' . $email . '">
                                        <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordConnexion">Password</label>
                                        <input name="inputPasswordConnexion" type="password" class="form-control" id="inputPasswordConnexion" placeholder="Password"
                                        value="' . $mot_de_passe . '"></div>
                                        <button value="btnConnexionUtilisateur" id="btnConnexionUtilisateur" name="btnConnexionUtilisateur" type="submit" class="btn btn-primary">Submit</button>
                                </fieldset>
                            </form>
                        </div>
                        <div class="w3-col m6">
                            <img class="w3-image w3-round-large" src="../../../ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                                 width="700" height="394">
                        </div>
                    </div>
                </div>
                ';
    }

    private function connexionUtilisateur($bdd, $row)
    {
        $id = $row["id"];
        $typePersonne = $row["type_personne"];

        //Recherche des informations de l'utilisateur
        if (strcmp($typePersonne, Eleve::$TABLE_NAME) == 0) {
            //Connexion d'un élève
            $sql = "SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,date_inscription,type_personne,NE.nom as niveau_etude, telephone, adresse, mot_de_passe, image
                FROM Eleve E, NiveauEtude NE, Personne P
                WHERE E.id_personne = P.id
                      and E.niveau_etude = NE.id
                      and P.id='$id'
                ;";
            $result = $bdd->query($sql);
            if ($result->num_rows > 0) {
                session_start();
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $this->initUserConnected(Eleve::$TABLE_NAME, $row);
                }
            }
        } else if (strcmp($typePersonne, Enseignant::$TABLE_NAME) == 0){
            //Connexion d'un enseignant
            $sql = "SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,date_inscription,type_personne, telephone, adresse, mot_de_passe, image
                FROM Enseignant E, Personne P
                WHERE E.id_personne = P.id
                      and P.id='$id'
                ;";
            $result = $bdd->query($sql);
            if ($result->num_rows > 0) {
                session_start();
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $this->initUserConnected(Enseignant::$TABLE_NAME, $row);
                }
            }
        } else if (strcmp($typePersonne, Administrateur::$TABLE_NAME) == 0){
            //Connexion d'un enseignant
            $sql = "SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,date_inscription,type_personne, telephone, adresse, mot_de_passe, image
                FROM Personne P
                WHERE P.id='$id'
                ;";
            $result = $bdd->query($sql);
            if ($result->num_rows > 0) {
                session_start();
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $this->initUserConnected(Administrateur::$TABLE_NAME, $row);
                }
            }
        }


    }

    private function initUserConnected($type_personne, $row)
    {
        if (strcmp($type_personne, Eleve::$TABLE_NAME) === 0) {
            $personne = new Eleve();
            $personne->setIdPersonne($row["id"]);
            $personne->setNom($row["nom"]);
            $personne->setPrenom($row["prenom"]);
            $personne->setEmail($row["email"]);
            $personne->setTelephone($row["telephone"]);
            $personne->setAdresse($row["adresse"]);
            $personne->setDateNaissance($row["date_naissance"]);
            $personne->setTypePersonne($row["type_personne"]);
            $personne->setDateInscription($row["date_inscription"]);
            $personne->setMotDePasse($row["mot_de_passe"]);
            $personne->setNiveauEtude($row["niveau_etude"]);
            $personne->setImage($row["image"]);
            $_SESSION["utilisateur"] = $personne;

            return $personne;
        } else if (strcmp($type_personne, Enseignant::$TABLE_NAME) === 0)  {
            $personne = new Enseignant();
            $personne->setIdPersonne($row["id"]);
            $personne->setNom($row["nom"]);
            $personne->setPrenom($row["prenom"]);
            $personne->setEmail($row["email"]);
            $personne->setTelephone($row["telephone"]);
            $personne->setDateNaissance($row["date_naissance"]);
            $personne->setDateInscription($row["date_inscription"]);
            $personne->setTypePersonne($row["type_personne"]);
            $personne->setAdresse($row["adresse"]);
            $personne->setMotDePasse($row["mot_de_passe"]);
            $personne->setImage($row["image"]);
            $_SESSION["utilisateur"] = $personne;

            return $personne;
        } else if (strcmp($type_personne, Administrateur::$TABLE_NAME) === 0)  {
            $personne = new Administrateur();
            $personne->setIdPersonne($row["id"]);
            $personne->setNom($row["nom"]);
            $personne->setPrenom($row["prenom"]);
            $personne->setEmail($row["email"]);
            $personne->setTelephone($row["telephone"]);
            $personne->setDateNaissance($row["date_naissance"]);
            $personne->setDateInscription($row["date_inscription"]);
            $personne->setTypePersonne($row["type_personne"]);
            $personne->setAdresse($row["adresse"]);
            $personne->setMotDePasse($row["mot_de_passe"]);
            $personne->setImage($row["image"]);
            $_SESSION["utilisateur"] = $personne;

            return $personne;
        }
    }
}