<?php 
    /*
        This is from here on out the "overview" page for a given text. 
        It should load the data from the server and should 
        There isn't really 
    */
    require_once("functions.php");
?>
<?php
            printHead("Overview", array("main_style.css", "overview.css"), array("overlibmws.js", "overlibdefaults.js", "overview.js"));
            setUpNavBar("Study");

        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div class='row' style=" ">
                <div class='panel col-lg-12 col-md-12 text-center'>
                    <div class="row cellTop headerCell">
                        <div class='col-xs-12 col sm-12 col-lg-12 col-md-12 text-center'>
                            日本のお風呂
                        </div>
                    </div>
                    <div class="row cell ">
                        <div class='col-4 col-xs-4 col-sm-4 col-lg-4 col-md-4 text-center'>
                            <button id="vocab"><p>Vocabulary</p></button>
                        </div>
                        <div class='col-4 col-xs-4 col-sm-4 col-lg-4 col-md-4 text-center'>
                            <button id="book"><p>Kanji</p></button>
                        </div>
                        <div class='col-4 col-xs-4 col-sm-4 col-lg-4 col-md-4 text-center'>
                            <button id="grammar"><p>Grammar</p></button>
                        </div>
                    </div>
                    <div id="textBox" class="row cellBottom ">
                        <div  class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-center'>
                            <p>
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
                            </p>                        
                        </div>
                        <div class="col-6 text-left">
                            <span onclick="alert('hello');">< </span>
                        </div>
                        <div class="col-6 text-right">
                            >
                        </div>
                    </div>
                </div>
            </div>

        </div>
<?php
    printFoot();
?>