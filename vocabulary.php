<?php 
/* 
    for the purpose of making flash-cards
    https://nnattawat.github.io/flip/
    
    Current problem:
        screen flashes for a second while it hides the back of the card when the page is loaded initially.
        
    Can have it cycle through the words when you click left/right arrows.
*/
    require_once("functions.php");
?>
<?php
            printHead("Vocabulary", array("main_style.css", "vocabulary.css"), array("flip.js", "vocabulary.js"));
            setUpNavBar("Books");

        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div id="cardrow" class='row' style=" ">
                <div class='panel col-lg-12 col-md-12 text-center'>
                    <div class="row cellTop headerCell">
                        <div  id='count' class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-center'>
                            Word 1 of 24
                        </div>
                    </div>
                    <div class="row cell">
                        <div  class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-center'>
                            <div id="card"> 
                                <div class="front"> 
                                    日本人
                                </div> 
                                <div class="back">
                                    Japanese
                                </div> 
                            </div>
                        </div>
                        <div class="col-6 text-left">
                            <span id="left-arrow">< </span>
                        </div>
                        <div class="col-6 text-right">
                            <span id="right-arrow">> </span>
                        </div>
                    </div>
                    <div class="row cellBottom ">
                        <div  class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-right'>
                            <button id='start'>Start quiz</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="quiz" class='row' >
                <div class='panel col-lg-12 col-md-12 text-center'>
                    <div class="row cellTop headerCell">
                        <div  id='count' class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-center'>
                            日本のお風呂のクイズ
                        </div>
                    </div>
                    <div class="row cellBottom">
                        <div class="col-12 text-left edgepad">
                            <form name="quizform" method='get' action='vocabulary.php' id="quizform">
                                <input type="hidden" name="vocab_test_id" value="1" />
                                
                            </form>
                        </div>
                    </div>


                    <div id='startdiv' class="row cellBottom ">
                        <div  class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-right'>
                            <button id='submit'>Submit</button>
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