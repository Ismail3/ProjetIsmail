<?php
require_once(dirname(__FILE__) . '/ConnectedUserControleur.php');
require_once(dirname(__FILE__) . '/ProfilControleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/NiveauEtude.php');
require_once(dirname(__FILE__) . '/../../models/classes/Cours.php');

class CoursControleur extends ConnectedUserControleur
{

    /*
     * Attributs
     */

    //Nouveau cours
    private $inputNomCoursErr;
    private $inputDescriptionCoursErr;
    private $inputTarifCoursErr;
    private $inputMatiereCoursErr;
    private $inputNiveauEtudeMinCoursErr;
    private $inputNiveauEtudeMaxCoursErr;
    //Maj cours
    private $inputNomCoursMajErr;
    private $inputDescriptionCoursMajErr;
    private $inputTarifCoursMajErr;
    private $inputMatiereCoursMajErr;
    private $inputNiveauEtudeMinCoursMajErr;
    private $inputNiveauEtudeMaxCoursMajErr;

    /*
     * Méthodes
     */
    /**
     * @param $niveauEtude
     */
    private function getNiveauEtudeSelect($niveauEtude, $idInput)
    {
        $widget = '';
        $widget = $widget . $this->getHtmlSelectHead($idInput);
        $widget = $widget . $this->getOptitonNiveauEtude($niveauEtude);
        $widget = $widget . '</select>';

        return $widget;
    }

    /**
     * @param $matière
     */
    private function getMatiereSelect($matiere, $idInput)
    {
        $widget = '';
        $widget = $widget . $this->getHtmlSelectHead($idInput);
        $widget = $widget . $this->getOptitonMatiere($matiere);
        $widget = $widget . '</select>';

        return $widget;
    }

    /**
     * @param $idInput
     * @return string
     */
    private function getHtmlSelectHead($idInput)
    {
        return '<select style="height:30px;"class="form-control" id="' . $idInput . '" name="' . $idInput . '">';;
    }

