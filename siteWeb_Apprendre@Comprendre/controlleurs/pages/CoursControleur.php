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

    /*
     * Méthodes
     */
    public function displayNouveauCours()
    {
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
        $email = $_POST['inputEmailInscription'];
        $mot_de_passe = $_POST['inputPasswordInscription'];
        $mot_de_passe_confirm = $_POST['inputPasswordConfirmInscription'];
        $nom = $_POST['inputNomCours'];
        $description = $_POST['inputDescriptionCours'];
        $date_naissance = $_POST['inputDateNaisssanceInscription'];
        $type_compte = $_POST['inputTypeCompteInscription'];

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
                                value="' . $nom . '">';
        $widget = $widget . '<small style="color:red;" id="nomErr" name="nomErr" class="form-text">' . $this->inputNomCoursErr . '</small>';
        $widget = $widget . '
        </div>';
        $widget = $widget . '
                            <div class="form-group">
                                <label for="inputDescriptionCours">Description</label>
                                <textarea type="text" rows="5" class="form-control" 
                                name="inputDescriptionCours"
                                id="inputDescriptionCours" aria-describedby="prénomHelp" placeholder="Entrer votre Prénom"
                                value="' . $description . '">
                                </textarea>';
        $widget = $widget . '<small style="color:red;" id="emailErr" name="prenomErr" class="form-text">' . $this->inputDescriptionCoursErr . '</small>';
        $widget = $widget . '
                            </div>';
        $widget = $widget . '                            <div class="form-group">
                                <label for="inputDateNaisssanceInscription">Date de naissance</label>
                                <input type="date" class="form-control" 
                                name="inputDateNaisssanceInscription"
                                id="inputDateNaisssanceInscription"
                                value="' . $date_naissance . '">';
        $widget = $widget . '<small style="color:red;" id="dateNaissanceErr" name="dateNaissanceErr" class="form-text">' . $this->inputDateNaisssanceInscriptionErr . '</small>';
        $widget = $widget . '
                            </div>';
        $widget = $widget . '                            <div class="form-group">
                                <label for="inputEmailInscription">Email address</label>
                                <input type="email" class="form-control" 
                                name="inputEmailInscription"
                                id="inputEmailInscription" aria-describedby="emailHelp" placeholder="Enter email"
                                value="' . $email . '">';
        $widget = $widget . '<small style="color:red;" id="emailErr" name="emailErr" class="form-text">' . $this->inputEmailInscriptionErr . '</small>';
        $widget = $widget . '
                                <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre email avec quelqu\'un d\'autre.</small>
                            </div>';
        $widget = $widget . '
                            <div class="form-group">
                                <label for="inputPasswordInscription">Password</label>
                                <input type="password" class="form-control" 
                                name="inputPasswordInscription"
                                id="inputPasswordInscription" placeholder="Password"
                                value="' . $mot_de_passe . '">';
        $widget = $widget . '<small style="color:red;" id="passwordErr" name="passwordErr" class="form-text">' . $this->inputPasswordInscriptionErr . '</small>';
        $widget = $widget . '
                            </div>';
       $widget = $widget . '
                            </div>';
        $widget = $widget . '        
                            </fieldset>
                                <button name="btnInscriptionUtilisateur" id="btnInscriptionUtilisateur" value="btnInscriptionUtilisateur" type="submit" class="btn btn-primary" value = "Envoyer">Submit</button>
                        </fieldset>
                    </form>
            </div>
        </div>';

        $widget = $widget . '
                    </div>
                    </div>';


        echo $widget;

    }
}

?>