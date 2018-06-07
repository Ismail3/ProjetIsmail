<?php
require_once(dirname(__FILE__) . '/ConnectedUserControleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/NiveauEtude.php');
require_once(dirname(__FILE__) . '/../../models/classes/Ressource.php');
require_once(dirname(__FILE__) . '/../../models/classes/Cours.php');

class TableauDeBordControleur extends ConnectedUserControleur
{
    /*
     * Attributs
     */
    private $profilUpdate = false;

    /**
     * @return bool
     */
    public function isProfilUpdate()
    {
        return $this->profilUpdate;
    }

    /**
     * @param bool $profilUpdate
     */
    public function setProfilUpdate($profilUpdate)
    {
        $this->profilUpdate = $profilUpdate;
    }

    public function editProfilSave()
    {
        if (isset($_POST['btnSaveEditProfil'])) {
            $mot_de_passe = $_POST['inputEditProfiPassword'];
            $mot_de_passe_confirm = $_POST['inputEditProfilPasswordConfirm'];
            if (strcmp($mot_de_passe, "") === 0 || strcmp($mot_de_passe_confirm, "") === 0) {
                echo "not updatePassWord";
                $this->updateProfil("");
            } else {
                if ($this->validerMotDePasse($mot_de_passe, $mot_de_passe_confirm)) {
                    echo "updatePassWord";
                    $this->updateProfil($mot_de_passe);
                }
            }
        }
    }

    public function displayUilisateurProfilEdit()
    {
        $widgets = '';
        if (!$_SESSION["profilUpdated"]) {
            if ($this->isEleve()) {
                $widgets = $widgets . $this->displayEleveProfilEdit();
            } else {
                $widgets = $widgets . $this->displayEnseignantProfilEdit();
            }
        } else {
            $_SESSION["profilUpdated"] = false;
            if ($this->isEleve()) {
                $widgets = $widgets . $this->displayEleveProfil();
            } else {
                $widgets = $widgets . $this->displayEnseignantProfil();
            }
        }

        echo $widgets;
        return $widgets;
    }

    public function displayUilisateurProfil()
    {
        $widgets = '';
        if ($this->isEleve()) {
            $widgets = $widgets . $this->displayEleveProfil();
        } else if ($this->isEnseignant()) {
            $widgets = $widgets . $this->displayEnseignantProfil();
        } else if ($this->isAdministrateur()) {
            $widgets = $widgets . $this->displayAdministrateurProfil();
        }

        echo $widgets;
        return $widgets;
    }

    function afficherEleve($id, $nom, $prenom, $email, $date_naissance, $niveau_etude, $image)
    {
        $eleve = '<div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../../ressources/images/' . $image . '" alt="' . $nom . ' ' . $prenom . '" style="width:100%">
                <div class="w3-container">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                <h3>' . $nom . ' ' . $prenom . '</h3>
                            </td>
                            <td style="text-align: right">
                                ' . $id . ' 
                                                    <p class="w3-opacity">' . $niveau_etude . ' </p>

                            </td>
                        </tr>
                    </table>

                    <p style="text-align: center">' . $date_naissance . '</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> ' . $email . ' </button>
                    </p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-book"></i> Cours</button>
                    </p>
                </div>
            </div>
        </div>';

        echo $eleve;
    }

    private function afficherEnseignant($id, $nom, $prenom, $email, $date_naissance, $niveau_etude, $image)
    {
        echo "";
    }

    function displayEnseignants()
    {
        echo '<div class="w3-container" style="padding:128px 16px" id="team">
    <h3 class="w3-center">Vos enseignants</h3>
    <p class="w3-center w3-large">Dans ces rubriques vous pouvez contacter vos enseignants ou visualer les cours ques vous
        avez ou devez réaliser avec eux</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">';

        $idEleve = $this->getUserConnected()->getIdPersonne();
        $listeEnseignants = Eleve::getListeEnseignant($idEleve);

        if ($listeEnseignants->num_rows > 0) {
            // output data of each row
            while ($row = $listeEnseignants->fetch_assoc()) {
                $this->afficherEnseignant($row["id"], $row["nom"], $row["prenom"], $row["email"], $row["date_naissance"], $row["niveau_etude"], $row["image"]);
            }
        } else {
            echo "Vous n'avez actuellement aucun enseignant";
        }
        echo "</div>";
        echo "</div>";

    }

    function displayEleves()
    {
        echo '<div class="w3-container" style="padding:128px 16px" id="team">
    <h3 class="w3-center">Vos élèves</h3>
    <p class="w3-center w3-large">Dans ces rubriques vous pouvez contacter vos élèves ou visualer les cours ques vous
        avez ou devez réaliser avec eux</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">';

        $listeEleves = Eleve::getListeEleves();

        if ($listeEleves->num_rows > 0) {
            // output data of each row
            while ($row = $listeEleves->fetch_assoc()) {
                $this->afficherEleve($row["id"], $row["nom"], $row["prenom"], $row["email"], $row["date_naissance"], $row["niveau_etude"], $row["image"]);
            }
        } else {
            echo "displayEleves : 0 results";
        }
        echo "</div>";
        echo "</div>";

    }

    function displayListeCoursEnseignant()
    {
        $widgets = '
    <h3 class="w3-center">Votre liste de cours</h3>
    <p class="w3-left w3-large">Dans ces rubriques vous pouvez créer vos cours ou visualer les cours ques vous
        avez ou devez réaliser avec vous élèves</p>
    <div class="" style="margin-top:16px">';

        $enseignant = $this->getUserConnected();

        //Liste des cours crées
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Cours </h2>';
        $widgets = $widgets . $this->getListeDesCoursEnLigne($enseignant);
        $widgets = $widgets . '
                    </div>';


        echo $widgets;

    }

