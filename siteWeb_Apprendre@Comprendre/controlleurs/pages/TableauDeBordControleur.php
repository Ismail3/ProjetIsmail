<?php
require_once(dirname(__FILE__) . '/../../models/basesDeDonnées/BdConnexion.php');
require_once(dirname(__FILE__) . '/../AbstractControleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/Personne.php');
require_once(dirname(__FILE__) . '/../../models/classes/Eleve.php');
require_once(dirname(__FILE__) . '/../../models/classes/Enseignant.php');
require_once(dirname(__FILE__) . '/../../models/classes/Administrateur.php');
require_once(dirname(__FILE__) . '/../../models/classes/NiveauEtude.php');

class TableauDeBordControleur extends AbstractControleur
{
    /*
     * Attributes
     */
    private $profilUpdate = false;

    /**
     * @return bool
     */
    public function isProfilUpdate()
    {
        return $this->profilUpdate;
    }

    /**
     * @param bool $profilUpdate
     */
    public function setProfilUpdate($profilUpdate)
    {
        $this->profilUpdate = $profilUpdate;
    }


    public function displayNavBar()
    {
        session_start();

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
                    <a href="tableauDeBord.php"><img class="profil-picture" src="' . $this->getImagePath() . $this->getUserConnected()->getImage() . '"></a>
                    <a href="tableauDeBordProfil.php">Profil</a>
                    <a href="tableauDeBordMessagerie.php">Messagerie</a>
                    <a href="tableauDeBordEleves.php">Élèves</a>
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
                    <a href="tableauDeBord.php"><img class="profil-picture" src="' . $this->getImagePath() . $this->getUserConnected()->getImage() . '"></a>
                    <a href="tableauDeBordProfil.php">Profil</a>
                    <a href="tableauDeBordMessagerie.php">Messagerie</a>
                    <a href="tableauDeBordEleves.php">Élèves</a>
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

    public function editProfilSave()
    {
        if (isset($_POST['btnSaveEditProfil'])) {
            $mot_de_passe = $_POST['inputEditProfiPassword'];
            $mot_de_passe_confirm = $_POST['inputEditProfilPasswordConfirm'];
            if (strcmp($mot_de_passe, "") === 0 || strcmp($mot_de_passe_confirm, "") === 0) {
                echo "not updatePassWord";
                $this->updateProfil("");
            } else {
                if ($this->validerMotDePasse($mot_de_passe, $mot_de_passe_confirm)) {
                    echo "updatePassWord";
                    $this->updateProfil($mot_de_passe);
                }
            }
        }
    }

    public function displayUilisateurProfilEdit()
    {
        $widgets = '';
        if (!$_SESSION["profilUpdated"]) {
            if ($this->isEleve()) {
                $widgets = $widgets . $this->displayEleveProfilEdit();
            } else {
                $widgets = $widgets . $this->displayEnseignantProfilEdit();
            }
        } else {
            $_SESSION["profilUpdated"] = false;
            if ($this->isEleve()) {
                $widgets = $widgets . $this->displayEleveProfil();
            } else {
                $widgets = $widgets . $this->displayEnseignantProfil();
            }
        }

        echo $widgets;
        return $widgets;
    }

    public function displayUilisateurProfil()
    {
        $widgets = '';
        if ($this->isEleve()) {
            $widgets = $widgets . $this->displayEleveProfil();
        } else if ($this->isEnseignant()) {
            $widgets = $widgets . $this->displayEnseignantProfil();
        } else if ($this->isAdministrateur()) {
            $widgets = $widgets . $this->displayAdministrateurProfil();
        }

        echo $widgets;
        return $widgets;
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

    function displayEleves()
    {
        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT P.id as id,P.nom as nom,prenom,email,date_naissance,NE.nom as niveau_etude
                FROM Eleve E, NiveauEtude NE, Personne P
                WHERE E.id_personne = P.id and E.niveau_etude = NE.id
                LIMIT 8
                ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $this->displayEleve($row["id"], $row["nom"], $row["prenom"], $row["email"], $row["date_naissance"], $row["niveau_etude"]);
            }
        } else {
            echo "0 results";
        }

        $bdd->close();
    }

