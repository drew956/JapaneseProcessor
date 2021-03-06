<?php 
    require_once("functions.php");
?>
<?php
            printHead("Books", array("main_style.css", "books.css"));
            setUpNavBar("Books");

        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div class='row'>            
                <div class='panelTop col-lg-12 col-md-12  text-center' >
                    <div class='heading col-lg-4 col-md-4 offset-lg-4 offset-md-4 text-center' style="font-family: Palatino Linotype;" >
                        Test text
                    </div>
                    <div class=' col-lg-4 col-md-4 offset-lg-4 offset-md-4 text-center' >
                        <?php
                        $images = array(
                            "book.jpg",
                            "Japanese Baths",
                            "book.jpg",
                            "Another Story",
                            "book.jpg",
                            "Something else"
                        );
                        printCarousel($images);
                        ?>
                    </div>
                </div>
            </div>
            <div class='row' >
                
                <div class='panel col-lg-12 col-md-12' style="text-align: center;">
                    <div class="row cellTop headerCell">
                        <div class='col-xs-12 col sm-12 col-lg-12 col-md-12' style="text-align: center; ">
                            日本のお風呂
                        </div>
                    </div>
                    <div class="row cellBottom" >
                        <div class='col-lg-2 col-md-2 d-flex flex-wrap align-items-center center-block justify-content-center' style="text-align: center;">
                            <a href="book.php?id=1">
                                <img class="img-responsive " src="images/book.jpg"/>
                            </a>
                        </div>
                        <div class='col-lg-5 col-md-5' style="text-align: center;">
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
                        <div class='col-lg-5 col-md-5' style="text-align: center;">
                            <p>
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
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <hr />
                </div>
            </div>
            <div class='row' >
                
                <div class='panel col-lg-12 col-md-12' style="text-align: center;">
                    <div class="row cellTop headerCell">
                        <div class='col-xs-12 col sm-12 col-lg-12 col-md-12' style="text-align: center; ">
                            日本のお風呂
                        </div>
                    </div>
                    <div class="row cellBottom" >
                        <div class='col-lg-2 col-md-2 d-flex flex-wrap align-items-center center-block justify-content-center' style="text-align: center;">
                            <a href="book.php?id=1">
                                <img class="img-responsive " src="images/book.jpg"/>
                            </a>
                        </div>
                        <div class='col-lg-5 col-md-5' style="text-align: center;">
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
                        <div class='col-lg-5 col-md-5' style="text-align: center;">
                            <p>
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
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row' >
                
                <div class='panelBottom col-lg-12 col-md-12' style="text-align: center;">
                    <div class="row cellTop headerCell">
                        <div class='col-xs-12 col sm-12 col-lg-12 col-md-12' style="text-align: center; ">
                            日本のお風呂
                        </div>
                    </div>
                    <div class="row cellBottom" >
                        <div class='col-lg-2 col-md-2 d-flex flex-wrap align-items-center center-block justify-content-center' style="text-align: center;">
                            <a href="book.php?id=1">
                                <img class="img-responsive " src="images/book.jpg"/>
                            </a>
                        </div>
                        <div class='col-lg-5 col-md-5' style="text-align: center;">
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
                        <div class='col-lg-5 col-md-5' style="text-align: center;">
                            <p>
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
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    printFoot();
?>