    function displayListeSeanceCoursEnseignant()
    {
        $widgets = '
    <h3 class="w3-center">Votre liste de séances de cours</h3>
    <p class="w3-left w3-large">Dans ces rubriques vous pouvez créer vos cours ou visualer les cours ques vous
        avez ou devez réaliser avec vous élèves</p>
    <div class="" style="margin-top:16px">';

        $enseignant = $this->getUserConnected();

//        Liste des cours crées

        //Liste des séance de cours inscrit
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Séances programmés (Demande)</h2>';
        $widgets = $widgets . $this->getListeDesSeancesCoursDemande($enseignant);
        $widgets = $widgets . '
                    </div>';

        //Liste des séance de cours crées
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Séances programmés (Proposition)</h2>';
        $widgets = $widgets . $this->getListeDesSeancesCoursProposition($enseignant);
        $widgets = $widgets . '
                    </div>
        
                    ';
        echo $widgets;

    }

    public function displayPage()
    {

        $eleve = ' <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team2.jpg" alt="John" style="width:100%">
                <div class="w3-container">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                <h3>John Doe</h3>
                            </td>
                            <td style="text-align: right">
                                Licence MIASHS
                            </td>
                        </tr>
                    </table>

                    <p class="w3-opacity">CEO &amp; Founder</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-book"></i> Cours</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team1.jpg" alt="Jane" style="width:100%">
                <div class="w3-container">
                    <h3>Anja Doe</h3>
                    <p class="w3-opacity">Art Director</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team3.jpg" alt="Mike" style="width:100%">
                <div class="w3-container">
                    <h3>Mike Ross</h3>
                    <p class="w3-opacity">Web Designer</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team4.jpg" alt="Dan" style="width:100%">
                <div class="w3-container">
                    <h3>Dan Star</h3>
                    <p class="w3-opacity">Designer</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team2.jpg" alt="John" style="width:100%">
                <div class="w3-container">
                    <h3>John Doe</h3>
                    <p class="w3-opacity">CEO &amp; Founder</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team1.jpg" alt="Jane" style="width:100%">
                <div class="w3-container">
                    <h3>Anja Doe</h3>
                    <p class="w3-opacity">Art Director</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team3.jpg" alt="Mike" style="width:100%">
                <div class="w3-container">
                    <h3>Mike Ross</h3>
                    <p class="w3-opacity">Web Designer</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="../../ressources/images/team4.jpg" alt="Dan" style="width:100%">
                <div class="w3-container">
                    <h3>Dan Star</h3>
                    <p class="w3-opacity">Designer</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque
                        elementum.</p>
                    <p>
                        <button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button>
                    </p>
                </div>
            </div>
        </div>
    </div>';

        echo $eleve;
    }

    private function displayEleveProfil()
    {
        $eleve = $this->getUserConnected();
        $widgets = '<!-- Header with full-height image -->
            <div class="w3-content w3-margin-top" style="max-width:1400px;">
            
                <!-- The Grid -->
                <div class="w3-row-padding">';
        $widgets = $widgets . '

            <!-- Left Column -->
            <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">';
        $widgets = $widgets . $this->getProfilMainInfos($eleve, Eleve::$TABLE_NAME);
        $widgets = $widgets . '
                </div>
                <br>
    
                <!-- End Left Column -->
            </div>';
        $widgets = $widgets . '
        <!-- Right Column -->
        <div class="w3-twothird">

            <div class="w3-container w3-card w3-white">
                <h2 class="w3-text-grey w3-padding-16"><i
                            class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education</h2>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>W3Schools.com</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
                    <p>Web Development! All I need to know in one place</p>
                    <hr>
                </div>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>London Business School</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
                    <p>Master Degree</p>
                    <hr>
                </div>
                <div class="w3-container">
                    <h5 class="w3-opacity"><b>School of Coding</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013</h6>
                    <p>Bachelor Degree</p><br>
                </div>
            </div>

            <!-- End Right Column -->
        </div>
        ';
        $widgets = $widgets . '
        <!-- End Grid -->
    </div>

    <!-- End Page Container -->
</div>';
        return $widgets;
    }

    private function displayEnseignantProfil()
    {
        $enseignant = $this->getUserConnected();
        $widgets = '<!-- Header with full-height image -->
            <div class="w3-content w3-margin-top" style="max-width:1400px;">
            
                <!-- The Grid -->
                <div class="w3-row-padding">';
        $widgets = $widgets . '

            <!-- Left Column -->
            <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">';
        $widgets = $widgets . $this->getProfilMainInfos($enseignant, Enseignant::$TABLE_NAME);
        $widgets = $widgets . $this->getMatiereEnseigner($enseignant);
        $widgets = $widgets . '
                </div>
                <br>
    
                <!-- End Left Column -->
            </div>';
        $widgets = $widgets . '
        
                <!-- Right Column -->
                <div class="w3-twothird">';
        //Liste des cours crées
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Cours </h2>';
        $widgets = $widgets . $this->getListeDesCours($enseignant);
        $widgets = $widgets . '
                    </div>';

        //Liste des séance de cours inscrit
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Séances programmés (Demande)</h2>';
        $widgets = $widgets . $this->getListeDesSeancesCoursDemande($enseignant);
        $widgets = $widgets . '
                    </div>';

        //Liste des séance de cours crées
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Séances programmés (Proposition)</h2>';
        $widgets = $widgets . $this->getListeDesSeancesCoursProposition($enseignant);
        $widgets = $widgets . '
                    </div>
        
                    <!-- End Right Column -->
                </div>';
        $widgets = $widgets . '
        
                <!-- End Grid -->
            </div>
        
            <!-- End Page Container -->
        </div>';
        return $widgets;
    }

