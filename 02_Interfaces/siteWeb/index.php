<!DOCTYPE html>
<!-- saved from url=(0062) -->
<html>
<head>
    <title>Apprendre@Comprendre</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link type="text/css" rel="stylesheet" href="ressources/styles/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="ressources/styles/font-awesome.min.css">
    <link rel="stylesheet" href="ressources/styles/bootstrap.min.css">
    <link rel="stylesheet" href="ressources/styles/apprendre@comprendre.css">
    <link rel="stylesheet" href="ressources/styles/template.css">
    <link rel="stylesheet" href="ressources/styles/template-accueil.css">

    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/common.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/map.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/util.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/marker.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/onion.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/controls.js"></script>
    <script type="text/javascript" charset="UTF-8" src="ressources/javascript/stats.js"></script>
    <script src="ressources/javascript/js"></script>
    <script src="ressources/javascript/apprendre@comprendre.js"></script>
</head>
<body cz-shortcut-listen="true">

<?php
require(dirname(__FILE__) . '/templates/widgets/navbar.php');
require(dirname(__FILE__) . '/templates/widgets/header.php');
require(dirname(__FILE__) . '/templates/widgets/topButton.php');
?>


<!-- About Section -->
<div class="w3-container" style="padding:128px 16px" id="about">
    <h3 class="w3-center">À propos de <strong> Aprendre@Comprendre</strong></h3>
    <p class="w3-center w3-large">Quelques caractéristiques clé</p>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-quarter">
            <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
            <p class="w3-large">Numérique</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore. Site Web</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-heart w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Passion</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore. Volontariat</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Union</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore.Solide comme le diamant</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Méthodologies</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore.Méthodologie</p>
        </div>
    </div>
</div>

<!-- Promo Section - "We know design" -->
<div class="w3-container w3-light-grey" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <h3>Des cours particuliers designer pour vous.</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>tempor incididunt ut labore et
                dolore.</p>
            <p><a href="#work" class="w3-button w3-black"><i
                    class="fa fa-th">&nbsp;</i> Qulesques matières</a></p>
        </div>
        <div class="w3-col m6">
            <img class="w3-image w3-round-large" src="ressources/images/laptop-2567809_1920.jpg" alt="Buildings"
                 width="700" height="394">
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="w3-container" style="padding:128px 16px" id="team">
    <h3 class="w3-center">Quelques enseignants</h3>
    <p class="w3-center w3-large">Unie par la volonté de transmettre la connaissance</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="ressources/images/team2.jpg" alt="John" style="width:100%">
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
                <img src="ressources/images/team1.jpg" alt="Jane" style="width:100%">
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
                <img src="ressources/images/team3.jpg" alt="Mike" style="width:100%">
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
                <img src="ressources/images/team4.jpg" alt="Dan" style="width:100%">
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
</div>

<!-- Promo Section "Statistics" -->
<div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">
    <div class="w3-quarter">
        <span class="w3-xxlarge">14+</span>
        <br>Ressources pédagogiques
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge">55+</span>
        <br>Cours réalisés
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge">89+</span>
        <br>Enseignants
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge">150+</span>
        <br>Élèves
    </div>
</div>



<!-- Footer -->
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
    <p>  <p>Réalisé par Ismail SOSSE ALAOUI></p>
    </p>
</footer>

</body>
</html>
