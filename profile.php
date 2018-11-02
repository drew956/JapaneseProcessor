<?php 
    require_once("functions.php");
?>
<?php
            printHead("Profile", array("main_style.css", "profile.css"));
            setUpNavBar("Logan");
        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div class='row' >
                <div class='panel separate col-12 text-center' >

                    <div class="row cellTop headerCell">
                        <div class='col-xs-12 col sm-12 col-lg-12 col-md-12 text-center'>
                            Logan Haser
                        </div>
                    </div>
                    <div class="row cell" >
                        <div class='col-6 col-sm-6 col-lg-6 col-md-6 text-center'>
                            Username
                        </div>            
                        <div class='col-6 col-sm-6 col-lg-6 col-md-6 text-center' >
                            lhaser
                        </div>
                    </div>
                    <div class="row cell">
                        <div class='col-6 col-sm-6 col-lg-6 col-md-6 text-center'>
                            Email
                        </div>            
                        <div class='col-6 col-sm-6 col-lg-6 col-md-6 text-center' >
                            lhaser@asu.edu
                        </div>
                    </div>
                    <div class="row cell">
                        <div class='col-6 col-sm-6 col-lg-6 col-md-6 text-center'>
                            Date Joined
                        </div>            
                        <div class='col-6 col-sm-6 col-lg-6 col-md-6 text-center' >
                            10/20/2018
                        </div>
                    </div>
                    <div class="row cell">
                        <div class='col-6 col-sm-6 col-lg-6 col-md-6 text-center'>
                            Date of Birth
                        </div>            
                        <div class='col-6 col-sm-6 col-lg-6 col-md-6 text-center' >
                            05/26/1995
                        </div>
                    </div>
                    <div class="row cellBottom">
                        <div class='col-6 col-sm-6 col-lg-6 col-md-6 text-center'>
                            <button>Edit information</button>
                        </div>            
                        <div class='col-6 col-sm-6 col-lg-6 col-md-6 text-center' >
                            <button>Delete account</button>
                        </div>
                    </div>
                </div>



                
                <div class='panel col-lg-12 col-md-12 text-center' >
                    <div class="row cellTop headerCell">
                        <div class='col-xs-12 col sm-12 col-lg-12 col-md-12 text-center'>
                            About me
                        </div>
                    </div>
                    <div class="row cellBottom aboutCell" >
                        <div class='col-12 text-center'>
                            <p class="text-highlight">
                                日本語が大好きです〜。このアップリを使ってもっと上手になりたいのです！。
                                では、これからよろしくお願いします！
                            </p>
                        </div>            
                        <div class='col-12 text-center '>
                            <p class="text-highlight">
                                My name is Logan Haser. I am a senior studying Mathematics. 
                                I have been studying Japanese on and off since 2013. 
                                I love the Japanese language, and hope to live in Japan one day.
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <hr />
                </div>
            </div>
        </div>
<?php
    printFoot();
?>