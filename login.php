<?php 
    require_once("LH_Library.php");
    require_once("functions.php");

    $msg = "";
    //handle login attempt
    if($_POST['password'] && $_POST['username']){
        connectToDB();
        $User  = new Table("User");
        //should sanitize the post data
        $users = $User->getAllAssoc(array("username", $_POST['username'], "password", $_POST['password']));
        
        if(count($users) && count($users) == 1){
            //then we know they have the correct password
            $_SESSION['username'] = $users[0]['username'];
            $_SESSION['state']    = $users[0]['state'];
                
            //redirect to home page
            header('Location: home.php');
            //die(); //prevent unintended site access
        } else { //one of the two was wrong
            $msg = "<span class='error-msg'>Either your password or email were incorrect</span>";
        }
    }else if($_POST['password'] || $_POST['username']){ //if only one is set
        //handle error issues
        $msg = "<span class='error-msg'>Please enter both your username and your password</span>";
    }
        
    
    printHead("Login", array("main_style.css", "login.css") );
    setUpNavBar("Login");
?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div id="quiz" class="row">
                <div class="panel col-lg-12 col-md-12 text-center">
                    <div class="row cellTop headerCell">
                        <div id="count" class="col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-center">
                            Login                    
                        </div>
                    </div>
                    <div class="row cellBottom">
                        <div class="col-12 text-left edgepad">
                            <?php echo $msg; ?>    
                            <form name="loginform" method="post" action="login.php" id="loginform">
                                
                                <div class="form-group">
                                    <label>Please enter your username<br>
                                       <input type="text" class="form-control" name="username" placeholder="username" value="<?php echo $_POST['username']; ?>" />
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Please enter your password<br>
                                       <input type="text" class="form-control" name="password" placeholder="password" value="<?php echo $_POST['password']; ?>" />
                                    </label>
                                </div>
                                <button type="submit" name="submit" form='loginform' class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<?php 
    printFoot();
?>