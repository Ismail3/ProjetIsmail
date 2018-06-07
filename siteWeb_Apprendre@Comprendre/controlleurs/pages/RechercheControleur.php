<?php
require_once(dirname(__FILE__) . '/ConnectedUserControleur.php');
require_once(dirname(__FILE__) . '/ProfilControleur.php');
require_once(dirname(__FILE__) . '/../../models/classes/NiveauEtude.php');
require_once(dirname(__FILE__) . '/../../models/classes/Ressource.php');
require_once(dirname(__FILE__) . '/../../models/classes/AbstractModel.php');
require_once(dirname(__FILE__) . '/../../models/classes/Administrateur.php');
require_once(dirname(__FILE__) . '/../../models/classes/Cours.php');
require_once(dirname(__FILE__) . '/../../models/classes/CoursSeance.php');
require_once(dirname(__FILE__) . '/../../models/classes/Eleve.php');
require_once(dirname(__FILE__) . '/../../models/classes/Enseignant.php');
require_once(dirname(__FILE__) . '/../../models/classes/Filiaire.php');
require_once(dirname(__FILE__) . '/../../models/classes/Matiere.php');
require_once(dirname(__FILE__) . '/../../models/classes/Message.php');
require_once(dirname(__FILE__) . '/../../models/classes/NiveauEtude.php');
require_once(dirname(__FILE__) . '/../../models/classes/Personne.php');
require_once(dirname(__FILE__) . '/../../models/classes/Ressource.php');


class RechercheControleur extends ConnectedUserControleur
{
    public function displayRechercheResult()
    {
        $widgets = "<div class=\"container\" styles=\"height: 100%; margiu\">";
        $valeurRecherchee = $_GET["recherche"];
        $widgets = $widgets . "<h1> Recherche : " . $valeurRecherchee . "</h1>";
        $widgets = $widgets . "<ul>
                                <li>
                                <a href='#idRechercheEleves'>
                                  Élèves  
                                </a>                                
                                </li>
                                <li>
                                <a href='#idRechercheEnseignants'>
                                  Enseignants  
                                </a>
                                </li>  
                                <li>
                                <a href='#idRechercheCours'>
                                  Cours  
                                </a>  
                                <li>
                                <a href='#idRechercheSeanceCours'>
                                  SeanceCours  
                                </a>
                                </li>                                                                                                                                                                                             
                                </ul>";
        $widgets = $widgets . $this->rechercheEleve($valeurRecherchee);
        $widgets = $widgets . $this->rechercheEnseignant($valeurRecherchee);
        $widgets = $widgets . $this->rechercheCours($valeurRecherchee);
        $widgets = $widgets . $this->rechercheSeanceCours($valeurRecherchee);
        $widgets = $widgets . "</div>
<br/><br/><br/><br/><br/><br/><br/>";
        echo $widgets;
    }

    /**
     * @param $valeurRecherchee
     * @return string
     */
    private function rechercheEleve($valeurRecherchee)
    {
        $result = Eleve::recherche($valeurRecherchee);

        return $this->afficherEleves($result,$valeurRecherchee);
    }

