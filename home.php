<?php 
    require_once("functions.php");
?>
<?php
            printHead("Home", array("main_style.css"));
            $elements = array(
            getNavLink("Home", "home.php", "active"),
            getNavLink("Books"),
            getNavDropDown("Logan", array(
                    "Activities" => "#",
                    "Profile" => "profile.php"
            )));
            navBar($elements);
        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div class="row text-center" style="background-color: rgba(0,0,191,0.5); color: green;">
                <div class="col-md-12 col-lg-12">
                    <h1>Test</h1>
                </div>
            </div>
            <div class='row' style=" ">
                <div class='panel col-lg-3 col-md-3' style="text-align: center;">
                    <div class="">
                        <p>Sample text 1</p>
                    </div>
                </div>
                <div class='panel col-lg-6 col-md-6' style="text-align: center;">
                    <div class='content col-lg-12 col-md-12 cell' style="text-align: center;">
                        <p>Sample text 2</p>
                        <p>User Activity</p>
                        <p>random word from one of the books</p>
                    </div>
                </div>
                <div class='panel separate col-lg-3 col-md-3' style="text-align: center;">
                    <div class="content">
                        <p>Recently studied Kanji and Vocabulary</p>
                        <p>Clickable to allow you to go and look up specific words??</p>
                    </div>
                    <div class="row cellTop headerCell">
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4' style="text-align: center;">
                            Date
                        </div>            
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4' style="text-align: center;">
                            Kanji
                        </div>
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4' style="text-align: center; ">
                            Meaning
                        </div>
                    </div>
                    <div class="row cell" >
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4' style="text-align: center;">
                            10/25/18
                        </div>            
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4' style="text-align: center;">
                            家
                        </div>
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4' style="text-align: center;">
                            House
                        </div>
                    </div>
                    <div class="row cellBottom">
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4' style="text-align: center;">
                            10/26/18
                        </div>            
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4' style="text-align: center;">
                            私
                        </div>
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4' style="text-align: center;">
                            Me, my.
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    printFoot();
?>