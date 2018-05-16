<?php
require_once(dirname(__FILE__) . '/../AbstractControleur.php');


class AccueilControleur extends AbstractControleur
{

    public function displayNavBar()
    {
        echo '<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="#home"
           class="w3-bar-item w3-button w3-wide">
            <img id="logo_header" src="ressources/images/Logo_Apprendre@Comprendre%20Light_Alpha.png" alt="LOGOA@C"/>
        </a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">

            <a href="templates/pages/authentification/authentification.php" class="w3-bar-item w3-button"><i
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

    public function displayHeader()
    {
        echo '<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-text-white full-width-div" style="padding:48px">
        <span class="w3-jumbo w3-hide-small"></span><br>
        <div align="center">
            <h1><strong> Aprendre@Comprendre</strong></h1>
            <span class="w3-large">Économisons du temps d\'apprentissage en apprennant à mieux comprendre</span>
            <p><a href="#about"
                  class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">En savoir plus sur nous</a></p>
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


    public function displayTopButton()
    {
        echo '<button onclick="topFunction()" id="topBtn" title="Go to top">Top</button>';
    }

    public function displayContenu()
    {
        $widgets = $this->getInfosSiteWeb();

        echo $widgets;
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
</footer>
';
    }

    public function destroyConnexion()
    {
        if ($this->isUserConnected()){
             session_destroy();
         }
    }

    private function getInfosSiteWeb()
    {
        $widget = $this->getInfosApropos();
        $widget = $widget . $this->getStatistiques();

        return $widget;
    }

    private function getInfosApropos()
    {
        $widget = '
<!-- About Section -->
<div class="w3-container" style="padding:128px 16px" id="about">
    <h3 class="w3-center">À propos de <strong> Aprendre@Comprendre</strong></h3>
    <p class="w3-center w3-large">Quelques caractéristiques clé</p>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-quarter">
            <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
            <p class="w3-large">Numérique</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore. Site Web</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-heart w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Passion</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore. Volontariat</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Union</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore.Solide comme le diamant</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Méthodologies</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore.Méthodologie</p>
        </div>
    </div>
</div>';
        $widget = $widget . '

<!-- Promo Section - "We know design" -->
<div class="w3-container w3-light-grey" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <h3>Des cours particuliers designer pour vous.</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>tempor incididunt ut labore et
                dolore.</p>
            <p><a href="#work" class="w3-button w3-black"><i
                    class="fa fa-th">&nbsp;</i> Qulesques matières</a></p>
        </div>
        <div class="w3-col m6">
            <img class="w3-image w3-round-large" src="ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                 width="700" height="394">
        </div>
    </div>
</div>';
        $widget = $widget . '

<!-- Team Section -->
<div class="w3-container" style="padding:128px 16px" id="team">
    <h3 class="w3-center">Quelques enseignants</h3>
    <p class="w3-center w3-large">Unie par la volonté de transmettre la connaissance</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="ressources/images/team2.jpg" alt="John" style="width:100%">
                <div class="w3-container">
                    <h3>John Doe</h3>
                    <p class="w3-opacity">CEO &amp; Founder</p>
                    <p>Phasellus edisplay enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="ressources/images/team1.jpg" alt="Jane" style="width:100%">
                <div class="w3-container">
                    <h3>Anja Doe</h3>
                    <p class="w3-opacity">Art Director</p>
                    <p>Phasellus edisplay enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="ressources/images/team3.jpg" alt="Mike" style="width:100%">
                <div class="w3-container">
                    <h3>Mike Ross</h3>
                    <p class="w3-opacity">Web Designer</p>
                    <p>Phasellus edisplay enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="ressources/images/team4.jpg" alt="Dan" style="width:100%">
                <div class="w3-container">
                    <h3>Dan Star</h3>
                    <p class="w3-opacity">Designer</p>
                    <p>Phasellus edisplay enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
';

        return $widget;
    }

    private function getStatistiques()
    {
        $nb_eleves = $this->getNombreEleves();
        $nb_enseignants = $this->getNombreEnseignants();
        $nb_cours = $this->getNombreCours();
        $nb_h_seance = $this->getNombreHeuresRealises();
        $widget = '
                <!-- Promo Section "Statistics" -->
                <div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">
                    <div class="w3-quarter">
                        <span class="w3-xxlarge">+ '.$nb_h_seance.'</span>
                        <br>Heures réalisés
                    </div>
                    <div class="w3-quarter">
                        <span class="w3-xxlarge">+ ' . $nb_cours . '</span>
                        <br>Cours proposé
                    </div>
                    <div class="w3-quarter">
                        <span class="w3-xxlarge">+ ' . $nb_enseignants . '</span>
                        <br>Enseignants
                    </div>
                    <div class="w3-quarter">
                        <span class="w3-xxlarge">+ ' . $nb_eleves . '</span>
                        <br>Élèves
                    </div>
                </div>
                ';

        return $widget;
    }

    private function getNombreEleves()
    {
        $nbEleve = 0;

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select count(*) as nbEleve from Eleve ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $nbEleve = $row['nbEleve'];
            }
        }

        $bdd->close();

        return $nbEleve;
    }

    private function getNombreEnseignants()
    {
        $nbEnseignant = 0;

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select count(*) as nbEnseignant from Enseignant ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $nbEnseignant = $row['nbEnseignant'];
            }
        }

        $bdd->close();

        return $nbEnseignant;
    }

    private function getNombreCours()
    {
        $nbCours = 0;

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select count(*) as nbCours from Cours ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $nbCours = $row['nbCours'];
            }
        }

        $bdd->close();

        return $nbCours;
    }

    private function getNombreHeuresRealises()
    {
        $nbHRealisees = 0;

        $bd = new BdConnexion();

        // Create connection
        $bdd = $bd->openConn();
        // Check connection
        if ($bdd->connect_error) {
            die("Connection failed: " . $bdd->connect_error);
        }

        $sql = "select sum(duree) as nbHRealisees from SeanceCours ;";
        $result = $bdd->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $nbHRealisees = $row['nbHRealisees'];
            }
        }

        $bdd->close();

        return $nbHRealisees;
    }
}