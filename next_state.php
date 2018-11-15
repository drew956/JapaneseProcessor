<?php 
    require_once("LH_Library.php");
    require_once("functions.php");
    
    $data = getStatePhaseBookId();
    connectToDB();
    
    $User = new Table("User");
    $success = $User->update(array("state" => $data['state'] + 1), array("username", $_SESSION['username']));
    
    if($success){
        $_SESSION['state'] = $data['state'] + 1;
        echo "success";
    } else
        echo mysql_error();
?>