<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="#home"
           class="w3-bar-item w3-button w3-wide">
            <img id="logo_header" src="ressources/images/Logo_Apprendre@Comprendre%20Light_Alpha.png" alt="LOGOA@C"/>
        </a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">

            <a href="templates/pages/authentification/authentification.php" class="w3-bar-item w3-button"><i
                        class="fa fa-user"></i> Authentification</a>
        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon -->

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium"
           onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none"
     id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
    <a href="#team" onclick="w3_close()"
       class="w3-bar-item w3-button">Authentification</a>
</nav>