    /*
     * ===============================================================
     * Nouveau cours
     * ===============================================================
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
                                value="' . $descriptionCours . '"></textarea>';
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
        $widget = $widget . $this->getMatiereSelect($matiereCours, "inputMatiereCours");
        $widget = $widget . '<small style="color:red;" id="emailErr" name="emailErr" class="form-text">' . $this->inputMatiereCoursErr . '</small>';
        $widget = $widget . '                            </div>';
        $widget = $widget . '                            <div class="form-group">
                                <label for="inputNiveauEtudeMinCours">Niveaux etude min</label>
                                ';
        $widget = $widget . $this->getNiveauEtudeSelect($niveauEtudeMinCours, "inputNiveauEtudeMinCours");
        $widget = $widget . '<small style="color:red;" id="emailErr" name="emailErr" class="form-text">' . $this->inputNiveauEtudeMinCoursErr . '</small>';
        $widget = $widget . '                            </div>';
        $widget = $widget . '
                            <div class="form-group">
                                <label for="inputNiveauEtudeMaxCours">Niveaux etude max</label>
                                ';
        $widget = $widget . $this->getNiveauEtudeSelect($niveauEtudeMaxCours, "inputNiveauEtudeMaxCours");
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

    public function nouveauCours()
    {
        if (isset($_POST['btnNouveauCours'])) {
            if ($this->formulaireNouveauCoursComplet()) {

                $enseignant = $this->getUserConnected();

                $nomCours = $_POST["inputNomCours"];
                $descriptionCours = $_POST["inputDescriptionCours"];
                $tarifCours = $_POST["inputTarifCours"];
                $matiereCours = $_POST["inputMatiereCours"];
                $niveauEtudeMinCours = $_POST["inputNiveauEtudeMinCours"];
                $niveauEtudeMaxCours = $_POST["inputNiveauEtudeMaxCours"];

                $id_cours = Cours::nouveauCours($enseignant, $nomCours, $descriptionCours, $tarifCours, $matiereCours, $niveauEtudeMinCours, $niveauEtudeMaxCours);

                if ($id_cours != -1) {
                    header('Location: ' . $this->url . 'templates/pages/tableauDeBord/tableauDeBordCours.php');
                    exit();
                    echo "Nouveau cours";
                } else {
                    echo "Vous êtes actuellement déconnecté";
                }
            }
        }
    }

    private function formulaireNouveauCoursComplet()
    {
        $formulaire_complet = true;

        $nomCours = $_POST["inputNomCours"];
        $descriptionCours = $_POST["inputDescriptionCours"];
        $tarifCours = $_POST["inputTarifCours"];
        $matiereCours = $_POST["inputMatiereCours"];
        $niveauEtudeMinCours = $_POST["inputNiveauEtudeMinCours"];
        $niveauEtudeMaxCours = $_POST["inputNiveauEtudeMaxCours"];


        if (empty($nomCours)) {
            $this->inputNomCoursErr = $this->inputNomCoursErr . "email manquant";
            $formulaire_complet = false;
        } else {
            $this->inputNomCoursErr = "";
        }
        if (empty($descriptionCours)) {
            $this->inputDescriptionCoursErr = $this->inputDescriptionCoursErr . "mot_de_passe manquant";
            $formulaire_complet = false;
        } else {
            $this->inputDescriptionCoursErr = "";
        }
        if (empty($tarifCours)) {
            $this->inputTarifCoursErr = $this->inputTarifCoursErr . "mot_de_passe_confirm manquant";
            $formulaire_complet = false;
        } else {
            $this->inputTarifCoursErr = "";
        }
        if (empty($matiereCours)) {
            $this->inputMatiereCoursErr = $this->inputMatiereCoursErr . "nom manquant";
            $formulaire_complet = false;
        } else {
            $this->inputMatiereCoursErr = "";
        }
        if (empty($niveauEtudeMinCours)) {
            $this->inputNiveauEtudeMinCoursErr = $this->inputNiveauEtudeMinCoursErr . "prenom manquant";
            $formulaire_complet = false;
        } else {
            $this->inputNiveauEtudeMinCoursErr = "";
        }
        if (empty($niveauEtudeMaxCours)) {
            $this->inputNiveauEtudeMaxCoursErr = $this->inputNiveauEtudeMaxCoursErr . "date_naissance manquant";
            $formulaire_complet = false;
        } else {
            $this->inputNiveauEtudeMaxCoursErr = "";
        }

        return $formulaire_complet;
    }

    /*
     * ===============================================================
     * Mise à jours cours
     * ===============================================================
     */

