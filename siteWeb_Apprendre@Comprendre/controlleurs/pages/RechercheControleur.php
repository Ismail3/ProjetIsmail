<?php
require_once(dirname(__FILE__) . '/ConnectedUserControleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/NiveauEtude.php');
require_once(dirname(__FILE__) . '/../../models/classes/Ressource.php');
require_once(dirname(__FILE__) . '/../../models/classes/Cours.php');

class RechercheControleur extends ConnectedUserControleur
{
    public function displayRechercheResult()
    {
        echo "Recherche : " . $_GET["recherche"];
    }
}

?>