    public function displayPage()
    {

        $eleve = ' <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team2.jpg" alt="John" style="width:100%">
                <div class="w3-container">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                <h3>John Doe</h3>
                            </td>
                            <td style="text-align: right">
                                Licence MIASHS
                            </td>
                        </tr>
                    </table>

                    <p class="w3-opacity">CEO &amp; Founder</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-book"></i> Cours</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team1.jpg" alt="Jane" style="width:100%">
                <div class="w3-container">
                    <h3>Anja Doe</h3>
                    <p class="w3-opacity">Art Director</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team3.jpg" alt="Mike" style="width:100%">
                <div class="w3-container">
                    <h3>Mike Ross</h3>
                    <p class="w3-opacity">Web Designer</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team4.jpg" alt="Dan" style="width:100%">
                <div class="w3-container">
                    <h3>Dan Star</h3>
                    <p class="w3-opacity">Designer</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team2.jpg" alt="John" style="width:100%">
                <div class="w3-container">
                    <h3>John Doe</h3>
                    <p class="w3-opacity">CEO &amp; Founder</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team1.jpg" alt="Jane" style="width:100%">
                <div class="w3-container">
                    <h3>Anja Doe</h3>
                    <p class="w3-opacity">Art Director</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team3.jpg" alt="Mike" style="width:100%">
                <div class="w3-container">
                    <h3>Mike Ross</h3>
                    <p class="w3-opacity">Web Designer</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team4.jpg" alt="Dan" style="width:100%">
                <div class="w3-container">
                    <h3>Dan Star</h3>
                    <p class="w3-opacity">Designer</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
    </div>';

        echo $eleve;
    }

    private function displayEleveProfil()
    {
        $eleve = $this->getUserConnected();
        $widgets = '<!-- Header with full-height image -->
            <div class="w3-content w3-margin-top" style="max-width:1400px;">
            
                <!-- The Grid -->
                <div class="w3-row-padding">';
        $widgets = $widgets . '

            <!-- Left Column -->
            <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">';
        $widgets = $widgets . $this->getProfilMainInfos($eleve, Eleve::$TABLE_NAME);
        $widgets = $widgets . '
                </div>
                <br>
    
                <!-- End Left Column -->
            </div>';
        $widgets = $widgets . '
        <!-- Right Column -->
        <div class="w3-twothird">

            <div class="w3-container w3-card w3-white">
                <h2 class="w3-text-grey w3-padding-16"><i
                            class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education</h2>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>W3Schools.com</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
                    <p>Web Development! All I need to know in one place</p>
                    <hr>
                </div>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>London Business School</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
                    <p>Master Degree</p>
                    <hr>
                </div>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>School of Coding</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013</h6>
                    <p>Bachelor Degree</p><br>
                </div>
            </div>

            <!-- End Right Column -->
        </div>
        ';
        $widgets = $widgets . '
        <!-- End Grid -->
    </div>

    <!-- End Page Container -->
</div>';
        return $widgets;
    }

    private function displayEnseignantProfil()
    {
        $enseignant = $this->getUserConnected();
        $widgets = '<!-- Header with full-height image -->
            <div class="w3-content w3-margin-top" style="max-width:1400px;">
            
                <!-- The Grid -->
                <div class="w3-row-padding">';
        $widgets = $widgets . '

            <!-- Left Column -->
            <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">';
        $widgets = $widgets . $this->getProfilMainInfos($enseignant, Enseignant::$TABLE_NAME);
        $widgets = $widgets . $this->getMatiereEnseigner($enseignant);
        $widgets = $widgets . '
                </div>
                <br>
    
                <!-- End Left Column -->
            </div>';
        $widgets = $widgets . '
        
                <!-- Right Column -->
                <div class="w3-twothird">';
        //Liste des cours crées
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Cours </h2>';
        $widgets = $widgets . $this->getListeDesCours($enseignant);
        $widgets = $widgets . '
                    </div>';

        //Liste des séance de cours inscrit
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Séances programmés (Demande)</h2>';
        $widgets = $widgets . $this->getListeDesSeancesCoursDemande($enseignant);
        $widgets = $widgets . '
                    </div>';

        //Liste des séance de cours crées
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Séances programmés (Proposition)</h2>';
        $widgets = $widgets . $this->getListeDesSeancesCoursProposition($enseignant);
        $widgets = $widgets . '
                    </div>
        
                    <!-- End Right Column -->
                </div>';
        $widgets = $widgets . '
        
                <!-- End Grid -->
            </div>
        
            <!-- End Page Container -->
        </div>';
        return $widgets;
    }

