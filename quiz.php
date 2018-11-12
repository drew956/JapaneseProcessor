<?php 
    require_once("functions.php");
?>
<?php
            printHead("Quiz", array("main_style.css", "quiz.css"), array("quiz.js"));
            setUpNavBar("Quiz");
            $_SESSION['current_text'] = '日本のお風呂'; //temporary for now, until we hook up the DB
        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div id="quiz" class='row' >
                <div class='panel col-lg-12 col-md-12 text-center'>
                    <div class="row cellTop headerCell">
                        <div  id='count' class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-center'>
                            <?php echo $_SESSION['current_text']; ?>
                        </div>
                    </div>
                    <div class="row cellBottom">
                        <div class="col-12 text-left edgepad">
                            <form name="quizform" method='get' action='vocabulary.php' id="quizform">
                                <input type="hidden" name="vocab_test_id" value="1" />
                                
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script>
        

        </script>
<?php
    printFoot();
?>