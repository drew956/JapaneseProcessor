<?php 
    /*
        Should have the php script (this page) check what book they are working on
        and insert that title at the top 
    */
    require_once("functions.php");
?>
<?php
            printHead("Read", array("main_style.css", "book.css"), array("book.js"));
            setUpNavBar("Read");

        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div class='row' style=" ">
                <div class='panel col-lg-12 col-md-12 text-center'>
                    <div class="row cellTop headerCell">
                        <div class='col-xs-12 col sm-12 col-lg-12 col-md-12 text-center'>
                            <h3>日本のお風呂</h3>
                        </div>
                    </div>
                    <div id="textBox" class="row cellBottom edgepad ">
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
        <script>
        </script>
<?php
    printFoot();
?>