    private function displayAdministrateurProfil()
    {
        $administrateur = $this->getUserConnected();
        $widgets = '<!-- Header with full-height image -->
            <div class="w3-content w3-margin-top" style="max-width:1400px;">
            
                <!-- The Grid -->
                <div class="w3-row-padding">';
        $widgets = $widgets . '

            <!-- Left Column -->
            <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">';
        $widgets = $widgets . $this->getProfilMainInfos($administrateur, Administrateur::$TABLE_NAME);
        $widgets = $widgets . '
                </div>
                <br>
    
                <!-- End Left Column -->
            </div>';
        $widgets = $widgets . '
        
                <!-- Right Column -->
                <div class="w3-twothird">';
        //Liste des cours crées
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Cours </h2>';
        $widgets = $widgets . $this->getListeDesCoursAdmin();
        $widgets = $widgets . '
                    </div>';

        //Liste des séance de cours inscrit
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i> Séances programmés (Demande)</h2>';
        $widgets = $widgets . $this->getListeDesSeancesCoursDemandeAdmin();
        $widgets = $widgets . '
                    </div>';

        //Liste des séance de cours crées
        $widgets = $widgets . '
                    <div class="w3-container w3-card w3-white w3-margin-bottom">
                        <h2 class="w3-text-grey w3-padding-16"><i
                                    class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Séances programmés (Proposition)</h2>';
        $widgets = $widgets . $this->getListeDesSeancesCoursPropositionAdmin();
        $widgets = $widgets . '
                    </div>
        
                    <!-- End Right Column -->
                </div>';
        $widgets = $widgets . '
        
                <!-- End Grid -->
            </div>
        
            <!-- End Page Container -->
        </div>';
        return $widgets;
    }

    private function getProfilMainInfos($personne, $type_personne)
    {
        $widget = '
        <!-- Left Column -->

                <div class="w3-display-container">
                    <img src="' . $this->getImagePath() . $this->getUserConnected()->getImage() . '" style="width:100%" alt="Avatar">
                    <div class="w3-display-bottomleft w3-container w3-text-black">
                    </div>
                </div>
                <div class="w3-container">
                    <h2>' . $personne->getPrenom() . ' ' . $personne->getNom() . '</h2>
                    <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getTypePersonne() . '</p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getAdresse() . '</p>
                    <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getEmail() . '</p>
                    <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getTelephone() . '</p>
                    ';
        if (strcmp($type_personne, Eleve::$TABLE_NAME) === 0) {
            $widget = $widget . '<p><i class="fa fa-certificate fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getNiveauEtude() . '</p>
';
        }
        $widget = $widget . '<hr>

                </div>';
        return $widget;
    }

    private function getProfilMainInfosEdit($personne, $type_personne)
    {
        $mot_de_passe = '';
        $mot_de_passe_confirm = '';
        $widget = '
        <!-- Left Column -->
        <form enctype="multipart/form-data" action="" method="post">
                <div class="w3-display-container">
                    <input type="file" class="form-control-file" name="inputImgProfil" id="inputImgProfil" aria-describedby="fileHelp">
                    <img src="' . $this->getImagePath() . $this->getUserConnected()->getImage() . '" style="width:100%" alt="Avatar">

                </div>
                <div class="w3-container">
   <h2><input type="text" class="form-control" placeholder="Prénom" 
                        value="' . $personne->getPrenom() . '" name="inputEditProfilPrenom" id="inputEditProfilPrenom">
                            <input type="text" class="form-control" placeholder="NOM" 
                            value="' . $personne->getNom() . '" name="inputEditProfilNom" id="inputEditProfilNom"></h2>
                
                    <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getTypePersonne() . '</p>
                    <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><input value="' . $personne->getAdresse() . '" type="text" class="form-control" placeholder="Ville, CodePostal" id="inputEditProfilAdresse" name="inputEditProfilAdresse"></p>
                    <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><input value="' . $personne->getEmail() . '" type="email" class="form-control" placeholder="example@mail.com" id="inputEditProfilEmail" name="inputEditProfilEmail"></p>
                    <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i> <input value="' . $personne->getTelephone() . '" type="tel" class="form-control" placeholder="+33 06 12 34 56 78" id="inputEditProfilTel" name="inputEditProfilTel"></p>
                    ';
        if (strcmp($type_personne, Eleve::$TABLE_NAME) === 0) {
            $widget = $widget . $this->getNiveauEtudeSelect($personne->getNiveauEtude());
            $widget = $widget . '<p><i class="fa fa-certificate fa-fw w3-margin-right w3-large w3-text-teal"></i>' . $personne->getNiveauEtude() . '</p>
';
        }
        $widget = $widget . '
        <p><i class="fa fa-lock fa-fw w3-margin-right w3-large w3-text-teal"></i>
                    <input type="password" class="form-control" 
                                name="inputEditProfiPassword"
                                id="inputEditProfiPassword" placeholder="Password"
                                value="' . $mot_de_passe . '">
                    <input type="password" class="form-control" 
                                name="inputEditProfilPasswordConfirm"
                                id="inputEditProfilPasswordConfirm" placeholder="ConfirmPassword"
                                value="' . $mot_de_passe . '"></p>
                    <hr>

                </div>
                <button name="btnSaveEditProfil" id="btnSaveEditProfil" type="submit" class="btn btn-primary" value="btnSaveEditProfil">Submit</button>
         </form>';
        return $widget;
    }

