<?php

class AuthentificationControlleur
{
    public static function displayHeader()
    {
        echo '<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-text-white full-width-div" style="padding:48px">
        <span class="w3-jumbo w3-hide-small"></span><br>
        <div align="center">
            <h1><strong> Aprendre@Comprendre</strong></h1>
            <span class="w3-xxlarge w3-hide-large w3-hide-medium">Start something that matters</span><br>
            <span class="w3-large">Stop wasting valuable time with projects that just isn\'t you.</span>
            <p><a href="#connexion"
                  class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Connexion</a>
                <a href="#inscription"
                   class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Inscription</a>
            </p>
        </div>
    </div>
    <div class="w3-display-bottomleft w3-text-grey w3-large" style="padding:24px 48px">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>

</header>';
    }

    public static function displayTopButton()
    {
        echo '<button onclick="topFunction()" id="topBtn" title="Go to top">Top</button>';
    }


    public static function displayConnexion()
    {
        echo '<!-- Promo Section - "We know design" -->
<div id="connexion" class="w3-container w3-light-grey" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <form action="" method="post">
                <fieldset>
                    <legend>Connexion</legend>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"></div>
                    <a href="../enseignant/tableauDeBord.php" >
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </a>
                </fieldset>
            </form>
        </div>
        <div class="w3-col m6">
            <img class="w3-image w3-round-large" src="../../../ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                 width="700" height="394">
        </div>
    </div>
</div>
';
    }

    public static function uConnexion()
    {
        $errors = array();
        if (!empty($_POST)) {


            if (!empty($_POST['exampleInputEmail1'])) {
                $errors['exampleInputEmail1']="['exampleInputEmail1'] invalide";
            }

        }
        var_dump($errors);
    }

    public static function displayInscription()
    {
        echo '
<!-- Promo Section - "We know design" -->
<div id="inscription" class="w3-container w3-dark-grey" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <form>
                <fieldset>
                    <legend>Inscription</legend>
                    <div class="form-group">
                        <label for="inputNom">Nom</label>
                        <input type="text" class="form-control" id="inputNom" aria-describedby="nomHelp" placeholder="Entrer votre NOM">
                        <small id="nomHelp" class="form-text text-muted">UPPER CASE</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPrénom">Prénom</label>
                        <input type="text" class="form-control" id="inputPrénom" aria-describedby="prénomHelp" placeholder="Entrer votre Prénom">
                        <small id="prénomHelp" class="form-text text-muted">Normal case</small>
                    </div>
                    <div class="form-group">
                        <label for="inputDateNaissance">Date de naissance</label>
                        <input type="date" class="form-control" id="inputDateNaissance">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm password">
                    </div>
                    <fieldset class="form-group">
                        <legend>TypeDeCompte</legend>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                Éleve
                            </label>
                            <br>
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                                Enseignant
                            </label>
                        </div>

                    </fieldset>
                    <a href="../enseignant/tableauDeBord.php" >
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </a>
                </fieldset>
            </form>
        </div>
        <div class="w3-col m6">
            <img class="w3-image w3-round-large" src="../../../ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                 width="700" height="394">
        </div>
    </div>
</div>';
    }

    public static function getContenu()
    {
        self::displayConnexion();
        self::displayInscription();
    }

    public static function getFooter()
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
</footer>';
    }
}