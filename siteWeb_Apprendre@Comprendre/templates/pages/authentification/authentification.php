<!DOCTYPE html>
<!-- saved from url=(0062) -->
<html>
<head>
    <title>Apprendre@Comprendre</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link type="text/css" rel="stylesheet" href="../../../ressources/styles/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../ressources/styles/font-awesome.min.css">
    <link rel="stylesheet" href="../../../ressources/styles/bootstrap.min.css">
    <link rel="stylesheet" href="../../../ressources/styles/apprendre@comprendre.css">
    <link rel="stylesheet" href="../../../ressources/styles/template.css">
    <link rel="stylesheet" href="../../../ressources/styles/template-authentification.css">

    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/common.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/map.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/util.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/marker.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/onion.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/controls.js"></script>
    <script type="text/javascript" charset="UTF-8" src="../../../ressources/javascript/stats.js"></script>
    <script src="../../../ressources/javascript/js"></script>
    <script src="../../../ressources/javascript/apprendre@comprendre.js"></script>
</head>
<body cz-shortcut-listen="true">


<?php
require(dirname(__FILE__) . '/../../widgets/authentification/navbar.php');
require(dirname(__FILE__) . '/../../widgets/authentification/header.php');
require(dirname(__FILE__) . '/../../widgets/topButton.php');
?>

<!-- Promo Section - "We know design" -->
<div id="connexion" class="w3-container w3-light-grey" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <form>
                <fieldset>
                    <legend>Connexion</legend>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
</div>

<!-- Footer -->
<?php
require(dirname(__FILE__) . '/../../widgets/footer.php');
?>


</body>
</html>
