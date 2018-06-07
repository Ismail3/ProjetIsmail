<?php
require_once(dirname(__FILE__) . '/../models/basesDeDonnées/BdConnexion.php');

class AbstractControleur
{
    /*
     * Attributs
     */
    public $url = "http://localhost/LAMP/ProjetIsmail/siteWeb_Apprendre@Comprendre";

    /**
     * AbstractControleur constructor.
     */
    public function __construct()
    {
    }

    public function displayHeader()
    {
        echo '<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-text-white full-width-div" style="padding:48px">
        <span class="w3-jumbo w3-hide-small"></span><br>
    </div>
</header>';
    }

    public function displayTopButton()
    {

        echo '<button onclick="topFunction()" id="topBtn" title="Go to top">Top</button>';
    }

    public function displayContenu()
    {
        echo '';
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

    public function debugSession()
    {
        var_dump($_SESSION);
    }

    public function isUserConnected()
    {
        return !empty($_SESSION) && !empty($_SESSION) && array_key_exists('utilisateur', $_SESSION) && !empty($_SESSION['utilisateur']);
    }

    /**
     * @param $mot_de_passe
     * @param $mot_de_passe_confirm
     * @return bool
     */
    public function validerMotDePasse($mot_de_passe, $mot_de_passe_confirm)
    {
        return strcmp($mot_de_passe, $mot_de_passe_confirm) == 0;
    }


    /**
     * @return Personne
     */
    protected function getUserConnected()
    {
        return $_SESSION['utilisateur'];
    }

    protected function isAdministrateur()
    {
        return (strcmp($this->getUserConnected()->getTypePersonne(), Administrateur::$TABLE_NAME)===0);
    }


    public function isEleve()
    {
        return (strcmp($this->getUserConnected()->getTypePersonne(), Eleve::$TABLE_NAME) === 0);
    }

    public function isEnseignant()
    {
        return (strcmp($this->getUserConnected()->getTypePersonne(), Enseignant::$TABLE_NAME) === 0);
    }

}