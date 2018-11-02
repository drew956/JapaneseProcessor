<?php 
    require_once("functions.php");
?>
<?php
            printHead("Activity", array("main_style.css", "activity.css"));
            setUpNavBar("Logan");
        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div class='row' >
                <div class='panel separate col-12 text-center' >
                    <div class="content col-12 offset-md-4 offset-lg-4 col-md-4 col-lg-4">
                        <p>Recently studied Kanji and Vocabulary</p>
                    </div>
                    <div class="row cellTop headerCell">
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            Date
                        </div>            
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            Kanji
                        </div>
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            Meaning
                        </div>
                    </div>
                    <div class="row cell" >
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            10/25/18
                        </div>            
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            家
                        </div>
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            House
                        </div>
                    </div>
                    <div class="row cellBottom">
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            10/26/18
                        </div>            
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            私
                        </div>
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            Me, my.
                        </div>
                    </div>
                </div>

            </div>
        </div>
<?php
    printFoot();
?>