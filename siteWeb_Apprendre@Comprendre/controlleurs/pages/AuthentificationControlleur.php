<?php
require_once(dirname(__FILE__) . '/../AbstractControlleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/Personne.php');

class AuthentificationControlleur extends AbstractControlleur
{

    public function displayNavBar()
    {
        if ($this->userConnected()) {
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
        echo '<!-- Promo Section - "We know design" -->
<div id="connexion" class="w3-container w3-light-grey" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <form action="connexion_result.php" method="post">
                <fieldset>
                    <legend>Connexion</legend>
                    <div class="form-group">
                        <label for="inputEmailConnexion">Email address</label>
                        <input name="inputEmailConnexion" type="email" class="form-control" id="inputEmailConnexion" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordConnexion">Password</label>
                        <input name="inputPasswordConnexion" type="password" class="form-control" id="inputPasswordConnexion" placeholder="Password"></div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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

    public function uConnexion()
    {
        $bdd = $this->getDb()->openConn();

        $email = $_POST['inputEmailConnexion'];
        $password = $_POST['inputPasswordConnexion'];

        $sql = "SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,NE.nom as niveau_etude
                FROM Eleve E, NiveauEtude NE, Personne P
                WHERE E.id_personne = P.id
                      and E.niveau_etude = NE.id
                      and P.email='$email'
                      and P.mot_de_passe='$password'
                ;";
        $result = $bdd->query($sql);
        if ($result->num_rows > 0) {
            session_start();
            // output data of each row
            while ($row = $result->fetch_assoc()) {

                $personne = new Personne();
                $personne->setId($row["id"]);
                $personne->setNom($row["nom"]);
                $personne->setPrenom($row["prenom"]);
                $personne->setEmail($row["email"]);
                $personne->setDateNaissance($row["date_naissance"]);
                $_SESSION["utilisateur"] = $personne;
                var_dump("utilisateur: <br>");
                var_dump($_SESSION["utilisateur"]);
                var_dump("<br>");
                var_dump("<br>");
//                $this->displayEleve($row["id"], $row["nom"], $row["prenom"], $row["email"], $row["date_naissance"], $row["niveau_etude"]);
            }
        } else {
            echo "Vous êtes actuellement déconnecté";
        }
        var_dump("utilisateur: <br>");
        var_dump($_SESSION["utilisateur"]);
        var_dump("<br>");
        var_dump("<br>");

        $this->getDb()->closeConn();
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
        $email = $_POST['inputEmailInscription'];
        $mot_de_passe = $_POST['inputPasswordInscription'];
        $mot_de_passe_confirm = $_POST['inputPasswordConfirmInscription'];
        $nom = $_POST['inputNomInscription'];
        $prenom = $_POST['inputPrenomInscription'];
        $date_de_naissance = $_POST['inputDateDeNaissanceInscription'];
        $type_compte = $_POST['inputTypeCompteInscription'];

        $widget= '
<!-- Promo Section - "We know design" -->
<div id="inscription" class="w3-container w3-dark-grey" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <form action="./inscription.php" method="post">
                <fieldset>
                    <legend>Inscription</legend>
                    <div class="form-group">
                        <label for="inputNomInscription">Nom</label>
                        <input type="text" class="form-control" 
                        name="inputNomInscription"
                        id="inputNomInscription" aria-describedby="nomHelp" 
                        placeholder="Entrer votre NOM"
                        value="' . $nom  . '">
                        <small id="nomHelp" class="form-text text-muted">UPPER CASE</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPrenomInscription">Prénom</label>
                        <input type="text" class="form-control" 
                        name="inputPrenomInscription"
                        id="inputPrenomInscription" aria-describedby="prénomHelp" placeholder="Entrer votre Prénom">
                        <small id="prénomHelp" class="form-text text-muted">Normal case</small>
                    </div>
                    <div class="form-group">
                        <label for="inputNaisssanceInscription">Date de naissance</label>
                        <input type="date" class="form-control" 
                        name="inputNaisssanceInscription"
                        id="inputNaisssanceInscription">
                    </div>
                    <div class="form-group">
                        <label for="inputEmailInscription">Email address</label>
                        <input type="email" class="form-control" 
                        name="inputEmailInscription"
                        id="inputEmailInscription" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordInscription">Password</label>
                        <input type="password" class="form-control" 
                        name="inputPasswordInscription"
                        id="inputPasswordInscription" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" 
                        name="inputPasswordConfirmInscription"
                        id="inputPasswordConfirmInscription" placeholder="Confirm password">
                    </div>
                    <fieldset class="form-group">
                        <legend>TypeDeCompte</legend>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="inputTypeCompteInscription" id="inputTypeCompteInscription1" value="option1" checked="">
                                Éleve
                            </label>
                            <br>
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="inputTypeCompteInscription" id="inputTypeCompteInscription2" value="option2">
                                Enseignant
                            </label>
                        </div>

                    </fieldset>
                        <button type="submit" class="btn btn-primary" value = "Envoyer">Submit</button>
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

    /**
     * Fonction permettant de gérer l'inscription des utilisateurs
     */
    public function uInscription()
    {
        if ($this->formulaireInscriptionComplet()) {
            $bdd = $this->getDb()->openConn();

            $email = $_POST['inputEmailInscription'];
            $mot_de_passe = $_POST['inputPasswordInscription'];
            $mot_de_passe_confirm = $_POST['inputPasswordConfirmInscription'];
            $nom = $_POST['inputNomInscription'];
            $prenom = $_POST['inputPrenomInscription'];
            $date_de_naissance = $_POST['inputDateDeNaissanceInscription'];
            $type_compte = $_POST['inputTypeCompteInscription'];

            if ($this->validerMotDePasse($mot_de_passe, $mot_de_passe_confirm)) {
                $sql = "INSERT INTO Personne (nom, prenom, email, date_naissance, mot_de_passe)
                VALUES ('$nom','$prenom','$email','$date_de_naissance','$mot_de_passe')
                ;";

                var_dump($sql);
                var_dump("<br>");

                if ($bdd->query($sql) === TRUE) {
                    var_dump("New record created successfully");
                    var_dump("<br>");
                    echo "New record created successfully";
                } else {
                    var_dump("Error: " . $sql . "<br>" . $bdd->error);
                    var_dump("<br>");
                    echo "Error: " . $sql . "<br>" . $bdd->error;
                }
            }
        }
    }

    /**
     * @param $mot_de_passe
     * @param $mot_de_passe_confirm
     * @return bool
     */
    public function validerMotDePasse($mot_de_passe, $mot_de_passe_confirm)
    {
        return strcmp($mot_de_passe, $mot_de_passe_confirm) == 0;
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

    public function displayConnexionResult()
    {
        if ($this->userConnected()) {
            echo '<!-- Promo Section - "We know design" -->
            <div id="connexion" class="w3-container w3-light-grey" style="padding:128px 16px">
                <div class="w3-row-padding">
                    <div class="w3-col m6">
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
        } else {
            echo '<!-- Promo Section - "We know design" -->
            <div id="connexion" class="w3-container w3-light-grey" style="padding:128px 16px">
                <div class="w3-row-padding">
                    <div class="w3-col m6">
                        <form action="connexion_result.php" method="post">
                            <fieldset>
                                <legend>Connexion</legend>
                                <div class="form-group">
                                    <label for="inputEmailConnexion">Email address</label>
                                    <input name="inputEmailConnexion" type="email" class="form-control" id="inputEmailConnexion" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordConnexion">Password</label>
                                    <input name="inputPasswordConnexion" type="password" class="form-control" id="inputPasswordConnexion" placeholder="Password"></div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                            </fieldset>
                        </form>
                    </div>
                    Echec de la connexion
                    <div class="w3-col m6">
                        <img class="w3-image w3-round-large" src="../../../ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                             width="700" height="394">
                    </div>
                </div>
            </div>
            ';
        }
    }

    public function displayInscriptionResult()
    {
        echo '
<!-- Promo Section - "We know design" -->
<div id="inscription" class="w3-container w3-dark-grey" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <form action="inscription_result.php" method="post">
                <fieldset>
                    <legend>Inscription</legend>
                    <div class="form-group">
                        <label for="inputNomInscription">Nom</label>
                        <input type="text" class="form-control" id="inputNomInscription" aria-describedby="nomHelp" placeholder="Entrer votre NOM">
                        <small id="nomHelp" class="form-text text-muted">UPPER CASE</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPrenomInscription">Prénom</label>
                        <input type="text" class="form-control" id="inputPrenomInscription" aria-describedby="prénomHelp" placeholder="Entrer votre Prénom">
                        <small id="prénomHelp" class="form-text text-muted">Normal case</small>
                    </div>
                    <div class="form-group">
                        <label for="inputNaisssanceInscription">Date de naissance</label>
                        <input type="date" class="form-control" id="inputNaisssanceInscription">
                    </div>
                    <div class="form-group">
                        <label for="inputEmailInscription">Email address</label>
                        <input type="email" class="form-control" id="inputEmailInscription" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordInscription">Password</label>
                        <input type="password" class="form-control" id="inputPasswordInscription" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPasswordConfirmInscription" placeholder="Confirm password">
                    </div>
                    <fieldset class="form-group">
                        <legend>TypeDeCompte</legend>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="inputTypeCompteInscription" id="inputTypeCompteInscription1" value="option1" checked="">
                                Éleve
                            </label>
                            <br>
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="inputTypeCompteInscription" id="inputTypeCompteInscription2" value="option2">
                                Enseignant
                            </label>
                        </div>

                    </fieldset>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </fieldset>
            </form>
        </div>
        <div class="w3-col m6">
            <img class="w3-image w3-round-large" src="../../../ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                 width="700" height="394">
        </div>
    </div>
</div>';
    }

    private function formulaireInscriptionComplet()
    {
        $formulaire_complet = true;

        $email = $_POST['inputEmailInscription'];
        $mot_de_passe = $_POST['inputPasswordInscription'];
        $mot_de_passe_confirm = $_POST['inputPasswordConfirmInscription'];
        $nom = $_POST['inputNomInscription'];
        $prenom = $_POST['inputPrenomInscription'];
        $date_de_naissance = $_POST['inputDateDeNaissanceInscription'];
        $type_compte = $_POST['inputTypeCompteInscription'];

        echo($email);
        echo("<br>");
        echo($mot_de_passe);
        echo("<br>");
        echo($mot_de_passe_confirm);
        echo("<br>");
        echo($nom);
        echo("<br>");
        echo($prenom);
        echo("<br>");
        echo($date_de_naissance);
        echo("<br>");
        echo($type_compte);
        echo("<br>");

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
        if (empty($date_de_naissance)) {
            echo("date_de_naissance manquant");
            $formulaire_complet = false;
        }
        if (empty($type_compte)) {
            echo("type_compte manquant");
            $formulaire_complet = false;
        }

        return $formulaire_complet;
    }

}