    private function displayAdministrateurProfil()
    {
        $administrateur = $this->getUserConnected();
        $widgets = '<!-- Header with full-height image -->
            <div class="w3-content w3-margin-top" style="max-width:1400px;">
            
                <!-- The Grid -->
                <div class="w3-row-padding">';
        $widgets = $widgets . '

            <!-- Left Column -->
            <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">';
        $widgets = $widgets . $this->getProfilMainInfos($administrateur, Administrateur::$TABLE_NAME);
        $widgets = $widgets . '
                </div>
                <br>
    
                <!-- End Left Column -->
            </div>';
        $widgets = $widgets . '
        
                <!-- Right Column -->
                <div class="w3-twothird">';
        //Liste des cours crées
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Cours </h2>';
        $widgets = $widgets . $this->getListeDesCoursAdmin();
        $widgets = $widgets . '
                    </div>';

        //Liste des séance de cours inscrit
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Séances programmés (Demande)</h2>';
        $widgets = $widgets . $this->getListeDesSeancesCoursDemandeAdmin();
        $widgets = $widgets . '
                    </div>';

        //Liste des séance de cours crées
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Séances programmés (Proposition)</h2>';
        $widgets = $widgets . $this->getListeDesSeancesCoursPropositionAdmin();
        $widgets = $widgets . '
                    </div>
        
                    <!-- End Right Column -->
                </div>';
        $widgets = $widgets . '
        
                <!-- End Grid -->
            </div>
        
            <!-- End Page Container -->
        </div>';
        return $widgets;
    }

    private function getProfilMainInfos($personne, $type_personne)
    {
        $widget = '
        <!-- Left Column -->

                <div class="w3-display-container">
                    <img src="' . $this->getImagePath() . $this->getUserConnected()->getImage() . '" style="width:100%" alt="Avatar">
                    <div class="w3-display-bottomleft w3-container w3-text-black">
                    </div>
                </div>
                <div class="w3-container">
                    <h2>' . $personne->getPrenom() . ' ' . $personne->getNom() . '</h2>
                    <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getTypePersonne() . '</p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getAdresse() . '</p>
                    <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getEmail() . '</p>
                    <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getTelephone() . '</p>
                    ';
        if (strcmp($type_personne, Eleve::$TABLE_NAME) === 0) {
            $widget = $widget . '<p><i class="fa fa-certificate fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getNiveauEtude() . '</p>
';
        }
        $widget = $widget . '<hr>

                </div>';
        return $widget;
    }

