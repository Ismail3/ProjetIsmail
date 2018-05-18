<?
require_once(dirname(__FILE__) . '/../../../controlleurs/pages/CoursControleur.php');
$ctrl = new CoursControleur();
header('Location: ' . $ctrl->url . 'templates/pages/tableauDeBord/tableauDeBordCours.php');
?>