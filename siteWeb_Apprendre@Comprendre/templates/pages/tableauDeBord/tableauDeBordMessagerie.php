<?php
require_once(dirname(__FILE__) . '/../../../controlleurs/pages/TableauDeBordControleur.php');
session_start();
?>
<!DOCTYPE html>
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
    <link rel="stylesheet" href="../../../ressources/styles/template-tableau-de-bord.css">

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
require_once(dirname(__FILE__) . '/../../widgets/enseignant/navbar.php');
require_once(dirname(__FILE__) . '/../../widgets/enseignant/header.php');
require_once(dirname(__FILE__) . '/../../widgets/topButton.php');
?>

<div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">
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
</div>


<!-- Footer -->
<?php
require_once(dirname(__FILE__) . '/../../widgets/footer.php');
?>

</body>
</html>
