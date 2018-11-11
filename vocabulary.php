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
            <div class='row' style=" ">
                <div class='panel col-lg-12 col-md-12 text-center'>
                    <div id="textBox" class="row cellTop headerCell">
                        <div  id='count' class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-center'>
                            Word 1 of 24
                        </div>
                    </div>
                    <div id="textBox" class="row cellBottom ">
                        
                        <div  class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-center'>
                            <div id="card"> 
                                <div class="front"> 
                                    日本人は、お風呂が大好きです。
                                    毎日、お風呂に入る人が、多いです。
                                    日本は、夏は暑くて、冬は寒い国です。
                                    だから、いつでもお風呂に入りたくなるのです。
                                    一日の終わりに、お風呂にゆっくり入ると、とても気持ちがよくて、元気が出ます。
                                    「日本のお風呂」は、シャワーだけではありません。
                                    体を洗ってから、湯船のお湯の中に入ります。
                                    それが、「日本おお風呂」です。
                                    小さな子どもは、お父さんやお母さんと一緒に、お風呂に入ります。
                                    あまり暑くないお湯に入って長い時間、本を本だり、テレビを見たりする人もいます。
                                    お風呂の時間は、とても大切な時間です。
                                </div> 
                                <div class="back">
                                    The Japanese love to take a bath.
                                    Every day, there are many people who take a bath.
                                    Japan is hot in summer and cold in winter.
                                    Therefore, I want to take a bath anytime.
                                    At the end of the day, slowly entering the bath, I feel very comfortable and energetic.
                                    "Shower in Japan" is not the only shower.
                                    After washing the body, enter the bath water.
                                    That's "Japan bath".
                                    A small child enters a bath with her father and mother.
                                    Some people have entered hot water that is not very hot, read a book for a long time, and watch television.
                                    The time of the bath is very important time.
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
                </div>
            </div>

        </div>
        <script>
        

        </script>
<?php
    printFoot();
?>