    public function displayMajCours()
    {
        $idCours = $_GET["id"];
        $nomCours = "";
        $descriptionCours = "";
        $tarifCours = "";
        $matiereCours = "";
        $niveauEtudeMinCours = "";
        $niveauEtudeMaxCours = "";

        if ($this->formulaireMajCoursVide()) {
            //Avant modification du formulaire
            $result = Cours::getCours($idCours);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $nomCours = $row["nom"];
                    $descriptionCours = $row["description"];
                    $tarifCours = $row["tarif"];
                    $matiereCours = $row["matiere"];
                    $niveauEtudeMinCours = $row["niveau_etude_min"];
                    $niveauEtudeMaxCours = $row["niveau_etude_max"];
                    $enLigneCours = $row["en_ligne"];
                }
            } else {
                echo "getNiveauEtudeNom : 0 results";
            }

        } else {
            //Après modification du formulaire
            $nomCours = $_POST["inputNomCours"];
            $descriptionCours = $_POST["inputDescriptionCours"];
            $tarifCours = $_POST["inputTarifCours"];
            $matiereCours = $_POST["inputMatiereCours"];
            $niveauEtudeMinCours = $_POST["inputNiveauEtudeMinCours"];
            $niveauEtudeMaxCours = $_POST["inputNiveauEtudeMaxCours"];
        }

        $widget = '
    <div class="w3-container" style="padding:128px 16px">
    <h2 class="w3-center w3-text-grey w3-padding-16"><i
                                    class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Mise à jours cours </h2>
    <p class="w3-left w3-large">Veuillez renseigner ci-dessous l\'ensemble des informations nécessaires à la mise à jours d\'un cours : </p>
    <div class="" style="margin-top:16px">';

        //Liste des cours crées
        $widget = $widget . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">';
        $widget = $widget . '
        <!-- Promo Section - "We know design" -->
        <div id="creationCours" class="w3-container ">
            <div class="w3-row-padding">
                    <form action="" method="post"
                        <fieldset>';
        $widget = $widget . '
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
                                value="">' . $descriptionCours . '</textarea>';
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
        $widget = $widget . $this->getMatiereSelect($matiereCours, "inputMatiereCours");
        $widget = $widget . '<small style="color:red;" id="emailErr" name="emailErr" class="form-text">' . $this->inputMatiereCoursErr . '</small>';
        $widget = $widget . '                            </div>';
        $widget = $widget . '                            <div class="form-group">
                                <label for="inputNiveauEtudeMinCours">Niveaux etude min</label>
                                ';
        $widget = $widget . $this->getNiveauEtudeSelect($niveauEtudeMinCours, "inputNiveauEtudeMinCours");
        $widget = $widget . '<small style="color:red;" id="emailErr" name="emailErr" class="form-text">' . $this->inputNiveauEtudeMinCoursErr . '</small>';
        $widget = $widget . '                            </div>';
        $widget = $widget . '
                            <div class="form-group">
                                <label for="inputNiveauEtudeMaxCours">Niveaux etude max</label>
                                ';
        $widget = $widget . $this->getNiveauEtudeSelect($niveauEtudeMaxCours, "inputNiveauEtudeMaxCours");
        $widget = $widget . '<small style="color:red;" id="passwordErr" name="passwordErr" class="form-text">' . $this->inputNiveauEtudeMaxCoursErr . '</small>';
        $widget = $widget . '
                            </div>';
        $widget = $widget . '
                            </div>';
        $widget = $widget . '        
                            </fieldset>
                                <button name="btnMajCours" id="btnMajCours" value="btnMajCours" type="submit" class="btn btn-primary" value = "Envoyer">Enregistrer</button>
                                <button name="btnSupprCours" id="btnSupprCours" value="btnSupprCours" type="submit" class="btn btn-danger" value = "Supprimer">Supprimer</button>

                        </fieldset>
                    </form>
            </div>
        </div>';

        $widget = $widget . '
                    </div>
                    </div>';


        echo $widget;
    }

    public function majCours()
    {
        if (isset($_POST['btnMajCours'])) {
            if ($this->formulaireMajCoursComplet()) {

                $enseignant = $this->getUserConnected()->getIdPersonne();

                $idCours = $_GET["id"];
                $nomCours = $_POST["inputNomCours"];
                $descriptionCours = $_POST["inputDescriptionCours"];
                $tarifCours = $_POST["inputTarifCours"];
                $matiereCours = $_POST["inputMatiereCours"];
                $niveauEtudeMinCours = $_POST["inputNiveauEtudeMinCours"];
                $niveauEtudeMaxCours = $_POST["inputNiveauEtudeMaxCours"];
                $enligne = 0;

                $supprCours = Cours::majCours($idCours, $enseignant, $nomCours, $descriptionCours, $tarifCours, $matiereCours, $niveauEtudeMinCours, $niveauEtudeMaxCours, $enligne);

                if ($supprCours != -1) {
                    header('Location: ' . $this->url . 'templates/pages/tableauDeBord/tableauDeBordCours.php');
                    exit();
                } else {
                    echo "Erreur à la mise à jour du cours";
                }
            }
        } else if (isset($_POST['btnSupprCours'])) {

            $idCours = $_GET["id"];

            $supprCours = Cours::supprCours($idCours);

            if ($supprCours === TRUE) {
                header('Location: ' . $this->url . 'templates/pages/tableauDeBord/tableauDeBordCours.php');
                exit();
            } else {
                echo "Erreur à la suppresion du cours";
            }
        }
    }

    private function formulaireMajCoursComplet()
    {
        $formulaire_complet = true;

        $nomCours = $_POST["inputNomCours"];
        $descriptionCours = $_POST["inputDescriptionCours"];
        $tarifCours = $_POST["inputTarifCours"];
        $matiereCours = $_POST["inputMatiereCours"];
        $niveauEtudeMinCours = $_POST["inputNiveauEtudeMinCours"];
        $niveauEtudeMaxCours = $_POST["inputNiveauEtudeMaxCours"];


        if (empty($nomCours)) {
            $this->inputNomCoursMajErr = $this->inputNomCoursMajErr . "email manquant";
            $formulaire_complet = false;
        } else {
            $this->inputNomCoursMajErr = "";
        }
        if (empty($descriptionCours)) {
            $this->inputDescriptionCoursMajErr = $this->inputDescriptionCoursMajErr . "mot_de_passe manquant";
            $formulaire_complet = false;
        } else {
            $this->inputDescriptionCoursMajErr = "";
        }
        if (empty($tarifCours)) {
            $this->inputTarifCoursMajErr = $this->inputTarifCoursMajErr . "mot_de_passe_confirm manquant";
            $formulaire_complet = false;
        } else {
            $this->inputTarifCoursMajErr = "";
        }
        if (empty($matiereCours)) {
            $this->inputMatiereCoursMajErr = $this->inputMatiereCoursMajErr . "nom manquant";
            $formulaire_complet = false;
        } else {
            $this->inputMatiereCoursMajErr = "";
        }
        if (empty($niveauEtudeMinCours)) {
            $this->inputNiveauEtudeMinCoursMajErr = $this->inputNiveauEtudeMinCoursMajErr . "prenom manquant";
            $formulaire_complet = false;
        } else {
            $this->inputNiveauEtudeMinCoursMajErr = "";
        }
        if (empty($niveauEtudeMaxCours)) {
            $this->inputNiveauEtudeMaxCoursMajErr = $this->inputNiveauEtudeMaxCoursMajErr . "date_naissance manquant";
            $formulaire_complet = false;
        } else {
            $this->inputNiveauEtudeMaxCoursMajErr = "";
        }

        return $formulaire_complet;
    }

    private function formulaireMajCoursVide()
    {
        $formulaire_vide = true;

        $nomCours = $_POST["inputNomCours"];
        $descriptionCours = $_POST["inputDescriptionCours"];
        $tarifCours = $_POST["inputTarifCours"];
        $matiereCours = $_POST["inputMatiereCours"];
        $niveauEtudeMinCours = $_POST["inputNiveauEtudeMinCours"];
        $niveauEtudeMaxCours = $_POST["inputNiveauEtudeMaxCours"];


        if (!empty($nomCours)) {
            $formulaire_vide = false;
        }
        if (!empty($descriptionCours)) {
            $formulaire_vide = false;
        }
        if (!empty($tarifCours)) {
            $formulaire_vide = false;
        }
        if (!empty($matiereCours)) {
            $formulaire_vide = false;
        }
        if (!empty($niveauEtudeMinCours)) {
            $formulaire_vide = false;
        }
        if (!empty($niveauEtudeMaxCours)) {
            $formulaire_vide = false;
        }

        return $formulaire_vide;
    }

    public function displayInscriptionCours()
    {
        $widget = "<br/><br/><br/><br/><br/><br/><h2 >Inscription Cours</h2><br/>";
        $idCours = $_GET["id"];
        $result = Cours::getCours($idCours);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $profilCtrl = new ProfilControleur();
                $widget = $widget . $profilCtrl->displayCours($row, 3);
            }
        }
        $widget = $widget . $this->requiredDataInscriptionCours();
        echo $widget;
    }

    public function inscriptionCours()
    {
    }

    private function requiredDataInscriptionCours()
    {
        $widget="";

        $widget = $widget . "date_realisation && duree";

        return $widget;
    }


}

?>