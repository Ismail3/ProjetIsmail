<!DOCTYPE html>
<!-- saved from url=(0062) -->
<html>
<head>
    <title>Apprendre@Comprendre</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link type="text/css" rel="stylesheet" href="../../../ressources/styles/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../ressources/styles/font-awesome.min.css">
    <link rel="stylesheet" href="../../../ressources/styles/bootstrap.min.css">
    <link rel="stylesheet" href="../../../ressources/styles/apprendre@comprendre.css">
    <link rel="stylesheet" href="../../../ressources/styles/template-tableau-de-bord.css">

    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/common.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/map.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/util.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/marker.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/onion.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/controls.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/stats.js"></script>
    <script src="../../../ressources/javascript/js"></script>
    <script src="../../../ressources/javascript/apprendre@comprendre.js"></script>
</head>

<body cz-shortcut-listen="true">
<?php
require_once(dirname(__FILE__) . '/../../widgets/enseignant/navbar.php');
require_once(dirname(__FILE__) . '/../../widgets/enseignant/header.php');
require_once(dirname(__FILE__) . '/../../widgets/topButton.php');
?>


<!-- Team Section -->
<div class="w3-container" style="padding:128px 16px" id="team">
    <h3 class="w3-center">Ressources pédagogiques</h3>
    <p class="w3-center w3-large">Dans cette rubrique vous pouvez trouvez un ensemble de ressource documentaire afin de vous aider à travailler dans les meilleurs conditions</p>
        <?php

        require_once('../../../models/classes/Ressource.php');

        function displayRessource($nom, $type, $image)
        {
            $eleve = '<div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../../ressources/images/' . $image . '" alt="John" style="width: 100%;max-height: 200px">
                <div class="w3-container">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                <h3>' . $nom . '</h3>
                            </td>
                            <td style="text-align: right">
                                                    <p class="w3-opacity">' . $type . '</p>

                            </td>
                        </tr>
                    </table>

                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-book"></i> Plus d\'informations</button>
                    </p>
                </div>
            </div>
        </div>';

            echo $eleve;
        }

        function listRessources()
        {
            $id=1;
            $listRessources = array();
            $googleDrive = new Ressource($id++, "Google Drive", "Google Drive", "logo_google_drive_01.png", "Travaux collaboratifs");
            array_puSH($listRessources, $googleDrive);

            $googleDoc = new Ressource($id++, "Google Doc", "Google Doc", "logo_google_doc.png", "Traitement de texte");
            array_puSH($listRessources, $googleDoc);

            $googleSheet = new Ressource($id++, "Google Sheet", "Google Sheet", "logo_google_sheet.png", "Tableur");
            array_puSH($listRessources, $googleSheet);

            $googleSlide = new Ressource($id++, "Google Slide", "Google Slide", "logo_google_slide.png", "Présentation diapositive");
            array_puSH($listRessources, $googleSlide);

            $git = new Ressource($id++, "Git", "Git", "logo_git.jpg", "Logiciel de gestion de versions");
            array_puSH($listRessources, $git);

            $gitHub = new Ressource($id++, "GitHub", "GitHub", "logo_github.png", "Logiciel de gestion de versions");
            array_puSH($listRessources, $gitHub);

            $atom = new Ressource($id++, "Atom", "Atom", "logo_atom.png", "Éditeur de code");
            array_puSH($listRessources, $atom);

            $w3school = new Ressource($id++, "W3School", "W3School", "logo_w3school.jpeg", "Tutoriel");
            array_puSH($listRessources, $w3school);

            $col = 0;
            for ($x = 0; $x <= count($listRessources); $x++) {
                if ($col == 0) {
                    //Nouvelle ligne
                    echo '<div class="w3-row-padding w3-grayscale" style="margin-top:64px">';
                    $col++;
                }
                echo displayRessource($listRessources[$x]->getNom(), $listRessources[$x]->getTypeRessource(), $listRessources[$x]->getImage());
                if ($col == 4 || $x == count($listRessources)-1) {
                    //Nouvelle ligne
                    echo '</div>';
                    $col=0;
                }
            }
        }

        listRessources();
        ?>
    </div>


    <!-- Footer -->
    <?php
    require_once(dirname(__FILE__) . '/../../widgets/footer.php');
    ?>


</body>
</html>
