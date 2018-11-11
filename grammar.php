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
            printHead("Grammar", array("main_style.css", "grammar.css"), array("grammar.js"));
            setUpNavBar("Books");

        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div id="quiz" class='row' >
                <div class='panel col-lg-12 col-md-12 text-center'>
                    <div class="row cellTop headerCell">
                        <div  id='count' class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-center'>
                            日本のお風呂の文法のクイズ
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