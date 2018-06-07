<?php
require_once(dirname(__FILE__) . '/../AbstractControleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/Matiere.php');
require_once(dirname(__FILE__) . '/../../models/classes/NiveauEtude.php');
require_once(dirname(__FILE__) . '/../../models/classes/Eleve.php');
require_once(dirname(__FILE__) . '/../../models/classes/Enseignant.php');
require_once(dirname(__FILE__) . '/../../models/classes/Administrateur.php');

class Connectedusercontroleur extends AbstractControleur
{


    protected $inputRecherche;
    protected $inputRechercheErr;

    public function checkUserSession()
    {
        if (!$this->isUserConnected()) {
            header('Location: ' . $this->url . "templates/pages/erreur/utilisateurNonConnecte.php");
        }
    }

    public function displayNavBar()
    {
        $this->rechercheByEnseignant();
        $widget = "";
        if ($this->isUserConnected()) {

            $widget = $widget . '<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a onclick="openNav()"
           class="w3-bar-item w3-button w3-wide">
            <img id="logo_header" src="' . $this->getImagePath() . 'Logo_Apprendre@Comprendre%20Light_Alpha.png" alt="LOGOA@C"/>
        </a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <form class="form-inline my-2 my-lg-0" method="post">
                <input type="text" class="form-control"
                       name="inputRecherche"
                       id="inputRecherche"
                       type="text"
                       aria-describedby="inputRechercheHelp" placeholder="Recherche">
                <button name="btnRecherche" id="btnRecherche" value="btnRecherche" type="submit" class="btn btn-primary" value = "Envoyer">Recherche</button>
                <a onclick="openNav2()" href="#" class="w3-bar-item w3-button"><i
                        class="fa fa-home"></i> Menu' . $this->getUserConnected()->getTypePersonne() . '</a>
            </form>
        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon -->

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
           onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>';
            if ($this->isEleve()) {
                $widget = $widget . '
                <div id="sideNavLeft" class="sidenav-left">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNavLeft()">&times;</a>
                    <a href="../tableauDeBord/tableauDeBord.php"><img class="profil-picture" src="' . $this->getImagePath() . $this->getUserConnected()->getImage() . '"></a>
                    <a href="../tableauDeBord/tableauDeBordProfil.php">Profil</a>
                    <a href="../tableauDeBord/tableauDeBordMessagerie.php">Messagerie</a>
                    <a href="../tableauDeBord/tableauDeBordEnseignants.php">Enseignants</a>
                    <a href="../tableauDeBord/tableauDeBordRessources.php">Ressources</a>
                </div>
                
                <div id="sideNavRight" class="sidenav-right">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNavRight()">&times;</a>
                    <a href="../../../index.php#home">Deconnexion</a>
                </div>
                
                <!-- Sidebar on small screens when clicking the menu icon -->
                <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none"
                     id="mySidebar">
                    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
                    <a href="#team" onclick="w3_close()"
                       class="w3-bar-item w3-button">Tableau de bord</a>
                </nav>
                ';
            } else if ($this->isEnseignant()) {
                $widget = $widget . '
                <div id="sideNavLeft" class="sidenav-left">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNavLeft()">&times;</a>
                    <a href="../tableauDeBord/tableauDeBord.php"><img class="profil-picture" src="' . $this->getImagePath() . $this->getUserConnected()->getImage() . '"></a>
                    <a href="../tableauDeBord/tableauDeBordProfil.php">Profil</a>
                    <a href="../tableauDeBord/tableauDeBordMessagerie.php">Messagerie</a>
                    <a href="../tableauDeBord/tableauDeBordEleves.php">Élèves</a>
                    <a href="../tableauDeBord/tableauDeBordCours.php">Cours</a>
                    <a href="../tableauDeBord/tableauDeBordRessources.php">Ressources</a>
                </div>
                
                <div id="sideNavRight" class="sidenav-right">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNavRight()">&times;</a>
                    <a href="../../../index.php#home">Deconnexion</a>
                </div>
                
                <!-- Sidebar on small screens when clicking the menu icon -->
                <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none"
                     id="mySidebar">
                    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
                    <a href="#team" onclick="w3_close()"
                       class="w3-bar-item w3-button">Tableau de bord</a>
                </nav>
                ';
            } else if ($this->isAdministrateur()) {
                $widget = $widget . '
                <div id="sideNavLeft" class="sidenav-left">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNavLeft()">&times;</a>
                    <a href="tableauDeBord.php"><img class="profil-picture" src="' . $this->getImagePath() . $this->getUserConnected()->getImage() . '"></a>
                    <a href="tableauDeBordProfil.php">Profil</a>
                    <a href="tableauDeBordEleves.php">Élèves</a>
                    <a href="tableauDeBordEleves.php">Enseignants</a>
                    <a href="tableauDeBordEleves.php">Cours</a>
                    <a href="tableauDeBordEleves.php">SeanceCours</a>
                    <a href="tableauDeBordRessources.php">Ressources</a>
                </div>
                
                <div id="sideNavRight" class="sidenav-right">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNavRight()">&times;</a>
                    <a href="../../../index.php#home">Deconnexion</a>
                </div>
                
                <!-- Sidebar on small screens when clicking the menu icon -->
                <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none"
                     id="mySidebar">
                    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
                    <a href="#team" onclick="w3_close()"
                       class="w3-bar-item w3-button">Tableau de bord</a>
                </nav>
                ';
            }
            echo $widget;
        } else {
            header('Location: ' . $this->url . "templates/pages/erreur/utilisateurNonConnecte.php");
        }
    }

