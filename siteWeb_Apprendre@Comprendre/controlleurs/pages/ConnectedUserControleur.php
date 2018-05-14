<?php
require_once(dirname(__FILE__) . '/../AbstractControleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/Eleve.php');
require_once(dirname(__FILE__) . '/../../models/classes/Enseignant.php');
require_once(dirname(__FILE__) . '/../../models/classes/Administrateur.php');

class ConnectedUserControleur extends AbstractControleur
{

    public function displayNavBar()
    {
//        session_start();
        if ($this->isUserConnected()) {

            if ($this->isEleve()) {
                echo '<!-- Navbar (sit on top) -->
                <div class="w3-top">
                    <div class="w3-bar w3-white w3-card" id="myNavbar">
                        <a onclick="openNav()"
                           class="w3-bar-item w3-button w3-wide">
                            <img id="logo_header" src="' . $this->getImagePath() . 'Logo_Apprendre@Comprendre%20Light_Alpha.png" alt="LOGOA@C"/>
                        </a>
                        <!-- Right-sided navbar links -->
                        <div class="w3-right w3-hide-small">
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                                <a onclick="openNav2()" href="#home" class="w3-bar-item w3-button"><i
                                        class="fa fa-home"></i> Menu' . $this->getUserConnected()->getTypePersonne() . '</a>
                            </form>
                        </div>
                        <!-- Hide right-floated links on small screens and replace them with a menu icon -->
                
                        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
                           onclick="w3_open()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
                
                <div id="sideNavLeft" class="sidenav-left">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNavLeft()">&times;</a>
                    <a href="../tableauDeBord/tableauDeBord.php"><img class="profil-picture" src="' . $this->getImagePath() . $this->getUserConnected()->getImage() . '"></a>
                    <a href="../tableauDeBord/tableauDeBordProfil.php">Profil</a>
                    <a href="../tableauDeBord/tableauDeBordMessagerie.php">Messagerie</a>
                    <a href="../tableauDeBord/tableauDeBordEleves.php">Élèves</a>
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
                echo '<!-- Navbar (sit on top) -->
                <div class="w3-top">
                    <div class="w3-bar w3-white w3-card" id="myNavbar">
                        <a onclick="openNav()"
                           class="w3-bar-item w3-button w3-wide">
                            <img id="logo_header" src="' . $this->getImagePath() . 'Logo_Apprendre@Comprendre%20Light_Alpha.png" alt="LOGOA@C"/>
                        </a>
                        <!-- Right-sided navbar links -->
                        <div class="w3-right w3-hide-small">
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                                <a onclick="openNav2()" href="#home" class="w3-bar-item w3-button"><i
                                        class="fa fa-home"></i> Menu' . $this->getUserConnected()->getTypePersonne() . '</a>
                            </form>
                        </div>
                        <!-- Hide right-floated links on small screens and replace them with a menu icon -->
                
                        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
                           onclick="w3_open()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
                
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
                echo '<!-- Navbar (sit on top) -->
                <div class="w3-top">
                    <div class="w3-bar w3-white w3-card" id="myNavbar">
                        <a onclick="openNav()"
                           class="w3-bar-item w3-button w3-wide">
                            <img id="logo_header" src="' . $this->getImagePath() . 'Logo_Apprendre@Comprendre%20Light_Alpha.png" alt="LOGOA@C"/>
                        </a>
                        <!-- Right-sided navbar links -->
                        <div class="w3-right w3-hide-small">
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                                <a onclick="openNav2()" href="#home" class="w3-bar-item w3-button"><i
                                        class="fa fa-home"></i> Menu' . $this->getUserConnected()->getTypePersonne() . '</a>
                            </form>
                        </div>
                        <!-- Hide right-floated links on small screens and replace them with a menu icon -->
                
                        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
                           onclick="w3_open()">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
                
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
        } else {
            //Rediriger vers la page d'accueil
        }
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

}

?>