    private function afficherEleves($result,$valeurRecherchee)
    {
        $widget = "<h2 id=\"idRechercheEleves\">Élèves</h2>";
        $nLumigne = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($nLumigne == 0) {
                    $widget = $widget . "<div class=\"row\">";
                }

                $widget = $widget . $this->afficherEleve($row["id"],
                        $row["nom"],
                        $row["prenom"],
                        $row["email"],
                        $row["date_naissance"],
                        $row["niveau_etude"],
                        $row["image"]);
                $nLumigne++;
                if ($nLumigne == 4) {
                    $nLumigne = 0;
                    $widget = $widget . "</div>";
                }
            }
            if ($nLumigne > 0) {
                $widget = $widget . "</div>";
            }
        }
        else {
            $widget = $widget . "Aucun élève ne correspond à la recherche \"".$valeurRecherchee."\"";
        }
        return $widget;

    }

    private function rechercheEnseignant($valeurRecherchee)
    {
        $result = Enseignant::recherche($valeurRecherchee);

        return $this->afficherEnseignants($result,$valeurRecherchee);
    }

    private function afficherEnseignants($result,$valeurRecherchee)
    {
        $widget = "<h2 id=\"idRechercheEnseignants\">Enseignants</h2>";
        $numLigne = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($numLigne == 0) {
                    $widget = $widget . "<div class=\"row\">";
                }

                $widget = $widget . $this->afficherEleve($row["id"],
                        $row["nom"],
                        $row["prenom"],
                        $row["email"],
                        $row["date_naissance"],
                        $row["niveau_etude"],
                        $row["image"]);
                $numLigne++;
                if ($numLigne == 4) {
                    $numLigne = 0;
                    $widget = $widget . "</div>";
                }
            }
            if ($numLigne > 0) {
                $widget = $widget . "</div>";
            }
        }
        else {
            $widget = $widget . "Aucun enseignant ne correspond à la recherche \"".$valeurRecherchee."\"";
        }
        return $widget;

    }

    private function rechercheCours($valeurRecherchee)
    {
        $result = Cours::recherche($valeurRecherchee);

        return $this->afficherListeCours($result,$valeurRecherchee);
    }

    private function afficherListeCours($result,$valeurRecherchee)
    {
        $widget = "<h2 id=\"idRechercheCours\">Cours</h2>";
        $numLigne = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($numLigne == 0) {
                    $widget = $widget . "<div class=\"row\">";
                }
                $profilCtrl = new ProfilControleur();
                $widget = $widget . $profilCtrl->displayCours($row,2);
                $numLigne++;
                if ($numLigne == 4) {
                    $numLigne = 0;
                    $widget = $widget . "</div>";
                }
            }
            if ($numLigne > 0) {
                $widget = $widget . "</div>";
            }
        }
        else {
            $widget = $widget . "Aucun cours ne correspond à la recherche \"".$valeurRecherchee."\"";
        }
        return $widget;
    }

    private function afficheCours($id, $nom, $description, $tarif, $date_creation, $id_auteur, $matiere_nom, $niveau_min_nom, $niveau_max_nom)
    {
        $widget = "";

        $widget = '<div class="w3-container">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                            <h4 class="w3-opacity"><b>';

            $widget = $widget . $nom;
        $widget = $widget . '</b></h4>                            </td>
                            <td style="text-align: right">
<span
                                        class="w3-tag w3-teal w3-round">' . $matiere_nom . '</span>';
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

    private function rechercheSeanceCours($valeurRecherchee)
    {
        $result = CoursSeance::recherche($valeurRecherchee);

        return $this->afficherListeCoursSeance($result,$valeurRecherchee);
    }

    private function afficherListeCoursSeance($result,$valeurRecherchee)
    {
        $widget = "<h2 id=\"idRechercheCoursSeance\">CoursSeance</h2>";
        $numLigne = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($numLigne == 0) {
                    $widget = $widget . "<div class=\"row\">";
                }
                $widget = $widget . $this->afficheCoursSeances($row["id"],
                        $row["nom"],
                        $row["description"],
                        $row["tarif"],
                        $row["date_creation"],
                        $row["id_auteur"],
                        $row["matiere_nom"],
                        $row["niveau_etude_min_nom"],
                        $row["niveau_etude_max_nom"]);
                $numLigne++;
                if ($numLigne == 4) {
                    $numLigne = 0;
                    $widget = $widget . "</div>";
                }
            }
            if ($numLigne > 0) {
                $widget = $widget . "</div>";
            }
        }
        else {
            $widget = $widget . "Aucune séance de cours ne correspond à la recherche \"".$valeurRecherchee."\"";
        }
        return $widget;
    }

    private function afficheCoursSeances($id, $nom, $description, $tarif, $date_creation, $id_auteur, $matiere_nom, $niveau_min_nom, $niveau_max_nom)
    {
        $widget = "";

        $widget = '<div class="w3-container">
                    <table style="width: 100%">
                        <tr>
                            <td style="text-align: left">
                            <h4 class="w3-opacity"><b>';

        $widget = $widget . $nom;
        $widget = $widget . '</b></h4>                            </td>
                            <td style="text-align: right">
<span
                                        class="w3-tag w3-teal w3-round">' . $matiere_nom . '</span>';
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
}

?>