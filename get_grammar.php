<?php
    header('content-type: text/html; charset=utf-8');
    /* 
        This should ideally check $_SESSION['status'] or whatever to figure out 
        what they can and cannot access, and what book they are reading.
        Also, maybe consider refactoring this so we have functions that get called.
        That way it'll be easier to debug as it gets more bloated.
    */
    require_once("LH_Library.php");
    require_once("functions.php");
    
    $conn = connectDB("localhost", "root", "root", "mydb");
    if(!$conn)
        die("noooo\n");
    mysql_set_charset("utf8");


    $Grammar = new Table("Grammar");
    $grammar = $Grammar->getAllAssoc();

    echo json_encode($grammar);

?>