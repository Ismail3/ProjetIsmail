<?php
require_once(dirname(__FILE__) . '/../AbstractControleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/Personne.php');
require_once(dirname(__FILE__) . '/../../models/classes/Eleve.php');
require_once(dirname(__FILE__) . '/../../models/classes/Enseignant.php');
require_once(dirname(__FILE__) . '/../../models/classes/Cours.php');
require_once(dirname(__FILE__) . '/../../models/classes/CoursSeance.php');


/**
 * Class StatistiquesControleur
 */
class StatistiquesControleur extends AbstractControleur
{

    /**
     *
     */
    public function displayNavBar()
    {
        echo '<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="../../../index.php"
           class="w3-bar-item w3-button w3-wide">
            <img id="logo_header" src="../../../ressources/images/Logo_Apprendre@Comprendre%20Light_Alpha.png" alt="LOGOA@C"/>
        </a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">

            <a href="../authentification/authentification.php" class="w3-bar-item w3-button"><i
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

    /**
     *
     */
    public function displayHeader()
    {
        echo '<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="">
    <div class="w3-display-left w3-text-white full-width-div" style="padding:48px">
        <span class="w3-jumbo w3-hide-small"></span><br>
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

    /**
     * @return string
     */
    private function getStatistiques()
    {
        $nb_eleves = Eleve::getNombreEleves();
        $nb_enseignants = Enseignant::getNombreEnseignants();
        $nb_cours = Cours::getNombreCours();
        $nb_h_seance = CoursSeance::getNombreHeuresRealises();
        $widget = '
                <!-- Promo Section "Statistics" -->
                <div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">
                                    <h3 class="w3-center">Quelques statistiques</h3>
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

    /**
     * @return mixed
     */
    private function getCharts()
    {
        $widget = "";
        $widget = $widget . $this->getPieChartPersonneAge();
        $widget = $widget . $this->getPieChartEleveAge();
        $widget = $widget . $this->getPieChartEnseignantAge();
        return $widget;
    }

    /**
     * @return mixed
     */
    private function getPieChartPersonneAge()
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
                    array_push($plageAge, $i . "-" . ($i + 5)." ans");
                    array_push($nbParPlage, intval($nbPersonne));
                }
            }
        }
        return $this->getPieChart("pieChartPersonneAge", $plageAge, $nbParPlage,"Nombre de personnes par tranche d age");
    }

    private function getPieChartEleveAge()
    {
        $ageMin = Eleve::getMinAge();
        $ageMax = Eleve::getMaxAge();
        $plageAge = array();
        $nbParPlage = array();
        for ($i = $ageMin; $i < $ageMax; $i = $i + 5) {
            $result = Eleve::countUserBetweenAge($i, $i + 5);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $nbEleve = $row['count(*)'];
                    array_push($plageAge, $i . "-" . ($i + 5)." ans");
                    array_push($nbParPlage, intval($nbEleve));
                }
            }
        }
        return $this->getPieChart("pieChartEleveAge", $plageAge, $nbParPlage,"Nombre d élèves par tranche d age");
    }

    private function getPieChartEnseignantAge()
    {
        $ageMin = Enseignant::getMinAge();
        $ageMax = Enseignant::getMaxAge();
        $plageAge = array();
        $nbParPlage = array();
        for ($i = $ageMin; $i < $ageMax; $i = $i + 5) {
            $result = Enseignant::countUserBetweenAge($i, $i + 5);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $nbEnseignant = $row['count(*)'];
                    array_push($plageAge, $i . "-" . ($i + 5)." ans");
                    array_push($nbParPlage, intval($nbEnseignant));
                }
            }
        }
        return $this->getPieChart("pieChartEnseignantAge", $plageAge, $nbParPlage,"Nombre d enseignants par tranche d age");
    }


    /**
     * @param $idPieChart
     * @param $plageAge
     * @param $nbParPlage
     * @return string
     */
    private function getPieChart($idPieChart, $plageAge, $nbParPlage,$title)
    {
        $widget = '
<div>
<br>
    <div  class="w3-center" id="' . $idPieChart . '"></div>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">
    // Load google charts
    google.charts.load(\'current\', {\'packages\':[\'corechart\']});
    google.charts.setOnLoadCallback(drawChart3);
    
    // Draw the chart and set the chart values
    ';
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
\'title\':\''.$title.'\', \'width\':1100, \'height\':800};
    
      // Display the chart inside the <div> element with id="piechart"
      var chart = new google.visualization.PieChart(document.getElementById(\'' . $idPieChart . '\'));
      chart.draw(data, options);
    }
    
    ';
        $widget = $widget . '     
    </script>
    </div>';
        return $widget;
    }

    /**
     *
     */
    public function displayStatistiques()
    {
        $widget = $this->getStatistiques();
        $widget = $widget . $this->getCharts();

        echo $widget;
    }



}