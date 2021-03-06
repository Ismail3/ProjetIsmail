<?php

require_once(dirname(__FILE__) . '/../AbstractControleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/Personne.php');
require_once(dirname(__FILE__) . '/../../models/classes/Eleve.php');
require_once(dirname(__FILE__) . '/../../models/classes/Enseignant.php');
require_once(dirname(__FILE__) . '/../../models/classes/Cours.php');
require_once(dirname(__FILE__) . '/../../models/classes/CoursSeance.php');
require_once(dirname(__FILE__) . '/../../models/classes/Matiere.php');
require_once(dirname(__FILE__) . '/../../models/classes/NiveauEtude.php');


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
        if ($this->isUserConnected()) {
            session_destroy();
        }
    }

    private function getInfosSiteWeb()
    {
        $widget = $this->getInfosApropos();
        $widget = $widget . $this->getInfosMatieres();
        $widget = $widget . $this->getInfosEnseignants();
        $widget = $widget . $this->getInfosNiveauxEtudes();
        $widget = $widget . $this->getInfosEleves();
        $widget = $widget . $this->getStatistiques();

        return $widget;
    }

    private function getInfosApropos()
    {
        $widget = '
<!-- About Section -->
<div class="w3-container" style="padding:128px 16px" id="about">
    <h3 class="w3-center">À propos de <strong> Aprendre@Comprendre</strong></h3>';
        $widget = $widget . $this->displayQuelquesCaracteristiques();

        return $widget;
    }

    private function getStatistiques()
    {
        $nb_eleves = Eleve::getNombreEleves();
        $nb_enseignants = Enseignant::getNombreEnseignants();
        $nb_cours = Cours::getNombreCours();
        $nb_h_seance = CoursSeance::getNombreHeuresRealises();
        $widget = '
                <!-- Promo Section "Statistics" -->
                <div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">
                <a href="./templates/pages/statistiques/statistiques.php">
                                    <h3 class="w3-center">Quelques statistiques</h3>
                  </a>
                    <div class="w3-quarter">
                        <span class="w3-xxlarge">+ ' . $nb_h_seance . '</span>
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

    private function displayQuelquesCaracteristiques()
    {
        return '
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
    }

    /**
     * @return mixed
     */
    private function getCharts()
    {
        $ageMin = Personne::getMinAge();
        $ageMax = Personne::getMaxAge();
        $plageAge = array();
        $nbParPlage = array();
        for ($i = $ageMin; $i < $ageMax; $i = $i + 5) {
            $result = Personne::countUserBetweenAge($i, $i + 5);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $nbPersonne = $row['count(*)'];
                    echo "<br/>";
                    array_push($plageAge, $i . "-" . ($i + 5));
                    array_push($nbParPlage, intval($nbPersonne));
                    echo $i . "-" . ($i + 5) . " ans : " . $nbPersonne;
                }
            }
            echo "<br/>";
        }
        return $this->getPieChart("pieChartPersonneAge", $plageAge, $nbParPlage);
    }

    private function getPieChart($idPieChart, $plageAge, $nbParPlage)
    {
        $widget = '
    <p class="w3-center w3-large">Quelques graphiques</p>
    <h1>My Web Page</h1>

    <div id="' . $idPieChart . '"></div>
    <div id="' . $idPieChart . '2"></div>
    <div id="' . $idPieChart . '3"></div>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
    // Load google charts
    google.charts.load(\'current\', {\'packages\':[\'corechart\']});
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawChart2);
    google.charts.setOnLoadCallback(drawChart3);
    
    // Draw the chart and set the chart values
    ';
        $widget = $widget . '
function drawChart() {
        var data = google . visualization . arrayToDataTable([
            [\'Task\', \'Hours per Day\'],
      [\'Work\', 8],
      [\'Eat\', 2],
      [\'TV\', 4],
      [\'Gym\', 2],
      [\'Sleep\', 8]
    ]);

    // Optional; add a title and set the width and height of the chart
var options = {
\'title\':\'My Average Day\', \'width\':1100, \'height\':800};
    
      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById(\'' . $idPieChart . '\'));
      chart.draw(data, options);
    }

';

        $widget = $widget . '
function drawChart2() { 
    var data = google . visualization . arrayToDataTable([ 
        [\'Age\', \'Nombre individus\'],
        [\'7-12\', 176],
        [\'12-17\', 178],
        [\'17-22\', 198],
        [\'22-27\', 174],
        [\'27-32\', 210],
        [\'32-37\', 59],
        [\'37-42\', 19],
        [\'42-47\', 14],
        [\'47-52\', 20],
        [\'52-57\', 11],
        [\'57-62\', 3]
    ]);

    // Optional; add a title and set the width and height of the chart
var options = {
\'title\':\'My Average Day\', \'width\':550, \'height\':400};
    
      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById(\'' . $idPieChart . '2\'));
      chart.draw(data, options);
    }
    
    ';


        $widget2 = '
function drawChart2() {
        var data = google . visualization . arrayToDataTable([
        [\'Age\', \'Nombre individus\'],';
        for ($i = 0; $i < count($plageAge); $i++) {
            $widget2 = $widget2 . '
              [\'' . $plageAge[$i] . '\', ' . $nbParPlage[$i] . ']';
            if ($i < count($plageAge) - 1) {
                $widget2 = $widget2 . ',';
            }
        }
        $widget2 = $widget2 . ']);\';';
        echo $widget2;

        $widget = $widget . '
function drawChart3() {
        var data = google . visualization . arrayToDataTable([
        [\'Age\', \'Nombre individus\'],';
        for ($i = 0; $i < count($plageAge); $i++) {
            $widget = $widget . '
              [\'' . $plageAge[$i] . '\', ' . $nbParPlage[$i] . ']';
            if ($i < count($plageAge) - 1) {
                $widget = $widget . ',';
            }
        }
        $widget = $widget . ']);';
        $widget = $widget . '

    // Optional; add a title and set the width and height of the chart
var options = {
\'title\':\'My Average Day\', \'width\':550, \'height\':400};
    
      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById(\'' . $idPieChart . '3\'));
      chart.draw(data, options);
    }
    
    ';
        $widget = $widget . '     
    </script>';
        return $widget;
    }

    /**
     * @return string
     */
    private function getInfosMatieres()
    {
        $widget = "";
        $widget = $widget . '

<!-- Promo Section - "We know design" -->
<div class="w3-container w3-light-grey" style="padding:128px 16px">
    <h3 class="w3-center">Quelques matières</h3>

    <div class="w3-row-padding">
        <div class="w3-col m6">';
        $listeMatiere = Matiere::getListeMatiere();
        $listeNbCoursMatiere = Matiere::getListeNbCoursMatiere();

        $widget = $widget . $this->displayListe($listeNbCoursMatiere);


        $widget = $widget . '
        </div>
        <div class="w3-col m6">
            <img class="w3-image w3-round-large" src="ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                 width="700" height="394">
        </div>
    </div>
</div>';
        return $widget;
    }

    private function getInfosEnseignants()
    {
        $widget = "";

        $listeEnseignants = Enseignant::getEnseignantPopulaire();
        $widget = $widget . '

<!-- Team Section -->
<div class="w3-container" style="padding:128px 16px" id="accueilEnseignants">
    <h3 class="w3-center">Quelques enseignants</h3>
    <p class="w3-center w3-large">Unie par la volonté de transmettre la connaissance</p>';
        $widget = $widget . $this->displayListePersonne($listeEnseignants, Enseignant::$TABLE_NAME);
        $widget = $widget . '
    </div>
</div>
';
        return $widget;
    }

    private function displayListeItem($nom, $nb)
    {
        $widget = "<li>";

        $widget = $widget . $nom;
        if(isset($nb)){
            $widget = $widget . '    ';
            $widget = $widget . '<kbd>';
            $widget = $widget . $nb;
            $widget = $widget . ' heures de cours';
            $widget = $widget . '</kbd>';
        }

        $widget = $widget . "</li>";

        return $widget;
    }

    private function displayListe($listeMatiere)
    {
        $widget = "<ul>";

        if ($listeMatiere->num_rows > 0) {
            // output data of each row
            while ($row = $listeMatiere->fetch_assoc()) {
                $widget = $widget . $this->displayListeItem($row['nom'],$row['nb']);

            }
        }

        $widget = $widget . "</ul>";

        return $widget;
    }

    private function getInfosNiveauxEtudes()
    {
        $widget = "";
        $widget = $widget . '

<!-- Promo Section - "We know design" -->
<div class="w3-container w3-light-grey" style="padding:128px 16px">
    <h3 class="w3-center">Quelques niveaux d\'études</h3>

    <div class="w3-row-padding">
        <div class="w3-col m6">';
        $listeNiveauEtude = NiveauEtude::getListeNiveauEtude();
        $listeNbCoursNiveauEtude = NiveauEtude::getListeNbCoursNiveauEtude();

        $widget = $widget . $this->displayListe($listeNbCoursNiveauEtude);


        $widget = $widget . '
        </div>
        <div class="w3-col m6">
            <img class="w3-image w3-round-large" src="ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                 width="700" height="394">
        </div>
    </div>
</div>';
        return $widget;
    }

    private function getInfosEleves()
    {
        $widget = "";

        $widget = $widget . '

<!-- Team Section -->
<div class="w3-container" style="padding:128px 16px" id="accueilElèves">
    <h3 class="w3-center">Quelques élèves</h3>
    <p class="w3-center w3-large">Unie par la volonté de recevoir la connaissance</p>
    ';
        $listeEleves = Eleve::getElevePopulaire();
        $widget = $widget . $this->displayListePersonne($listeEleves, Eleve::$TABLE_NAME);
        $widget = $widget . '
</div>
';
        return $widget;
    }

    private function displayListePersonne($listePersonne, $typePersonne)
    {
        $widget = "";

        if ($listePersonne->num_rows > 0) {
            $numLigne = 0;
            // output data of each row
            while ($row = $listePersonne->fetch_assoc()) {
                if ($numLigne++ == 0) {
                    $widget = $widget . "<div class=\"w3-row-padding w3-grayscale\" style=\"margin-top:64px\">";
                }
                $widget = $widget . $this->displayListePersonneItem($row, $typePersonne);
                if ($numLigne == 4) {
                    $numLigne = 0;
                    $widget = $widget . "</div>";
                }
            }
            if ($numLigne > 0) {
                $widget = $widget . "</div>";
            }
        }

        return $widget;
    }

    private function displayListePersonneItem($row, $typePersonne)
    {


        $widget = "";

        $widget = $widget . "        
        <div class=\"w3-col l3 m6 w3-margin-bottom\">
            <div class=\"w3-card\">
                <img src=\"ressources/images/" . $row["image"] . "\" alt=\"" . $row["nom"] . "_" . $row["prenom"] . "\" style=\"width:100%\">
                <div class=\"w3-container\">
                <a href=\"./templates/pages/profil/profil.php?idPersonne=" . $row["id"] . "&typePersonne=" . $typePersonne . "\">
                    <h4>" . $row["prenom"] . " " . $row["nom"] . "</h4>                
                </a>";
        if (strcmp($typePersonne, Eleve::$TABLE_NAME) == 0) {
            $widget = $widget . "             <p class=\"w3-opacity\"> Élève " . $row["niveau_etude"] . "</p>";
            $widget = $widget . "            <p class=\"w3-opacity\"><b>" . Eleve::$TABLE_NAME . " de : </b>";
            $widget = $widget . $this->displayListeMatiereSuivie($row["id"]);
            $widget = $widget . "            </p> <b> Description : </b>
                    <p>" . substr($row["description"], 0, 25) . " ...</p>";
        } else {
            $widget = $widget . "            <p class=\"w3-opacity\"><b>" . Enseignant::$TABLE_NAME . " de : </b>";
            $widget = $widget . $this->displayListeMatiereEnseigner($row["id"]);
            $widget = $widget . "            </p> <b> Description : </b>
                    <p>" . substr($row["description"], 0, 25) . " ...</p>";
        }
        $widget = $widget . "
                    <p><kbd>Inscript depuis " . $this->calculerTempsInscription($row["date_inscription"]) . "</kbd></p>
                </div>
            </div>
        </div>";

        return $widget;
    }

    private function displayListeMatiereEnseigner($id)
    {
        $widget = "";
        $listeMatiereEnseigner = Enseignant::getListeMatiereEnseigner($id);
        $listeNbCoursMatiereEnseigner = Enseignant::getListeNbCoursMatiereEnseigner($id);
        $widget = $widget . $this->displayListe($listeNbCoursMatiereEnseigner);
        return $widget;
    }

    private function displayListeMatiereSuivie($id)
    {
        $widget = "";
        $listeNbCoursMatiereSuivie = Eleve::getListeNbCoursMatiereSuivie($id);
        $widget = $widget . $this->displayListe($listeNbCoursMatiereSuivie);
        return $widget;
    }

    private function calculerTempsInscription($date_inscription)
    {
        $datetime1 = new DateTime(date('Y-m-d', strtotime($date_inscription)));
        $datetime2 = new DateTime(date('Y-m-d'));
        $interval = $datetime1->diff($datetime2);
        $tempsInscription = intval($interval->format('%R%a jours'));
        if ($tempsInscription < 30) {
            return $tempsInscription . " jours";
        } elseif ($tempsInscription < 365.25) {
            return intval($tempsInscription / 30.43) . " mois";
        } else {
            return intval($tempsInscription / 365.25) . " ans";
        }
    }
}