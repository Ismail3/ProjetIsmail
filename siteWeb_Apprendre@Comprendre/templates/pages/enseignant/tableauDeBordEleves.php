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
    <link rel="stylesheet" href="../../../ressources/styles/template-tableau-de-bord-enseignant.css">

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
require(dirname(__FILE__) . '/../../../controlleurs/pages/enseignant/TableauDeBordControlleur.php');

require(dirname(__FILE__) . '/../../widgets/enseignant/navbar.php');
require(dirname(__FILE__) . '/../../widgets/enseignant/header.php');
require(dirname(__FILE__) . '/../../widgets/topButton.php');
?>


<!-- Team Section -->
<div class="w3-container" style="padding:128px 16px" id="team">
    <h3 class="w3-center">Vos élèves</h3>
    <p class="w3-center w3-large">Dans ces rubriques vous pouvez contacter vos élèves ou visualer les cours ques vous
        avez ou devez réaliser avec eux</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <?php

        $controlleur = new TableauDeBordControlleur();

        $controlleur->displayEleves();

        ?>
    </div>

    <?php
    $controlleur->displayPage();

    ?>

</div>


<!-- Footer -->
<?php
require(dirname(__FILE__) . '/../../widgets/footer.php');
?>


</body>
</html>