    /**
     * @param $niveauEtude
     */
    protected function getNiveauEtudeSelect($niveauEtude)
    {
        $widget = '<p><i class="fa fa-certificate fa-fw w3-margin-right w3-large w3-text-teal"></i>';
        $widget = $widget . '<select style="height:30px;"class="form-control" id="inputEditProfilNiveauEtude" name="inputEditProfilNiveauEtude">';
        $widget = $widget . $this->getOptitonNiveauEtude($niveauEtude);

        $widget = $widget . '                   </select>';
        $widget = $widget . '</p>
';

        return $widget;
    }

    /**
     * @param $enseignant
     * @return Enseignant
     */
    private function getMatiereEnseigner($enseignant)
    {
        $widget = '<div class="w3-container">';
        $widget = $widget . '<p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Compétences</b>
                    </p>';

        $result = $enseignant->getListeMatièresEnseigner();

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widget = $widget . $this->displayMatiereEnseigner($row);
            }
        } else {
            echo "getMatiereEnseigner : 0 results";
        }


        $widget = $widget . '<br></div>';

        return $widget;
    }

    private function displayMatiereEnseigner($row)
    {
        $matiere = $row['matiere'];
        $niveau_etude = $row['niveau_etude'];
        $id_niveau_etude = 100 * ($row['id_niveau_etude'] / 18);
        $widget = '                    <p><b>' . $matiere . '</b></p>
                    <div class="w3-light-grey w3-round-xlarge w3-small">
                        <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:' . $id_niveau_etude . '%">' . $niveau_etude . '</div>
                    </div>';

        return $widget;
    }

    private function getListeDesCours($enseignant)
    {
        $widget = '';

        $listeCoursEnseignants = $enseignant->getListeDesCours();

        if ($listeCoursEnseignants->num_rows > 0) {
            // output data of each row
            while ($row = $listeCoursEnseignants->fetch_assoc()) {
                $widget = $widget . $this->displayCoursProfil($row);
            }
        } else {
            echo "<br> getListeDesCours : 0 results";
        }

        return $widget;
    }

    private function getListeDesCoursEnLigne($enseignant)
    {
        $widget = '';

        $listeCoursEnseignants = $enseignant->getListeDesCours();

        if ($listeCoursEnseignants->num_rows > 0) {
            // output data of each row
            while ($row = $listeCoursEnseignants->fetch_assoc()) {
                $widget = $widget . $this->displayCoursGestion($row);
            }
        } else {
            echo "<br> getListeDesCours : 0 results";
        }

        return $widget;
    }

    private function getListeDesCoursAdmin()
    {
        $widget = '';

        $result = Cours::getListeDesCours();

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widget = $widget . $this->displayCours($row);
            }
        } else {
            echo "getListeDesCoursAdmin : 0 results";
        }


        return $widget;
    }

