<?php
require_once(dirname(__FILE__) . '/ConnectedUserControleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/NiveauEtude.php');
require_once(dirname(__FILE__) . '/../../models/classes/Cours.php');

class CoursControleur extends ConnectedUserControleur
{

    /*
     * Attributs
     */

    private $inputNomCoursErr;
    private $inputDescriptionCoursErr;
    private $inputTarifCoursErr;
    private $inputMatiereCoursErr;
    private $inputNiveauEtudeMinCoursErr;
    private $inputNiveauEtudeMaxCoursErr;

    /*
     * Méthodes
     */
    public function displayNouveauCours()
    {

        $nomCours = $_POST["inputNomCours"];
        $descriptionCours = $_POST["inputDescriptionCours"];
        $tarifCours = $_POST["inputTarifCours"];
        $matiereCours = $_POST["inputMatiereCours"];
        $niveauEtudeMinCours = $_POST["inputNiveauEtudeMinCours"];
        $niveauEtudeMaxCours = $_POST["inputNiveauEtudeMaxCours"];

        $widget = '
    <div class="w3-container" style="padding:128px 16px">
    <h3 class="w3-center">Nouveau cours</h3>
    <p class="w3-left w3-large">Veuillez renseigner ci-dessous l\'ensemble des informations nécessaires à la création d\'un nouveau cours : </p>
    <div class="" style="margin-top:16px">';

        //Liste des cours crées
        $widget = $widget . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Cours </h2>';
        $widget = $widget . '
        <!-- Promo Section - "We know design" -->
        <div id="creationCours" class="w3-container ">
            <div class="w3-row-padding">
                    <form action="" method="post">
                        <fieldset>';
        $widget = $widget . '
                            <legend>Nouveau cours</legend>
                            <div class="form-group">
                                <label for="inputNomCours">Nom</label>
                                <input type="text" class="form-control" 
                                name="inputNomCours"
                                id="inputNomCours" aria-describedby="nomHelp" 
                                placeholder="Entrer le nom du cours"
                                value="' . $nomCours . '">';
        $widget = $widget . '<small style="color:red;" id="nomErr" name="nomErr" class="form-text">' . $this->inputNomCoursErr . '</small>';
        $widget = $widget . '
        </div>';
        $widget = $widget . '
                            <div class="form-group">
                                <label for="inputDescriptionCours">Description</label>
                                <textarea type="text" rows="5" class="form-control" 
                                name="inputDescriptionCours"
                                id="inputDescriptionCours" aria-describedby="prénomHelp" placeholder="Entrer votre Prénom"
                                value="' . $descriptionCours . '">
                                </textarea>';
        $widget = $widget . '<small style="color:red;" id="emailErr" name="prenomErr" class="form-text">' . $this->inputDescriptionCoursErr . '</small>';
        $widget = $widget . '
                            </div>';
        $widget = $widget . '                            <div class="form-group">
                                <label for="inputTarifCours">Tarif</label>
                                <input type="number" class="form-control" 
                                name="inputTarifCours"
                                id="inputTarifCours"
                                value="' . $tarifCours . '">';
        $widget = $widget . '<small style="color:red;" id="dateNaissanceErr" name="dateNaissanceErr" class="form-text">' . $this->inputTarifCoursErr . '</small>';
        $widget = $widget . '
                            </div>';
        $widget = $widget . '                            <div class="form-group">
                                <label for="inputMatiereCours">Matière</label>';
        $widget = $widget . $this->getMatiereSelect($matiereCours,"inputMatiereCours");
        $widget = $widget . '<small style="color:red;" id="emailErr" name="emailErr" class="form-text">' . $this->inputMatiereCoursErr . '</small>';
        $widget = $widget . '                            </div>';
        $widget = $widget . '                            <div class="form-group">
                                <label for="inputNiveauEtudeMinCours">Niveaux etude min</label>
                                ';
        $widget = $widget . $this->getNiveauEtudeSelect($niveauEtudeMinCours,"inputNiveauEtudeMinCours");
        $widget = $widget . '<small style="color:red;" id="emailErr" name="emailErr" class="form-text">' . $this->inputNiveauEtudeMinCoursErr . '</small>';
        $widget = $widget . '                            </div>';
        $widget = $widget . '
                            <div class="form-group">
                                <label for="inputNiveauEtudeMaxCours">Niveaux etude max</label>
                                ';
        $widget = $widget . $this->getNiveauEtudeSelect($niveauEtudeMaxCours,"inputNiveauEtudeMaxCours");
        $widget = $widget . '<small style="color:red;" id="passwordErr" name="passwordErr" class="form-text">' . $this->inputNiveauEtudeMaxCoursErr . '</small>';
        $widget = $widget . '
                            </div>';
       $widget = $widget . '
                            </div>';
        $widget = $widget . '        
                            </fieldset>
                                <button name="btnNouveauCours" id="btnNouveauCours" value="btnNouveauCours" type="submit" class="btn btn-primary" value = "Envoyer">Submit</button>
                        </fieldset>
                    </form>
            </div>
        </div>';

        $widget = $widget . '
                    </div>
                    </div>';


        echo $widget;

    }

    /**
     * @param $niveauEtude
     */
    private function getNiveauEtudeSelect($niveauEtude,$idInput)
    {
        $widget = '';
        $widget = $widget . $this->getHtmlSelectHead($idInput);
        $widget = $widget . $this->getOptitonNiveauEtude();
        $widget = $widget . '</select>';

        return $widget;
    }

    /**
     * @param $matière
     */
    private function getMatiereSelect($matière,$idInput)
    {
        $widget = '';
        $widget = $widget . $this->getHtmlSelectHead($idInput);
        $widget = $widget . $this->getOptitonMatiere();
        $widget = $widget . '</select>';

        return $widget;
    }

    private function getHtmlSelectHead($idInput)
    {
        return '<select style="height:30px;"class="form-control" id="'.$idInput.'" name="'.$idInput.'">';;
    }


}

?>