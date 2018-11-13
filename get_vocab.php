<?php
    header('content-type: text/html; charset=utf-8');
    
    require_once("LH_Library.php");
    require_once("functions.php");
    
    $conn = connectDB("localhost", "root", "root", "mydb");
    if(!$conn)
        die("noooo");
    mysql_set_charset("utf8");
    //mysqli_set_charset("utf8");


    $Word = new Table("Word");
    $words = $Word->getAllAssoc();
    //$words = $Word->joinSpecific("Word.word, Word.meaning_eng, Word.hiragana, Sentence.sentence, Sentence.id", "Sentence", array("Word.Sentence_id"), array("Sentence.id"));
    /*
        id, type, word, meaning_eng, hiragana, Sentence_id
        data = 
        [
            {
                sentence: "日本人は、お風呂が大好きです。",
                vocab: [
                    "日本人",
                    "にほんじん",
                    "Japanese person",
                    "お風呂",
                    "おふろ",
                    "bathtub", 
                    "大好き",
                    "だいすき",
                    "love",
                    "です",
                    "です",
                    "is"
                ],
                particles: [
                    "は",
                    "が"
                ]
            },
    */
    $data = array();
    $vocab = array();
    foreach($words as $index => $row){
        array_push($vocab, $row["word"]);
        array_push($row["meaning_eng"]);
        array_push($row["hiragana"]);
    }
    $data[0] = array( "vocab" => $vocab );
    echo json_encode($data);
?>