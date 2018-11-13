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
    //mysqli_set_charset("utf8");


    $Word = new Table("Word");
    //$words = $Word->getAllAssoc();
    $words = $Word->joinSpecific("Word.Sentence_id, Word.word, Word.meaning_eng, Word.hiragana, Sentence.sentence, Sentence.id", "Sentence", array("Word.Sentence_id"), array("Sentence.id"));


    $objects   = array();
    $sentence  = "";
    $vocab     = array();
    
    foreach($words as $index => $row){
        if($sentence != $row["sentence"]){ //new sentence
            if(count($vocab)){ //if not the first sentence (basically)
                $objects[] = array("sentence" => $sentence, "vocab" => $vocab);
                $sentence = $row["sentence"];
                $vocab = array();
            }else 
                $sentence = $row["sentence"]; //first time through the loop
        }
        array_push($vocab, $row["word"]);
        array_push($vocab, $row["meaning_eng"]);
        array_push($vocab, $row["hiragana"]);
    }

    echo json_encode($objects);
?>