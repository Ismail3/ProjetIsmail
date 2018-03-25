<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a onclick="openNav()"
           class="w3-bar-item w3-button w3-wide">
            <img id="logo_header" src="../../../ressources/images/Logo_Apprendre@Comprendre%20Light_Alpha.png" alt="LOGOA@C"/>
        </a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                <a onclick="openNav2()" href="#home" class="w3-bar-item w3-button"><i
                            class="fa fa-home"></i> Menu</a>
            </form>
        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon -->

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
           onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>

<div id="sideNavLeft" class="sidenav-left">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNavLeft()">&times;</a>
    <a href="tableauDeBord.php"><img class="profil-picture" src="../../../ressources/images/team1.jpg"></a>
    <a href="tableauDeBordProfil.php">Profil</a>
    <a href="tableauDeBordMessagerie.php">Messagerie</a>
    <a href="tableauDeBordEleves.php">Élèves</a>
    <a href="tableauDeBordRessources.php">Ressources</a>
</div>

<div id="sideNavRight" class="sidenav-right">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNavRight()">&times;</a>
    <a href="../../../index.php#home">Deconnexion</a>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none"
     id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
    <a href="#team" onclick="w3_close()"
       class="w3-bar-item w3-button">Tableau de bord</a>
</nav>
