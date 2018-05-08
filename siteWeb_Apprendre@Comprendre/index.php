<?php
require_once(dirname(__FILE__) . '/controlleurs/pages/AccueilControleur.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Apprendre@Comprendre</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link type="text/css" rel="stylesheet" href="ressources/styles/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="ressources/styles/font-awesome.min.css">
    <link rel="stylesheet" href="ressources/styles/bootstrap.min.css">
    <link rel="stylesheet" href="ressources/styles/apprendre@comprendre.css">
    <link rel="stylesheet" href="ressources/styles/template.css">
    <link rel="stylesheet" href="ressources/styles/template-accueil.css">

    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/common.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/map.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/util.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/marker.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/onion.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/controls.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/stats.js"></script>
    <script src="ressources/javascript/js"></script>
    <script src="ressources/javascript/apprendre@comprendre.js"></script>
</head>
<body cz-shortcut-listen="true">

<?php

$accueilCtrl = new AccueilControleur();

$accueilCtrl->displayNavBar();
$accueilCtrl->displayHeader();
$accueilCtrl->displayTopButton();
//$accueilCtrl->debugSession();
$accueilCtrl->destroyConnexion();
$accueilCtrl->displayContenu();
$accueilCtrl->displayFooter();

?>

</body>
</html>