    private function getProfilMainInfosEdit($personne, $type_personne)
    {
        $mot_de_passe = '';
        $mot_de_passe_confirm = '';
        $widget = '
        <!-- Left Column -->
        <form enctype="multipart/form-data" action="" method="post">
                <div class="w3-display-container">
                    <input type="file" class="form-control-file" name="inputImgProfil" id="inputImgProfil" aria-describedby="fileHelp">
                    <img src="' . $this->getImagePath() . $this->getUserConnected()->getImage() . '" style="width:100%" alt="Avatar">

                </div>
                <div class="w3-container">
   <h2><input type="text" class="form-control" placeholder="Prénom" 
                        value="' . $personne->getPrenom() . '" name="inputEditProfilPrenom" id="inputEditProfilPrenom">
                            <input type="text" class="form-control" placeholder="NOM" 
                            value="' . $personne->getNom() . '" name="inputEditProfilNom" id="inputEditProfilNom"></h2>
                
                    <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getTypePersonne() . '</p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><input value="' . $personne->getAdresse() . '" type="text" class="form-control" placeholder="Ville, CodePostal" id="inputEditProfilAdresse" name="inputEditProfilAdresse"></p>
                    <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><input value="' . $personne->getEmail() . '" type="email" class="form-control" placeholder="example@mail.com" id="inputEditProfilEmail" name="inputEditProfilEmail"></p>
                    <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i> <input value="' . $personne->getTelephone() . '" type="tel" class="form-control" placeholder="+33 06 12 34 56 78" id="inputEditProfilTel" name="inputEditProfilTel"></p>
                    ';
        if (strcmp($type_personne, Eleve::$TABLE_NAME) === 0) {
            $widget = $widget . $this->getNiveauEtudeSelect($personne->getNiveauEtude());
            $widget = $widget . '<p><i class="fa fa-certificate fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getNiveauEtude() . '</p>
';
        }
        $widget = $widget . '
        <p><i class="fa fa-lock fa-fw w3-margin-right w3-large w3-text-teal"></i>
                    <input type="password" class="form-control" 
                                name="inputEditProfiPassword"
                                id="inputEditProfiPassword" placeholder="Password"
                                value="' . $mot_de_passe . '">
                    <input type="password" class="form-control" 
                                name="inputEditProfilPasswordConfirm"
                                id="inputEditProfilPasswordConfirm" placeholder="ConfirmPassword"
                                value="' . $mot_de_passe . '"></p>
                    <hr>

                </div>
                <button name="btnSaveEditProfil" id="btnSaveEditProfil" type="submit" class="btn btn-primary" value="btnSaveEditProfil">Submit</button>
         </form>';
        return $widget;
    }

    /**
     * @param $niveauEtude
     */
    private function getNiveauEtudeSelect($niveauEtude)
    {
        $widget = '<p><i class="fa fa-certificate fa-fw w3-margin-right w3-large w3-text-teal"></i>';
        $widget = $widget . '<select style="height:30px;"class="form-control" id="inputEditProfilNiveauEtude" name="inputEditProfilNiveauEtude">';
        $widget = $widget . $this->getOptitonNiveauEtude($niveauEtude);

        $widget = $widget . '                   </select>';
        $widget = $widget . '</p>
';

        return $widget;
    }

    private function getOptitonNiveauEtude($niveauEtude)
    {

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select * from " . NiveauEtude::$TABLE_NAME . ";";
        $result = $bdd->query($sql);
        $widget = '';
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

        $bdd->close();

        return $widget;
    }


    /**
     * @param $enseignant
     * @return Enseignant
     */
    private function getMatiereEnseigner($enseignant)
    {
        $widget = '<div class="w3-container">';
        $widget = $widget . '<p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Compétences</b>
                    </p>';

        $bd = new BdConnexion();
        $idEnseignant = $enseignant->getIdPersonne();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT E.enseignant, M.nom as matiere, NE.nom as niveau_etude, NE.id as id_niveau_etude
                FROM Enseigner E, Matiere M, NiveauEtude NE
                WHERE E.enseignant = $idEnseignant and E.matiere = M.id and E.niveau_etude = NE.id
                ORDER BY matiere
                ;";
        $result = $bdd->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widget = $widget . $this->displayMatiereEnseigner($row);
            }
        } else {
            echo "0 results";
        }

        $bdd->close();
        $widget = $widget . '<br></div>';

        return $widget;
    }

    private function displayMatiereEnseigner($row)
    {
        $matiere = $row['matiere'];
        $niveau_etude = $row['niveau_etude'];
        $id_niveau_etude = 100 * ($row['id_niveau_etude'] / 18);
        $widget = '                    <p><b>' . $matiere . '</b></p>
                    <div class="w3-light-grey w3-round-xlarge w3-small">
                        <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:' . $id_niveau_etude . '%">' . $niveau_etude . '</div>
                    </div>';

        return $widget;
    }

    private function getListeDesCours($enseignant)
    {
        $widget = '';

        $bd = new BdConnexion();
        $idEnseignant = $enseignant->getIdPersonne();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur, C.matiere, C.niveau_etude_min, C.niveau_etude_max, M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax
                WHERE C.id_auteur = $idEnseignant and M.id = C.matiere and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
                ORDER BY date_creation DESC
                LIMIT 5;";
        $result = $bdd->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widget = $widget . $this->displayCours($row);
            }
        } else {
            echo "0 results";
        }

        $bdd->close();
