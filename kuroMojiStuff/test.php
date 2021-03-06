<?php
/* 
    Things we need to work with:
        htmlentities
        
        Reading json from file, and parsing it, and then looking up all the words,
        and then storing those definitions and things into a database.
        Or at least outputting a file which could be fed to a database.
        Probably start with that first.
        
*/

$words = fopen("output.txt", "r");
while($line = fgets($words)){
    print_r(getDataForWord(urlencode($line)));
}    
    
function getDataForWord($word){
    $test   = file_get_contents("https://jisho.org/api/v1/search/words?keyword=$word");
    $test   = json_decode($test);
    $data   = $test->data;
    return getJapaneseWithEnglish($data);
}    

function getJapaneseInfo($data, $limit = 3){
    $result = array();
    for($i = 0; $i < count($data) && $i < $limit; $i++){    
        $japanese = $data[$i]->japanese;
        foreach($japanese as $jap_word){
            $result[] = $jap_word;
        }
    }
    
    return $result;
}

function getEnglishMeaning($data, $limit = 3){
    $result = array();
    for($i = 0; $i < count($data) && $i < $limit; $i++){ 
        $sense = $data[$i]->senses;
        $temp = array();
        for($j = 0; $j < count($sense); $j++){
            $english = $sense[$j]->english_definitions;
            $temp[] = $english;
        }
        $result[] = $temp;
    }
    return $result;
}

function getJapaneseWithEnglish($data, $limit = 3){
    $result = array();

    for($i = 0; $i < count($data) && $i < $limit; $i++){    
        $japanese = $data[$i]->japanese;
        $sense    = $data[$i]->senses;

        $tempjap = array();
        $tempeng = array();
        foreach($japanese as $jap_word){
            $tempjap[] = $jap_word;
        }
        for($j = 0; $j < count($sense); $j++){
            $english   = $sense[$j]->english_definitions;
            $tempeng[] = $english;
        }
        $result[] = array($tempjap, $tempeng);
    }
    
    return $result;
}


?>