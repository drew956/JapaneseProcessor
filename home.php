<?php 
    require_once("functions.php");
?>
<?php
            printHead("Home", array("main_style.css", "home.css"), array("home.js"));
            setUpNavBar("Home");
        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div class='row' style=" ">
                <div class='panel col-lg-3 col-md-3' style="text-align: center;">
                    <div class="">
                        <p>Sample text 1</p>
                    </div>
                </div>
                <div class='panel col-lg-6 col-md-6 text-center' >
                    <div class='message-box floated-div col-lg-12 col-md-12 text-center' >
                        <?php
                        
                        createTaskBox();

                        /*
                        $images = array(
                            "book.jpg",
                            "Japanese Baths",
                            "book.jpg",
                            "Another Story",
                            "book.jpg",
                            "Something else"
                        );
                        printCarousel($images);
                        */
                        ?>
                        
                    </div>
                </div>
                <div class='panel separate col-lg-3 col-md-3' style="text-align: center; clear: both;">
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