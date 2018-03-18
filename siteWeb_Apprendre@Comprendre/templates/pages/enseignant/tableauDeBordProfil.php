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

<div class="w3-content w3-margin-top" style="max-width:1400px;">

    <!-- The Grid -->
    <div class="w3-row-padding">

        <!-- Left Column -->
        <div class="w3-third">

            <div class="w3-white w3-text-grey w3-card-4">
                <div class="w3-display-container">
                    <input type="file" class="form-control-file" id="inputImgProfil" aria-describedby="fileHelp">
                    <img src="../../../ressources/images/team1.jpg" style="width:100%" alt="Avatar">
                    <div class="w3-display-bottomleft w3-container w3-text-black">
                        <h2><input type="text" class="form-control" placeholder="Prénom" id="inputPrenom">
                            <input type="text" class="form-control" placeholder="NOM" id="inputNom"></h2>
                    </div>
                </div>
                <br/>
                <div class="w3-container">
                    <div class="row">
                        <div class="col-1">
                            <i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>
                        </div>
                        <div class="col-10">
                            <select class="form-control" id="inputEmploi">
                                <option>Emploi1</option>
                                <option>Emploi2</option>
                                <option>Emploi3</option>
                                <option>Emploi4</option>
                                <option>Emploi5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>
                        </div>
                        <div class="col-10">
                            <input type="text" class="form-control" placeholder="Ville, CodePostal" id="inputAdresse">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>
                        </div>
                        <div class="col-10">
                            <input type="email" class="form-control" placeholder="example@mail.com" id="inputEmail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1">
                            <i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>
                        </div>
                        <div class="col-10">
                            <input type="tel" class="form-control" placeholder="+33 06 12 34 56 78" id="inputTel">
                        </div>
                    </div>
                    <hr>

                    <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b>
                    </p>
                    <div class="row">
                        <div class="col-10">
                            <input type="text" class="form-control" placeholder="Compétence" id="inputCompetence">
                            <div class="w3-light-grey w3-round-xlarge w3-small">
                                <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary"><h3>+</h3></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <p>Adobe Photoshop</p>
                            <div class="w3-light-grey w3-round-xlarge w3-small">
                                <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <p>Photography</p>
                            <div class="w3-light-grey w3-round-xlarge w3-small">
                                <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:80%">
                                    <div class="w3-center w3-text-white">80%</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <p>Illustrator</p>
                            <div class="w3-light-grey w3-round-xlarge w3-small">
                                <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:75%">75%</div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <p>Media</p>
                            <div class="w3-light-grey w3-round-xlarge w3-small">
                                <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:50%">50%</div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>


                    <br>

                    <p class="w3-large w3-text-theme"><b><i class="fa fa-globe fa-fw w3-margin-right w3-text-teal"></i>Languages</b>
                    </p>

                    <div class="row">
                        <div class="col-10">
                            <input type="text" class="form-control" placeholder="Langue" id="inputLangue">
                            <div class="w3-light-grey w3-round-xlarge w3-small">
                                <div class="w3-container w3-center w3-round-xlarge w3-teal" style="width:90%">90%</div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary"><h3>+</h3></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <p>English</p>
                            <div class="w3-light-grey w3-round-xlarge">
                                <div class="w3-round-xlarge w3-teal" style="height:24px;width:100%"></div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <p>Spanish</p>
                            <div class="w3-light-grey w3-round-xlarge">
                                <div class="w3-round-xlarge w3-teal" style="height:24px;width:55%"></div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <p>
                                German
                            </p>
                            <div class="w3-light-grey w3-round-xlarge">
                                <div class="w3-round-xlarge w3-teal" style="height:24px;width:25%"></div>
                            </div>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <br>

            <!-- End Left Column -->
        </div>

        <!-- Right Column -->
        <div class="w3-twothird">

            <div class="w3-container w3-card w3-white w3-margin-bottom">
                <h2 class="w3-text-grey w3-padding-16"><i
                            class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Work Experience
                </h2>
                <div class="w3-container">
                    <div class="row">
                        <div class="col-10">
                            <input type="text" class="form-control" placeholder="Langue" id="inputLangue">
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" class="form-control" placeholder="Langue" id="inputLangue">
                                </div>
                                <div class="col-6">
                                    <input type="date" class="form-control" placeholder="Langue" id="inputLangue">
                                </div>
                            </div>
                            <textarea class="form-control" id="exampleTextarea" rows="3">
                            </textarea>
                            <br/>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary"><h3>+</h3></button>
                        </div>
                    </div>

                    <hr>
                </div>
                <div class="w3-container">
                    <div class="row">
                        <div class="col-10">
                            <h5 class="w3-opacity"><b>Front End Developer / w3schools.com</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jan 2015 -
                                <span
                                        class="w3-tag w3-teal w3-round">Current</span></h6>
                            <p>Lorem ipsum dolor sit amet. Praesentium magnam consectetur vel in deserunt aspernatur est
                                reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus
                                iure,
                                iste.</p>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>

                    <hr>
                </div>
                <div class="w3-container">
                    <div class="row">
                        <div class="col-10">
                            <h5 class="w3-opacity"><b>Web Developer / something.com</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Mar 2012 - Dec
                                2014
                            </h6>
                            <p>Consectetur adipisicing elit. Praesentium magnam consectetur vel in deserunt aspernatur
                                est
                                reprehenderit sunt hic. Nulla tempora soluta ea et odio, unde doloremque repellendus
                                iure,
                                iste.</p>
                            <hr>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                </div>
                <div class="w3-container">
                    <div class="row">
                        <div class="col-10">
                            <h5 class="w3-opacity"><b>Graphic Designer / designsomething.com</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Jun 2010 - Mar
                                2012
                            </h6>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p><br>
                            <hr>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w3-container w3-card w3-white">
                <h2 class="w3-text-grey w3-padding-16"><i
                            class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Education</h2>
                <div class="w3-container">
                    <div class="row">
                        <div class="col-10">
                            <input type="text" class="form-control" placeholder="Ecole" id="inputLangue">
                            <div class="row">
                                <div class="col-6">
                                    <input type="date" class="form-control" id="inputLangue">
                                </div>
                                <div class="col-6">
                                    <input type="date" class="form-control" id="inputLangue">
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Formation" id="inputLangue">
                            <br/>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary"><h3>+</h3></button>
                        </div>
                    </div>

                    <hr>
                </div>
                <div class="w3-container">
                    <div class="row">
                        <div class="col-10">
                            <h5 class="w3-opacity"><b>W3Schools.com</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
                            <p>Web Development! All I need to know in one place</p>
                            <hr>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                </div>
                <div class="w3-container">
                    <div class="row">
                        <div class="col-10">
                            <h5 class="w3-opacity"><b>London Business School</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015
                            </h6>
                            <p>Master Degree</p>
                            <hr>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                </div>
                <div class="w3-container">
                    <div class="row">
                        <div class="col-10">
                            <h5 class="w3-opacity"><b>School of Coding</b></h5>
                            <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013
                            </h6>
                            <p>Bachelor Degree</p><br>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-danger"><h3>-</h3></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Right Column -->
        </div>

        <!-- End Grid -->
    </div>

    <!-- End Page Container -->
</div>

<!-- Footer -->
<?php
require_once(dirname(__FILE__) . '/../../widgets/footer.php');
?>

</body>
</html>