//        $widget = $widget . '<br></div>';

        return $widget;
    }

    private function getListeDesCoursAdmin()
    {
        $widget = '';

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


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widget = $widget . $this->displayCours($row);
            }
        } else {
            echo "0 results";
        }

        $bdd->close();
//        $widget = $widget . '<br></div>';

        return $widget;
    }

    private function displayCours($row)
    {
        $id = $row['id'];
        $nom = $row['nom'];
        $description = $row['description'];
        $tarif = $row['tarif'];
        $date_creation = $row['date_creation'];
        $id_auteur = $row['id_auteur'];
        $matiere_nom = $row['matiere_nom'];
        $niveau_min_nom = $row['niveau_min_nom'];
        $niveau_max_nom = $row['niveau_max_nom'];
        $widget = '<div class="w3-container">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                            <h4 class="w3-opacity"><b>' . $nom . '</b></h4>                            </td>
                            <td style="text-align: right">
<span
                                        class="w3-tag w3-teal w3-round">' . $matiere_nom . '</span>

                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                                        <h6 class="w3-text-teal"><i class="fa fa-asterisk fa-fw w3-margin-right"></i>
                            ' . $niveau_min_nom . ' - <span
                                        class="w3-tag w3-teal w3-round">' . $niveau_max_nom . '</span></h6>                           </td>
                            <td style="text-align: right">
<h1
                                        class="w3-tag w3-blue-grey w3-round">' . $tarif . '€</h1>

                            </td>
                        </tr>
                    </table>
                            <p>' . substr($description, 0, 196) . ' ...</p>
                            <p style="text-align: right">' . $date_creation . '</p>
                            <hr>
                        </div>';

        return $widget;
    }

    /**
     * @param $enseignant
     * @return string
     */
    private function getListeDesSeancesCoursProposition($enseignant)
    {

        $widgets = '';

        $bd = new BdConnexion();
        $idEnseignant = $enseignant->getIdPersonne();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur,
                M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom,
                S.date_inscription, S.date_realisation, S.participant, S.duree, S.etat,
                P.nom as nom_participant,P.prenom as prenom_participant,P.email as email_participant,P.date_naissance as date_naissance_participant, P.type_personne as type_personne_participant
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax, SeanceCours S, Personne P
                WHERE C.id_auteur = $idEnseignant and M.id = C.matiere
                and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
                and S.proposition_cours = C.id and P.id = S.participant
                ORDER BY date_realisation DESC
                LIMIT 5;";
        $result = $bdd->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widgets = $widgets . $this->displaySeanceCoursProposition($row);
            }
        } else {
            echo "0 results";
        }

        $bdd->close();

        return $widgets;
    }

    private function getListeDesSeancesCoursPropositionAdmin()
    {
        $widgets = '';

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur,
                M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom,
                S.date_inscription, S.date_realisation, S.participant, S.duree, S.etat,
                P.nom as nom_participant,P.prenom as prenom_participant,P.email as email_participant,P.date_naissance as date_naissance_participant, P.type_personne as type_personne_participant
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax, SeanceCours S, Personne P
                WHERE M.id = C.matiere
                and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
                and S.proposition_cours = C.id and P.id = S.participant
                ORDER BY date_realisation DESC
                LIMIT 5;";
        $result = $bdd->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widgets = $widgets . $this->displaySeanceCoursProposition($row);
            }
        } else {
            echo "0 results";
        }

        $bdd->close();

        return $widgets;
    }

    private function displaySeanceCoursProposition($row)
    {
        $id = $row['id'];
        $nom = $row['nom'];
        $description = $row['description'];
        $tarif = $row['tarif'];
        $date_creation = $row['date_creation'];
        $id_auteur = $row['id_auteur'];
        $matiere_nom = $row['matiere_nom'];
        $niveau_min_nom = $row['niveau_min_nom'];
        $niveau_max_nom = $row['niveau_max_nom'];
        $date_inscription = $row['date_inscription'];
        $date_realisation = $row['date_realisation'];
        $participant = $row['participant'];
        $duree = $row['duree'];
        $etat = $row['etat'];
        $nom_participant = $row['nom_participant'];
        $prenom_participant = $row['prenom_participant'];
        $email_participant = $row['email_participant'];
        $date_naissance_participant = $row['date_naissance_participant'];
        $type_personne_participant = $row['type_personne_participant'];
        $widget = '<div class="w3-container">
<table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                            <h4 class="w3-opacity"><b>' . $nom . '</b></h4>                            </td>
                            <td style="text-align: right">
<span
                                        class="w3-tag w3-teal w3-round">' . $matiere_nom . '</span>

                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                                        <h5 class="w3-text-teal"><i class="fa fa-asterisk fa-fw w3-margin-right"></i>
                            ' . $niveau_min_nom . ' - <span
                                        class="w3-tag w3-teal w3-round">' . $niveau_max_nom . '</span></h5>                           </td>
                            <td style="text-align: right">
<h1
                                        class="w3-tag w3-blue-grey w3-round">' . $tarif . '€</h1>

                            </td>
                        </tr>
                    </table>
    <table style="width: 100%">
        <tr>
            <td style="text-align: left">
            <h5>
                Participant : ' . $nom_participant . ' ' . $prenom_participant . '</h5>
            </td>
            <td style="text-align: right">
                <h1 class="w3-tag w3-teal w3-round">' . $duree . 'h</h1>
            </td>
        </tr>
    </table>' .
            '
    <p>' . substr($description, 0, 196) . ' ...</p>
    <p style="text-align: right">' . $date_inscription . '</p>
    <hr>
</div>';

        return $widget;
    }

    private function getListeDesSeancesCoursDemande($enseignant)
    {
        $widgets = '';

        $bd = new BdConnexion();
        $idEnseignant = $enseignant->getIdPersonne();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur,
                M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom,
                S.date_inscription, S.date_realisation, S.participant, S.duree, S.etat,
                P.nom as nom_auteur,P.prenom as prenom_auteur,P.email as email_auteur,P.date_naissance as date_naissance_auteur, P.type_personne as type_personne_auteur
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax, SeanceCours S, Personne P
                WHERE S.participant = $idEnseignant and M.id = C.matiere
                and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
                and S.proposition_cours = C.id and P.id = C.id_auteur
                ORDER BY date_realisation DESC
                LIMIT 5;
                ";
        $result = $bdd->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widgets = $widgets . $this->displaySeanceCoursDemande($row);
            }
        } else {
            echo "0 results";
        }

        $bdd->close();

        return $widgets;
    }

    private function getListeDesSeancesCoursDemandeAdmin()
    {
        $widgets = '';

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "SELECT C.id, C.nom, C.description, C.tarif, C.date_creation, C.id_auteur,
                M.nom as matiere_nom,Nmin.nom as niveau_min_nom,Nmax.nom as niveau_max_nom,
                S.date_inscription, S.date_realisation, S.participant, S.duree, S.etat,
                P.nom as nom_auteur,P.prenom as prenom_auteur,P.email as email_auteur,P.date_naissance as date_naissance_auteur, P.type_personne as type_personne_auteur
                FROM Cours C, Matiere M, NiveauEtude Nmin , NiveauEtude Nmax, SeanceCours S, Personne P
                WHERE M.id = C.matiere
                and Nmin.id = C.niveau_etude_min and Nmax.id = C.niveau_etude_max
                and S.proposition_cours = C.id and P.id = C.id_auteur
                ORDER BY date_realisation DESC
                LIMIT 5;
                ";
        $result = $bdd->query($sql);


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widgets = $widgets . $this->displaySeanceCoursDemande($row);
            }
        } else {
            echo "0 results";
        }

        $bdd->close();

        return $widgets;
    }

    private function displaySeanceCoursDemande($row)
    {
        $id = $row['id'];
        $nom = $row['nom'];
        $description = $row['description'];
        $tarif = $row['tarif'];
        $date_creation = $row['date_creation'];
        $id_auteur = $row['id_auteur'];
        $matiere_nom = $row['matiere_nom'];
        $niveau_min_nom = $row['niveau_min_nom'];
        $niveau_max_nom = $row['niveau_max_nom'];
        $date_inscription = $row['date_inscription'];
        $date_realisation = $row['date_realisation'];
        $participant = $row['participant'];
        $duree = $row['duree'];
        $etat = $row['etat'];
        $nom_auteur = $row['nom_auteur'];
        $prenom_auteur = $row['prenom_auteur'];
        $email_auteur = $row['email_auteur'];
        $date_naissance_auteur = $row['date_naissance_auteur'];
        $type_personne_auteur = $row['type_personne_auteur'];
        $widget = '<div class="w3-container">
<table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                            <h4 class="w3-opacity"><b>' . $nom . '</b></h4>                            </td>
                            <td style="text-align: right">
<span
                                        class="w3-tag w3-teal w3-round">' . $matiere_nom . '</span>

                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                                        <h5 class="w3-text-teal"><i class="fa fa-asterisk fa-fw w3-margin-right"></i>
                            ' . $niveau_min_nom . ' - <span
                                        class="w3-tag w3-teal w3-round">' . $niveau_max_nom . '</span></h5>                           </td>
                            <td style="text-align: right">
<h1
                                        class="w3-tag w3-blue-grey w3-round">' . $tarif . '€</h1>

                            </td>
                        </tr>
                    </table>
    <table style="width: 100%">
        <tr>
            <td style="text-align: left">
            <h5>
                Organisateur : ' . $nom_auteur . ' ' . $prenom_auteur . ' </h5>
            </td>
            <td style="text-align: right">
                <h1 class="w3-tag w3-teal w3-round">' . $duree . 'h</h1>
            </td>
        </tr>
    </table>' .
            '
    <p>' . substr($description, 0, 196) . ' ...</p>
    <p style="text-align: right">' . $date_inscription . '</p>
    <hr>
</div>';

        return $widget;
    }

    private function displayEleveProfilEdit()
    {
        $eleve = $this->getUserConnected();
        $widgets = '<!-- Header with full-height image -->
            <div class="w3-content w3-margin-top" style="max-width:1400px;">
            
                <!-- The Grid -->
                <div class="w3-row-padding">';
        $widgets = $widgets . '

            <!-- Left Column -->
            <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">';
        $widgets = $widgets . $this->getProfilMainInfosEdit($eleve, Eleve::$TABLE_NAME);
        $widgets = $widgets . '
                </div>
                <br>
    
                <!-- End Left Column -->
            </div>';
        $widgets = $widgets . '
        
                <!-- Right Column -->
                <div class="w3-twothird">';
        $widgets = $widgets . '
                    </div>
        
                    <!-- End Right Column -->
                </div>';
        $widgets = $widgets . '
        
                <!-- End Grid -->
            </div>
        
            <!-- End Page Container -->
        </div>';
        return $widgets;
    }

    private function displayEnseignantProfilEdit()
    {
        $enseignant = $this->getUserConnected();
        $widgets = '<!-- Header with full-height image -->
            <div class="w3-content w3-margin-top" style="max-width:1400px;">
            
                <!-- The Grid -->
                <div class="w3-row-padding">';
        $widgets = $widgets . '

            <!-- Left Column -->
            <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">';
        $widgets = $widgets . $this->getProfilMainInfosEdit($enseignant, Enseignant::$TABLE_NAME);
        $widgets = $widgets . $this->getMatiereEnseigner($enseignant);
        $widgets = $widgets . '
                </div>
                <br>
    
                <!-- End Left Column -->
            </div>';
        $widgets = $widgets . '
        
                <!-- Right Column -->
                <div class="w3-twothird">';
        $widgets = $widgets . '
                    </div>
        
                    <!-- End Right Column -->
                </div>';
        $widgets = $widgets . '
        
                <!-- End Grid -->
            </div>
        
            <!-- End Page Container -->
        </div>';
        return $widgets;
    }

    private function updateProfil($mot_de_passe)
    {
        $personne = $this->getUserConnected();

        $id = $personne->getIdPersonne();
        $nom = $_POST['inputEditProfilNom'];
        $prenom = $_POST['inputEditProfilPrenom'];
        $adresse = $_POST['inputEditProfilAdresse'];
        $email = $_POST['inputEditProfilEmail'];
        $tel = $_POST['inputEditProfilTel'];
        $image = $this->getUploadImage();

        if (strcmp($mot_de_passe, "") === 0) {
            $mot_de_passe = $personne->getMotDePasse();
        }

        echo "mot_de_passe" . $mot_de_passe;

        $date_naissance = $personne->getDateNaissance();;
        $bdd = $this->getDb()->openConn();
        $sql = "";
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

        if ($bdd->query($sql) === TRUE) {

            $personne->setNom($nom);
            $personne->setPrenom($prenom);
            $personne->setEmail($email);
            $personne->setAdresse($adresse);
            $personne->setTelephone($tel);
            $personne->setDateNaissance($date_naissance);
            $personne->setMotDePasse($mot_de_passe);
            if (strcmp($image, "") != 0) {
                $personne->setImage($image);
            }
            $_SESSION["utilisateur"] = $personne;

            echo '<div class="container">
<br>
  <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Session Personne updated successfully </h1>
  </div>
  <div class="alert alert-info alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Info!</strong>
    ' . $_SESSION["utilisateur"] . '
  </div>
</div>';
        } else {
            echo "<div class=\"alert alert-danger alert-dismissible\">
  <strong>Error!</strong> Error: " . $sql . "<br>" . $bdd->error . "
</div>
";
            echo "<br>";
            echo "_SESSION:utilisateur = " . $_SESSION["utilisateur"];
            echo "<br>";
        }

        if (strcmp($personne->getTypePersonne(), Eleve::$TABLE_NAME) === 0) {
            $niveau_etude = $_POST['inputEditProfilNiveauEtude'];


            $sql = "UPDATE Eleve
                SET niveau_etude='$niveau_etude'
                WHERE id=$id
                ;";


            if ($bdd->query($sql) === TRUE) {

                $this->setProfilUpdate(true);
                $niveau_etude_nom = $this->getNiveauEtudeNom($niveau_etude);
                $personne->setNiveauEtude($niveau_etude_nom);
                $_SESSION["utilisateur"] = $personne;
            }

        } else {
            $this->setProfilUpdate(true);
        }

        $this->getDb()->closeConn();
        $_SESSION["profilUpdated"] = true;
    }

    private function getNiveauEtudeNom($niveau_etude)
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
                LIMIT 8
                ;";

        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $niveau_etude_nom = $row['nom'];
            }
        } else {
            echo "0 results";
        }

        $bdd->close();

        return $niveau_etude_nom;
    }

    private function getImagePath()
    {
        $path = "../../../ressources/images/";
        return $path;
    }

    private function getUploadImage()
    {
        $files = $_FILES;
        $target_dir = $this->getImagePath();
        $target_file = $target_dir . basename($_FILES["inputImgProfil"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $newFileName = "fileUpload";
        // Check if image file is a actual image or fake image
        if (isset($_POST["btnSaveEditProfil"])) {
            $check = getimagesize($_FILES["inputImgProfil"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . basename($_FILES["inputImgProfil"]["name"]) . " " . $check["mime"] . ".  <br>";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            return basename($_FILES["inputImgProfil"]["name"]);
        }
        // Check file size
        if ($_FILES["inputImgProfil"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            return "";
            // if everything is ok, try to upload file
        } else {
            echo "<br> Dest : " . $target_file . "<br>";
            echo "<br> Filaname : " . $_FILES["inputImgProfil"]["tmp_name"] . "<br>";
            echo "<br> Try Stored in: " . $target_dir . $newFileName . "<br>";
            if (move_uploaded_file($_FILES["inputImgProfil"]["tmp_name"], $target_file)) {
                echo "Stored in: " . $target_file . $newFileName . "<br>";
                echo "The file " . basename($_FILES["inputImgProfil"]["name"]) . " has been uploaded.";
                return basename($_FILES["inputImgProfil"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
                return "";
            }
        }
    }




}

?>