    function afficherEleve($id, $nom, $prenom, $email, $date_naissance, $niveau_etude, $image)
    {
        $eleve = '<div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../../ressources/images/' . $image . '" alt="' . $nom . ' ' . $prenom . '" style="width:100%">
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

        return $eleve;
    }

    public function displayHeader()
    {
        if ($this->isUserConnected()) {

            if ($this->isEleve()) {
                echo '<header class="bgimg-2 w3-display-container w3-grayscale-min" id="top"> </header>';
            } else if ($this->isEnseignant()) {
                echo '<header class="bgimg-1 w3-display-container w3-grayscale-min" id="top"> </header>';
            } else if ($this->isAdministrateur()) {
                echo '<header class="bgimg-1 w3-display-container w3-grayscale-min" id="top"> </header>';
            }
        } else {
            //Rediriger vers la page d'accueil
        }
    }

    protected function getImagePath()
    {
        $path = "../../../ressources/images/";
        return $path;
    }

    protected function getOptitonNiveauEtude($niveauEtude)
    {
        $widget = '';

        $result = NiveauEtude::getListeNiveauEtude();
        $i = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $i++;
                $widget = $widget . '<option ';
                $widget = $widget . 'value="' . $row['id'];
                if ($i == $niveauEtude) {
                    $widget = $widget . '"" selected>';
                } else {
                    $widget = $widget . '"">';
                }
                $widget = $widget . $row['nom'];
                $widget = $widget . '</option>';
            }
        }

        return $widget;
    }

    protected function getOptitonMatiere($matiere)
    {
        $widget = '';

        $result = Matiere::getListeMatiere();
        $i = 0;

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $i++;
                $widget = $widget . '<option ';
                $widget = $widget . 'value="' . $row['id'];
                if ($i == $matiere) {
                    $widget = $widget . '"" selected>';
                } else {
                    $widget = $widget . '"">';
                }
                $widget = $widget . $row['nom'];
                $widget = $widget . '</option>';
            }
        }

        return $widget;
    }

    protected function getListeMatiere($matiere)
    {
        $widget = '';

        $result = Matiere::getListeMatiere();

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widget = $widget . '<option ';
                $widget = $widget . 'value="' . $row['id'];
                $widget = $widget . '"">';
                $widget = $widget . $row['nom'];
                $widget = $widget . '</option>';
            }
        }

        return $widget;
    }

    protected function rechercheByEnseignant()
    {
        if (isset($_POST['btnRecherche'])) {
            echo "btnRecherche";

            if ($this->barreDeRechecheVide()) {

                $recherche = $_POST["inputRecherche"];

                echo $recherche;

                if ($recherche) {
                    header('Location: ' . $this->url . 'templates/pages/recherche/recherche.php?recherche=' . $recherche);
                    exit();
                }
            }
        }
    }

    private function barreDeRechecheVide()
    {
        echo "<br/><br/><br/><br/><br/><br/><br/><br/>barreDeRechecheVide";

        $barreDeRechercheVide = true;

        $recherche = $_POST['inputRecherche'];
        echo "<br/><br/><br/><br/><br/><br/>" . $recherche;
        echo "<br/><br/><br/><br/><br/><br/>" . $this->inputRechercheErr;

        if (empty($recherche)) {
            $this->inputRechercheErr = "Barre de recherche vide";
            $barreDeRechercheVide = false;
        } else {
            $this->inputRechercheErr = "";
        }

        return $barreDeRechercheVide;
    }

}

?>