//    private function displayCours($id, $nom, $description, $tarif, $date_creation, $id_auteur, $matiere, $ niveau_etude_min,$niveau_etude_max,$ matiere_nom,$niveau_min_nom,$niveau_max_nom){
//
//    }

    /**
     * @param $id
     * @return bool
     */
    private function testBtnPress($id)
    {
        return isset($_POST['btnEnLigneCours' . $id]);
    }

    /**
     *
     */
    public function publierCours()
    {
        $listeCours = $this->getUserConnected()->getListeDesCours();
        if ($listeCours->num_rows > 0) {
            // output data of each row
            while ($row = $listeCours->fetch_assoc()) {
                $id = $row['id'];
                $en_ligne = ($row['en_ligne'] + 1) % 2;
                if ($this->testBtnPress($id)) {
                    Cours::publierCours($id, $en_ligne);
                }
            }
        } else {
            echo "<br> getListeDesCours : 0 results";
        }
    }

    /**
     * @param $row
     * @return string
     */
    private function displayCours($row, $gestion)
    {
        $id = $row['id'];
        $nom = $row['nom'];
        $description = $row['description'];
        $tarif = $row['tarif'];
        $date_creation = $row['date_creation'];
        $id_auteur = $row['id_auteur'];
        $matiere_nom = $row['matiere_nom'];
        $niveau_min_nom = $row['niveau_min_nom'];
        $niveau_max_nom = $row['niveau_max_nom'];
        $en_ligne = $row['en_ligne'];
        $widget = '<div class="w3-container">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                            <h4 class="w3-opacity"><b>';
        if ($gestion == 1) {
            $widget = $widget . '<a href="../cours/modification.php?id=' . $id . '">' . $nom . '</a>';
        } else {
            $widget = $widget . $nom;
        }
        $widget = $widget . '</b></h4>                            </td>
                            <td style="text-align: right">
<span
                                        class="w3-tag w3-teal w3-round">' . $matiere_nom . '</span>';
        if ($gestion == 1) {
            if ($en_ligne == 0) {
                $widget = $widget . '                            <form action="tableauDeBordCours.php" method="post">
                            <button value="btnEnLigneCours' . $id . ' id="btnEnLigneCours' . $id . ' name="btnEnLigneCours' . $id . '" type="submit" class="btn btn-warning">HorsLigne</button>
                            </form>';
            } else {
                $widget = $widget . '
<form action="tableauDeBordCours.php" method="post">
                            <button value="btnEnLigneCours' . $id . ' id="btnEnLigneCours' . $id . ' name="btnEnLigneCours' . $id . '" type="submit" class="btn btn-primary">En ligne</button>
                            </form>';
            }
        }
        $widget = $widget . '


                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                                        <h6 class="w3-text-teal"><i class="fa fa-asterisk fa-fw w3-margin-right"></i>
                            ' . $niveau_min_nom . ' - <span
                                        class="w3-tag w3-teal w3-round">' . $niveau_max_nom . '</span></h6>                           </td>
                            <td style="text-align: right">
<h1
                                        class="w3-tag w3-blue-grey w3-round">' . $tarif . '€</h1>

                            </td>
                        </tr>
                    </table>
                            <p>' . substr($description, 0, 196) . ' ...</p>
                            <p style="text-align: right">' . $date_creation . '</p>
                            <hr>
                        </div>';

        return $widget;
    }

    /**
     * @param $row
     * @return string
     */
    private function displayCoursProfil($row)
    {
        return $this->displayCours($row, 0);
    }

    /**
     * @param $row
     * @return string
     */
    private function displayCoursGestion($row)
    {
        return $this->displayCours($row, 1);
    }

    /**
     * @param $enseignant
     * @return string
     */
    private
    function getListeDesSeancesCoursProposition($enseignant)
    {
        $widgets = '';

        $bd = new BdConnexion();
        $result = $enseignant->getListeSeanceCoursProposition();

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widgets = $widgets . $this->displaySeanceCoursProposition($row);
            }
        } else {
            echo "getListeDesSeancesCoursProposition : 0 results";
        }

        return $widgets;
    }

    private
    function getListeDesSeancesCoursPropositionAdmin()
    {
        $widgets = '';

        $result = CoursSeance::getListeDesSeancesCoursProposition();

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widgets = $widgets . $this->displaySeanceCoursProposition($row);
            }
        } else {
            echo "getListeDesSeancesCoursPropositionAdmin : 0 results";
        }

        return $widgets;
    }

    private
    function displaySeanceCoursProposition($row)
    {
        $id = $row['id'];
        $nom = $row['nom'];
        $description = $row['description'];
        $tarif = $row['tarif'];
        $date_creation = $row['date_creation'];
        $id_auteur = $row['id_auteur'];
        $matiere_nom = $row['matiere_nom'];
        $niveau_min_nom = $row['niveau_min_nom'];
        $niveau_max_nom = $row['niveau_max_nom'];
        $date_inscription = $row['date_inscription'];
        $date_realisation = $row['date_realisation'];
        $participant = $row['participant'];
        $duree = $row['duree'];
        $etat = $row['etat'];
        $nom_participant = $row['nom_participant'];
        $prenom_participant = $row['prenom_participant'];
        $email_participant = $row['email_participant'];
        $date_naissance_participant = $row['date_naissance_participant'];
        $type_personne_participant = $row['type_personne_participant'];
        $widget = '<div class="w3-container">
<table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                            <h4 class="w3-opacity"><b>' . $nom . '</b></h4>                            </td>
                            <td style="text-align: right">
<span
                                        class="w3-tag w3-teal w3-round">' . $matiere_nom . '</span>

                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                                        <h5 class="w3-text-teal"><i class="fa fa-asterisk fa-fw w3-margin-right"></i>
                            ' . $niveau_min_nom . ' - <span
                                        class="w3-tag w3-teal w3-round">' . $niveau_max_nom . '</span></h5>                           </td>
                            <td style="text-align: right">
<h1
                                        class="w3-tag w3-blue-grey w3-round">' . $tarif . '€</h1>

                            </td>
                        </tr>
                    </table>
    <table style="width: 100%">
        <tr>
            <td style="text-align: left">
            <h5>
                Participant : ' . $nom_participant . ' ' . $prenom_participant . '</h5>
            </td>
            <td style="text-align: right">
                <h1 class="w3-tag w3-teal w3-round">' . $duree . 'h</h1>
            </td>
        </tr>
    </table>' .
            '
    <p>' . substr($description, 0, 196) . ' ...</p>
    <p style="text-align: right">' . $date_inscription . '</p>
    <hr>
</div>';

        return $widget;
    }

    private
    function getListeDesSeancesCoursDemande($enseignant)
    {
        $widgets = '';

        $listeSeanceCoursDemande = $enseignant->getListeSeanceCoursDemande();

        if ($listeSeanceCoursDemande->num_rows > 0) {
            // output data of each row
            while ($row = $listeSeanceCoursDemande->fetch_assoc()) {
                $widgets = $widgets . $this->displaySeanceCoursDemande($row);
            }
        } else {
            echo "getListeDesSeancesCoursDemande : 0 results";
        }

        return $widgets;
    }

    private
    function getListeDesSeancesCoursDemandeAdmin()
    {
        $widgets = '';

        $result = CoursSeance::getListeDesSeancesCoursDemande();


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $widgets = $widgets . $this->displaySeanceCoursDemande($row);
            }
        } else {
            echo "getListeDesSeancesCoursDemandeAdmin : 0 results";
        }


        return $widgets;
    }

    private
    function displaySeanceCoursDemande($row)
    {
        $id = $row['id'];
        $nom = $row['nom'];
        $description = $row['description'];
        $tarif = $row['tarif'];
        $date_creation = $row['date_creation'];
        $id_auteur = $row['id_auteur'];
        $matiere_nom = $row['matiere_nom'];
        $niveau_min_nom = $row['niveau_min_nom'];
        $niveau_max_nom = $row['niveau_max_nom'];
        $date_inscription = $row['date_inscription'];
        $date_realisation = $row['date_realisation'];
        $participant = $row['participant'];
        $duree = $row['duree'];
        $etat = $row['etat'];
        $nom_auteur = $row['nom_auteur'];
        $prenom_auteur = $row['prenom_auteur'];
        $email_auteur = $row['email_auteur'];
        $date_naissance_auteur = $row['date_naissance_auteur'];
        $type_personne_auteur = $row['type_personne_auteur'];
        $widget = '<div class="w3-container">
<table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                            <h4 class="w3-opacity"><b>' . $nom . '</b></h4>                            </td>
                            <td style="text-align: right">
<span
                                        class="w3-tag w3-teal w3-round">' . $matiere_nom . '</span>

                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                                                        <h5 class="w3-text-teal"><i class="fa fa-asterisk fa-fw w3-margin-right"></i>
                            ' . $niveau_min_nom . ' - <span
                                        class="w3-tag w3-teal w3-round">' . $niveau_max_nom . '</span></h5>                           </td>
                            <td style="text-align: right">
<h1
                                        class="w3-tag w3-blue-grey w3-round">' . $tarif . '€</h1>

                            </td>
                        </tr>
                    </table>
    <table style="width: 100%">
        <tr>
            <td style="text-align: left">
            <h5>
                Organisateur : ' . $nom_auteur . ' ' . $prenom_auteur . ' </h5>
            </td>
            <td style="text-align: right">
                <h1 class="w3-tag w3-teal w3-round">' . $duree . 'h</h1>
            </td>
        </tr>
    </table>' .
            '
    <p>' . substr($description, 0, 196) . ' ...</p>
    <p style="text-align: right">' . $date_inscription . '</p>
    <hr>
</div>';

        return $widget;
    }

    private
    function displayEleveProfilEdit()
    {
        $eleve = $this->getUserConnected();
        $widgets = '<!-- Header with full-height image -->
            <div class="w3-content w3-margin-top" style="max-width:1400px;">
            
                <!-- The Grid -->
                <div class="w3-row-padding">';
        $widgets = $widgets . '

            <!-- Left Column -->
            <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">';
        $widgets = $widgets . $this->getProfilMainInfosEdit($eleve, Eleve::$TABLE_NAME);
        $widgets = $widgets . '
                </div>
                <br>
    
                <!-- End Left Column -->
            </div>';
        $widgets = $widgets . '
        
                <!-- Right Column -->
                <div class="w3-twothird">';
        $widgets = $widgets . '
                    </div>
        
                    <!-- End Right Column -->
                </div>';
        $widgets = $widgets . '
        
                <!-- End Grid -->
            </div>
        
            <!-- End Page Container -->
        </div>';
        return $widgets;
    }

    private
    function displayEnseignantProfilEdit()
    {
        $enseignant = $this->getUserConnected();
        $widgets = '<!-- Header with full-height image -->
            <div class="w3-content w3-margin-top" style="max-width:1400px;">
            
                <!-- The Grid -->
                <div class="w3-row-padding">';
        $widgets = $widgets . '

            <!-- Left Column -->
            <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">';
        $widgets = $widgets . $this->getProfilMainInfosEdit($enseignant, Enseignant::$TABLE_NAME);
        $widgets = $widgets . $this->getMatiereEnseigner($enseignant);
        $widgets = $widgets . '
                </div>
                <br>
    
                <!-- End Left Column -->
            </div>';
        $widgets = $widgets . '
        
                <!-- Right Column -->
                <div class="w3-twothird">';
        $widgets = $widgets . '
                    </div>
        
                    <!-- End Right Column -->
                </div>';
        $widgets = $widgets . '
        
                <!-- End Grid -->
            </div>
        
            <!-- End Page Container -->
        </div>';
        return $widgets;
    }

    private
    function updateProfil($mot_de_passe)
    {
        $personne = $this->getUserConnected();


        $id = $personne->getIdPersonne();
        $nom = $_POST['inputEditProfilNom'];
        $prenom = $_POST['inputEditProfilPrenom'];
        $adresse = $_POST['inputEditProfilAdresse'];
        $email = $_POST['inputEditProfilEmail'];
        $tel = $_POST['inputEditProfilTel'];
        $image = $this->getUploadImage();

        if (strcmp($mot_de_passe, "") === 0) {
            $mot_de_passe = $personne->getMotDePasse();
        }

        echo "mot_de_passe" . $mot_de_passe;

        $date_naissance = $personne->getDateNaissance();;


        $personne->update($nom, $prenom, $adresse, $email, $tel, $mot_de_passe, $image);


        if ($personne->update($nom, $prenom, $adresse, $email, $tel, $mot_de_passe, $image) === TRUE) {

            $personne->setNom($nom);
            $personne->setPrenom($prenom);
            $personne->setEmail($email);
            $personne->setAdresse($adresse);
            $personne->setTelephone($tel);
            $personne->setDateNaissance($date_naissance);
            $personne->setMotDePasse($mot_de_passe);
            if (strcmp($image, "") != 0) {
                $personne->setImage($image);
            }
            $_SESSION["utilisateur"] = $personne;

            echo '<div class="container">
            <br>
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Session Personne updated successfully </h1>
              </div>
              <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Info!</strong>
                ' . $_SESSION["utilisateur"] . '
              </div>
            </div>';
        } else {
//            echo "<div class=\"alert alert-danger alert-dismissible\">
//  <strong>Error!</strong> Error: " . $sql . "<br>" . $bdd->error . "
//</div>
//";
            echo "<br>";
            echo "_SESSION:utilisateur = " . $_SESSION["utilisateur"];
            echo "<br>";
        }

        if (strcmp($personne->getTypePersonne(), Eleve::$TABLE_NAME) === 0) {
            $niveau_etude = $_POST['inputEditProfilNiveauEtude'];

            if ($personne->updateEleve($niveau_etude) === TRUE) {

                $this->setProfilUpdate(true);
                $niveau_etude_nom = NiveauEtude::getNiveauEtudeNom($niveau_etude);
                $personne->setNiveauEtude($niveau_etude_nom);
                $_SESSION["utilisateur"] = $personne;
            }

        } else {
            $this->setProfilUpdate(true);
        }

        $_SESSION["profilUpdated"] = true;
    }

    private
    function getUploadImage()
    {
        $files = $_FILES;
        $target_dir = $this->getImagePath();
        $target_file = $target_dir . basename($_FILES["inputImgProfil"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $newFileName = "fileUpload";
        // Check if image file is a actual image or fake image
        if (isset($_POST["btnSaveEditProfil"])) {
            $check = getimagesize($_FILES["inputImgProfil"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . basename($_FILES["inputImgProfil"]["name"]) . " " . $check["mime"] . ".  <br>";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            return basename($_FILES["inputImgProfil"]["name"]);
        }
        // Check file size
        if ($_FILES["inputImgProfil"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            return "";
            // if everything is ok, try to upload file
        } else {
            echo "<br> Dest : " . $target_file . "<br>";
            echo "<br> Filaname : " . $_FILES["inputImgProfil"]["tmp_name"] . "<br>";
            echo "<br> Try Stored in: " . $target_dir . $newFileName . "<br>";
            if (move_uploaded_file($_FILES["inputImgProfil"]["tmp_name"], $target_file)) {
                echo "Stored in: " . $target_file . $newFileName . "<br>";
                echo "The file " . basename($_FILES["inputImgProfil"]["name"]) . " has been uploaded.";
                return basename($_FILES["inputImgProfil"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
                return "";
            }
        }
    }

    public
    function displayMessages()
    {
        echo '<div class="row">

    <div class="w3-third">

        <div class="w3-white w3-text-grey w3-card-4">
            <div class="w3-display-container">
                <img src="../../../ressources/images/team1.jpg" style="width:100%" alt="Avatar">
                <div class="w3-display-bottomleft w3-container w3-text-black">
                    <h2>Jane DOE</h2>
                </div>
            </div>
            <div class="w3-container">
                <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Designer</p>
                <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>London, UK</p>
                <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>ex@mail.com</p>
                <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>1224435534</p>
                <hr>

                <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b>
                </p>
                <p>Adobe Photoshop</p>
                <div class="w3-light-grey w3-round-xlarge w3-small">
                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
                </div>
                <p>Photography</p>
                <div class="w3-light-grey w3-round-xlarge w3-small">
                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:80%">
                        <div class="w3-center w3-text-white">80%</div>
                    </div>
                </div>
                <p>Illustrator</p>
                <div class="w3-light-grey w3-round-xlarge w3-small">
                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:75%">75%</div>
                </div>
                <p>Media</p>
                <div class="w3-light-grey w3-round-xlarge w3-small">
                    <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">50%</div>
                </div>
                <br>

                <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Languages</b>
                </p>
                <p>English</p>
                <div class="w3-light-grey w3-round-xlarge">
                    <div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>
                </div>
                <p>Spanish</p>
                <div class="w3-light-grey w3-round-xlarge">
                    <div class="w3-round-xlarge w3-teal" style="height:24px;width:55%"></div>
                </div>
                <p>German</p>
                <div class="w3-light-grey w3-round-xlarge">
                    <div class="w3-round-xlarge w3-teal" style="height:24px;width:25%"></div>
                </div>
                <br>
            </div>
        </div>
        <br>

        <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">

        <div class="w3-container w3-card w3-white w3-margin-bottom scrollArea">
            <h2 class="w3-text-grey w3-padding-16"><i
                        class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Work Experience</h2>

            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-10 talkbubble-left">
                    <img class="profil-picture-min" src="../../../ressources/images/team1.jpg"/>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 - 18:00</h6>
                    <p>Lorem ipsum dolor sit amet. Praesentium magnam consectetur vel in deserunt aspernatur est
                        reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus iure,
                        iste.</p>
                    <hr>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-10 talkbubble-right">
                    <img class="profil-picture-min" src="../../../ressources/images/team1.jpg"/>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 - 18:00</h6>
                    <p>Consectetur adipisicing elit. Praesentium magnam consectetur vel in deserunt aspernatur est
                        reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus iure,
                        iste.</p>
                    <hr>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-10 talkbubble-left">
                    <h5 class="w3-opacity"><b>Graphic Designer / designsomething.com</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 - 18:00</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p><br>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-10 talkbubble-right">
                    <img class="profil-picture-min" src="../../../ressources/images/team1.jpg"/>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 - 18:00</h6>
                    <p>Consectetur adipisicing elit. Praesentium magnam consectetur vel in deserunt aspernatur est
                        reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus iure,
                        iste.</p>
                    <hr>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col-10 talkbubble-left">
                    <h5 class="w3-opacity"><b>Graphic Designer / designsomething.com</b></h5>
                    <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 - 18:00</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p><br>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-9">
                <textarea class="form-control full-width-div" rows="3">

                </textarea>
            </div>
            <div class="col-2">
                <button>Envoyer</button>
            </div>
        </div>

    </div>


    <!-- End Right Column -->
</div>
</div>';
    }

    public
    function displayMessagerie()
    {
        echo '<div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">
    <div class="w3-quarter">
        <span class="w3-xxlarge">125</span>
        <br>Messages
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge">5</span>
        <br>Messages non lus
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge">25</span>
        <br>Conversations
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge">4</span>
        <br>Favoris
    </div>
</div>

<h2>Messageries</h2>
<p>Vous trouverez ici la liste de conversation avec vos élèves:</p>
<table class="table table-hover">
    <thead>
    <tr>
        <th>-</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Matière</th>
        <th>Statut</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><img class="profil-picture-min" src="../../../ressources/images/team2.jpg"/></td>
        <td>Jone</td>
        <td>Doe</td>
        <td>Matière</td>
        <td>
            <a href="tableauDeBordMessage.php">
                <img class="table-icon" alt="mailOpen" src="../../../ressources/images/mail00.png"/>
            </a>
        </td>
    </tr>
    <tr>
        <td><img class="profil-picture-min" src="../../../ressources/images/team1.jpg"/></td>
        <td>Anja</td>
        <td>Doe</td>
        <td>Matière</td>
        <td>
            <a href="tableauDeBordMessage.php"/>
            <img class="table-icon" alt="mailOpen" src="../../../ressources/images/mail00.png"/>
            </a>
        </td>
    </tr>
    <tr>
        <td><img class="profil-picture-min" src="../../../ressources/images/team3.jpg"/></td>
        <td>Mike</td>
        <td>Ross</td>
        <td>Matière</td>
        <td>
            <a href="tableauDeBordMessage.php"/>
            <img class="table-icon" alt="mailOpen" src="../../../ressources/images/mail00.png"/>
            </a>
        </td>
    </tr>
    <tr>
        <td><img class="profil-picture-min" src="../../../ressources/images/team4.jpg"/></td>
        <td>Dan</td>
        <td>Star</td>
        <td>Matière</td>
        <td>
            <a href="tableauDeBordMessage.php"/>
            <img class="table-icon" alt="mailOpen" src="../../../ressources/images/mail00.png"/>
            </a>
        </td>
    </tr>
    <tr>
        <td><img class="profil-picture-min" src="../../../ressources/images/team2.jpg"/></td>
        <td>Jone</td>
        <td>Doe</td>
        <td>Matière</td>
        <td>
            <a href="tableauDeBordMessage.php"/>
            <img class="table-icon" alt="mailOpen" src="../../../ressources/images/mail00.png"/>
            </a>
        </td>
    </tr>
    <tr>
        <td><img class="profil-picture-min" src="../../../ressources/images/team1.jpg"/></td>
        <td>Anja</td>
        <td>Doe</td>
        <td>Matière</td>
        <td>
            <a href="tableauDeBordMessage.php"/>
            <img class="table-icon" alt="mailOpen" src="../../../ressources/images/mail00.png"/>
            </a>
        </td>
    </tr>
    <tr>
        <td><img class="profil-picture-min" src="../../../ressources/images/team3.jpg"/></td>
        <td>Mike</td>
        <td>Ross</td>
        <td>Matière</td>
        <td>
            <a href="tableauDeBordMessage.php"/>
            <img class="table-icon" alt="mailNew" src="../../../ressources/images/mail01.png"/>
            </a>
        </td>
    </tr>
    <tr>
        <td><img class="profil-picture-min" src="../../../ressources/images/team4.jpg"/></td>
        <td>Dan</td>
        <td>Star</td>
        <td>Matière</td>
        <td>
            <a href="tableauDeBordMessage.php"/>
            <img class="table-icon" alt="mailOpen" src="../../../ressources/images/mail00.png"/>
            </a>
        </td>
    </tr>
    </tbody>
</table>

<div>
    <ul class="pagination pagination-lg">
        <li class="page-item disabled">
            <a class="page-link" href="#">&laquo;</a>
        </li>
        <li class="page-item active">
            <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">4</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">5</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">&raquo;</a>
        </li>
    </ul>
</div>';
    }

    public
    function displayRessources()
    {
        echo '<div class="w3-container" style="padding:128px 16px" id="team">
    <h3 class="w3-center">Ressources pédagogiques</h3>
    <p class="w3-center w3-large">Dans cette rubrique vous pouvez trouvez un ensemble de ressource documentaire afin de vous aider à travailler dans les meilleurs conditions</p>
        ';
        $this->listRessources();
        echo '</div>';
    }

    public
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

    public
    function listRessources()
    {
        $id = 1;
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
        for ($x = 0; $x < count($listRessources); $x++) {
            if ($col == 0) {
                //Nouvelle ligne
                echo '<div class="w3-row-padding w3-grayscale" style="margin-top:64px">';
                $col++;
            }
            echo $this->displayRessource($listRessources[$x]->getNom(), $listRessources[$x]->getTypeRessource(), $listRessources[$x]->getImage());
            if ($col == 4 || $x == count($listRessources) - 1) {
                //Nouvelle ligne
                echo '</div>';
                $col = 0;
            }
        }
    }

    public function displayAddCoursEnseignant()
    {
        $widget = '<a class="w3-button w3-light-grey w3-block" href="../cours/creation.php">
                      <i class="fa fa-suitcase"></i> Créer un cours
                    </a>';
        echo $widget;
    }

    public function displayManageCoursEnseignant()
    {
        echo '<div class="w3-container" style="padding:128px 16px">';
        $this->displayAddCoursEnseignant();
        echo '<br/>';
        $this->displayListeCoursEnseignant();
        echo '<br/>';
        $this->displayListeSeanceCoursEnseignant();
        echo '</div>';
    }
}

?>