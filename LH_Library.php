<?php

/* 
    Last_modified: 03/31/2017
    Reason: Created HTMLElement class and Printable interface, although I probably already created such an interface
            Wanted to separate out the header of my website into an object
            And to provide the ability to modify it or add to it
            On a page per page basis.
            Have not finished this yet, as I have not created the HtmlHeader object yet
            nor have I explored HeaderGroup classes yet.
            Which could make use of JavascriptGroup or other classes, which would make it easy to set up a page
    Copyright Logan Haser 2017

    Last_modified: 03/28/2017
    Copyright Logan Haser 2017
    PhP Library of functions, for use in my websites
    Reason: Adding in CRUD class, fixing htmlPrintTableAssoc2 so it uses the keys array instead of the elements array
    //because otherwise it messes up the order of the elements

    Last_modified: 12/19/2016
    Copyright Logan Haser 2014.
    PhP Library of functions, for use in my websites.
    
    Last_modified: 12/17/2016
    Reason: Added a htmlTable method for arrays with keys instead of numbers
*/


function tabs($num, $standard = "    "){
   $str = "";
   for($i = 0; $i < $num; $i++){
      $str .= $standard;
   }
   return $str;
}

/* 
    5-1-2014
    Possible names...
    tokenSeparator #separates a string into substrings based on the tokens you specify
    mightySplit
    magicSplit()
    

*/    

/* Even if you make a regular expression version of this, keep this version too.
    This version could be useful for logic analogous to regular expressions but without actual strings
    Thus this logic would work for anything, whereas regular expressions will not.
    (Well, arguably you could build in an infrastructure and interface to make
    regular expressions work in any situation where such logic could be needed,
    but it would be more of a hassle.)
    (associate each thing you wish to manipulate with a character or specific string of characters,
    and then you can use reg expressions ot manipulate and unearth them/gather data on them.
    /modify them at will.)
    
     */
function separateByToken($text, $punct = array(".", "!", "?") ){ #punct is initialized by default but can be specified
    $split  = array(); #will hold the split $text
    $swap   = array(); #used to swap things around
          
    $split  = explode($punct[0], $text); #single dimensional array
    #add all the punctuation back in
    #will use a more complicated version down below 
    for($i = 0; $i < count($split) - 1; $i++){
        $split[$i] .= $punct[0]; 
    }
    
    #starts at 1 since already exploded once
    for($i = 1; $i < count($punct); $i++){
        #make $split 2D
        for($j = 0; $j < count($split); $j++){
            $split[$j] = explode($punct[$i], $split[$j]); 
            if(count($split[$j]) > 1){#if you actually found the punctuation and split on it
                for($k = 0; $k < count($split[$j]) - 1; $k++){ #same thing as 10 lines ago, but slightly different
                    $split[$j][$k] .= $punct[$i];#add back in the punctuation from before
                }
            }
        }
    
        $l = 0;
        #thereotically linearizes the array, swap prevents split from becoming overwritten 
        for($k = 0; $k < count($split); $k++){
            for($j = 0; $j < count($split[$k]); $j++){
                $swap[$l] = $split[$k][$j]; 
                $l++;     
            }
        }
        
        #make $split a singe dimensional array again for the next loop through
        for($p = 0; $p < count($swap); $p++ ){
            $split[$p] = $swap[$p]; 
        }
    }
    
    return $split;        
}





/*
    This function needs to be debugged, as it does not currently work I believe.

 */
function htmlSpecialPrint($text, $html, $delim = ";"){
    $html = explode($delim, $html); #for marking up multiple subsections of one sentence i.e. "The :fat: and :brown: cat ran home" with "i:b", the i for the first the b 4 the 2cnd
    #(hmmm should be able to do ibu:i: to mean ibu:i? I could check and skip any "" $html things...)
    
    $text  = explode($delim, $text); #single dimensional array
            
    #looping through the $text array
    for($i = 0; $i < count($text); $i++){
        if( $i % 2 != 0 ){ #if not even or zero
            htmlPrint1($text[$i], $html[($i - 1)/2]);   #this is html text 
        }else {
            echo $text[$i]; #this is normal text
        }
    } 
    #removing for now to keep the integrity of the paragraphs yo
    #echo "\n"; #source code formatting yo               
}       

function removeToken($text, $token){
    $text = explode($token, $text);
    $text = implode("", $text);
    return $text;
}
/* 
   
   4-29-2013
   Best way to improve this would probably be to have it take one array and one delimiter (for the html of course(maybe two actaully, one to signify 
   non-partnered tags? nahh, you can just use a getHtmlPrint and add the few special tags to it.. or maybe I will figure out a way to do this ;> ))
   You could just make an extra parameter for the partner tags, also using the same delimiter to separate it and the index into the other tags you want 
   it placed (0 being at the front, 1 being one in, etc)
   
   anyway, to take an array and a delimiter.
   The idea is that the length of the array will be even, since it will go as follows array($text, $html, $text, $html ....);
   Thus you don't have to screw around with extra delimiters.. 
   
   but then you have to screw with commas and "" quotes, which sucks.
   Need a way to manually screw with this data...
   Well, actaully, woudn't be that bad.
   You could write code to go through and take your text and put it like that in an array
   and with variables you don't really have to worry too much about strings and quotes.
   
   
   
*/       
#perhaps make a version that accepts two arrays into it, as that one would be far easier to work with I'd think       
        







#htmlTextarea($name, $defaultValue);


function htmlTextarea($name, $cols, $rows, $default = "", $label="", $maxLength = "" ){
    
    if(!$maxLength)
    print <<<HERE
    $label<textarea id="$name" name="$name" rows="$rows" cols="$cols">$default</textarea> 
HERE;

    if($maxLength)
    print <<<HERE
    $label<textarea id="$name" name="$name" rows="$rows" cols="$cols" maxlength="$maxLength">$default</textarea> 
HERE;
}



/*

  HTMLPRINT3 is based upon the idea of formatting text in a textArea
  
  so you'd have soething like so:
  
  "I am logan haser:i;u;b;: you are:: not:u;i;: me:: but nice try there son:i"
  there are 2 delimiters in here ';' and ':'
  
  ':' is being used to separate chunks. Chunks of text AND chunks of html
  the html chunks themselves are, in turn, separated by the delimiter ';'
  
  Each chunk of text is followed by a ':' to show the end of the chunk, and likewise with the html
  The html that directly follows a chunk is applied to it, with :: nothing being applied if nothing is written
  (still need that second ':' though even if no markup is done)

  However, when specifying the delimiter you specify the html delimiter FIRST then the overall Delimiter SECOND
  i.e. ";:" in this case.
  
  The $string matches the format I have outlined above, where $delim can be specified by the user

*/


function htmlPrint3($string, $delim = ";:"){
    if( count(str_split($delim, 1)) < 2)
        die("You entered in less than 2 delimiters, we need at least 2. (i.e. ;:)");
    $delim = str_split($delim, 1);#an array now
    $pieceArray = explode($delim[1], $string);
    $text = "";#to hold our text
    $html = "";#to hold our html

    #check to make sure the following for loop won't be all weird or f'd up    
    if(count($pieceArray) % 2 != 0)
        die("You didn't pair every chunk of text with a chunk of html or empty string.. (::)");

    for($i = 0; $i < count($pieceArray); $i+=2 ){
        if($i == count($pieceArray) - 2){
            $text .= $pieceArray[$i];
            $html .= $pieceArray[$i + 1];
        }else{
            $text .= $pieceArray[$i]     . $delim[1]; #i.e. ";:" -> :
            $html .= $pieceArray[$i + 1] . $delim[1]; 
        }
    }
    
    htmlPrint2($text, $html, $delim[0] . $delim[1]);
    
}






/* 
  htmlPrint isn't perfect yet, as it only does tags with one letter in their name (i.e. p, i, b, u, etc)
  Needs regular expressions, as well as looking for special html tags that don't need a twin
*/
#htmlPrint( $textToPrint, $stringOfTokenSeparatedhtmlTags, $classId
#htmlPrint("Wow, what an interesting person", "pibu", "" ) #last one is always classID I think, or we can u
                                               #se regular expressions to find out which one contains a keytoken
function htmlPrint( $text, $html , $delim = ";", $class = NULL ) {
  if(isset($class)){
    
  }else{
    $arrayHtml = (isset($html) && strlen($html) >= 1 ? explode( $delim, $html) : $html); #temporary for now, until I master regex's
    
    $leng = count($arrayHtml); 
    
    /*
       This loop is taking all the html tags (that have no < > yet) and is putting their matching tags at the opposite side of the array
       i.e. p i b </b> </i> </p>
     */
    for( $i = 0; $i < $leng; $i++ ){
      $arrayHtml[2*$leng - $i - 1] = ($arrayHtml[$i] != "") ? '</' . $arrayHtml[$i] . ">" : ""; #making the matching tags for the original elements
      $arrayHtml[$i]               = ($arrayHtml[$i] != "") ? '<' . $arrayHtml[$i] . '>'  : "";
    }
    $leng2 = count($arrayHtml);
    for( $i = 0; $i < $leng2; $i++ ){
      if($i == $leng2/2){
        $text2 .= $text . $arrayHtml[$i];
      }else{ 
        $text2 .= $arrayHtml[$i]; 
      }
    }
    echo $text2 . "\n"; #not sure if the /n is needed or not..
  }
  
}


function htmlPrint1( $text, $html ) {
    $arrayHtml = (isset($html) && strlen($html) >= 1 ? str_split($html, 1) : $html); #temporary for now, until I master regex's

    $leng = count($arrayHtml); 

    /*
    This loop is taking all the html tags (that have no < > yet) and is putting their matching tags at the opposite side of the array
    i.e. p i b </b> </i> </p>
    */
    for( $i = 0; $i < $leng; $i++ ){
        $arrayHtml[2*$leng - $i - 1] = ($arrayHtml[$i] != "") ? '</' . $arrayHtml[$i] . ">" : ""; #making the matching tags for the original elements
        $arrayHtml[$i]               = ($arrayHtml[$i] != "") ? '<' . $arrayHtml[$i] . '>'  : "";
    }
    $leng2 = count($arrayHtml);
    for( $i = 0; $i < $leng2; $i++ ){
        if($i == $leng2/2){
            $text2 .= $text . $arrayHtml[$i];
        }else{ 
            $text2 .= $arrayHtml[$i]; 
        }
    }
    echo $text2; #not sure if the /n is needed or not..  
}

       
       
       
       
       
       
       
/* 
   
   4-29-2013
   Best way to improve this would probably be to have it take one array and one delimiter (for the html of course(maybe two actaully, one to signify 
   non-partnered tags? nahh, you can just use a getHtmlPrint and add the few special tags to it.. or maybe I will figure out a way to do this ;> ))
   You could just make an extra parameter for the partner tags, also using the same delimiter to separate it and the index into the other tags you want 
   it placed (0 being at the front, 1 being one in, etc)
   
   anyway, to take an array and a delimiter.
   The idea is that the length of the array will be even, since it will go as follows array($text, $html, $text, $html ....);
   Thus you don't have to screw around with extra delimiters.. 
   
   but then you have to screw with commas and "" quotes, which sucks.
   Need a way to manually screw with this data...
   Well, actaully, woudn't be that bad.
   You could write code to go through and take your text and put it like that in an array
   and with variables you don't really have to worry too much about strings and quotes.
   
   
   
*/       
#perhaps make a version that accepts two arrays into it, as that one would be far easier to work with I'd think       
        
function htmlPrint2($text, $html, $delimiters = ";:"){ #by default has two delimiters, since won't effect anything if not used
    $tokens      = str_split($delimiters, 1);
    $manyTokens  = (count($tokens) > 1);

    #the idea is that exploding on ":" will have no effect if it is not there (like if a use types in ";" instead of ";:"
    $textArray = ( $manyTokens ) ? explode($tokens[1], $text) : explode(   ":"    , $text); #tokens[1] is the token separating chunks and html chunks too
    $htmlArray = ( $manyTokens ) ? explode($tokens[1], $html) : explode($tokens[0], $html); #split on the separator of the html chunks or on the separator of the html units (depending on #tokens)
    
    if( $manyTokens ){
        for($i = 0; $i < count($htmlArray); $i++){
            $htmlArray[$i] = explode($tokens[0], $htmlArray[$i]); //multidimensional arrays yo, feed on this shizzit XD
        }
    }
    
    for( $i = 0; $i < count($htmlArray); $i++ ){ #hopefully returns the count of the x values
        $rowLen = count($htmlArray[$i]); #$oRowLen[$i];
        for( $j = 0; $j < $rowLen ; $j++ ){
            $htmlArray[$i][2*$rowLen - $j - 1] = ($htmlArray[$i][$j] != "") ? '</' . $htmlArray[$i][$j] . ">" : ""; #making the matching tags for the original elements
            $htmlArray[$i][$j] = ($htmlArray[$i][$j] != "") ? "<" . $htmlArray[$i][$j] . ">" : ""; #can do since already accessed this element
        }
    }
    
    #When debugging this script:
    #ookay so everything is fine up until here OH SHIT
    # I JUST NEVER PRINTED ANYTHING XD
    
    #the following code assumes the lengths are equal so this check makes sure
    #look for the commented out portions to see why
    if(count($htmlArray) != count($textArray)) 
        die("You did't put the same number of html chunks as you did text chunks! Whyy lol");
    
    $text2 = array(); //resolving scope issues a lil bit farther down
    for($i = 0; $i < count($htmlArray); $i++){
        $leng2 = count($htmlArray[$i]); #row length, basically all the html tags and their counterparts, should be an even number
                                        #but in the future, going to add more complexity probably idk    
        //for( $k = 0; $k < count($textArray); $k++ ){ #k should be the length of i technically...
            for($j = 0; $j < $leng2; $j++){

                if($j == $leng2/2){
                    $text2[$i] .= $textArray[$i] . $htmlArray[$i][$j];
                }else{ 
                    $text2[$i] .= $htmlArray[$i][$j]; 
                }
            }
        //}    
    }
    
    
    #print all the values LOL, now everything works fine! XD I'ma genius! lmao
    for($i = 0; $i < count($text2); $i++){
    	echo $text2[$i] . "\n";
    }
    
}
        

function htmlForm($formHandle = ""){
  echo ($formHandle) ? "<form action=\"$formHandle\" method=\"post\">\n" : "<form method=\"post\">\n";
}
        




#line break function / carriage return... lol
#br(# of brs you want)
function br($num = 1){
    while( $num > 0){
      echo "<br>";
      $num--;
    }
    echo "\n"; #for html source formatting nicely
}

#line break GETTER function / carriage return... lol
#br(# of brs you want)
function gbr($num = 1){
    $tex = "";
    while( $num > 0){
      $tex .= "<br>";
      $num--;
    }
    return $tex . "\n"; #for html source formatting nicely
}


        
        
#htmlForm("radio", "gallon_price", "");
function htmlField($type, $name, $value, $text = "" ){
  echo ($type != "submit" ? $text : "");
  echo "<input id=\"$name\" type=\"$type\" name=\"$name\" value=\"$value\" ";
  if( $type == "radio" && isset($_POST["$name"]) && $_POST["$name"] == $value ){
    echo 'checked="checked"';
  }
  echo ($type != "submit" ? " /> \n" : " onclick=\"$text\" />\n");
}

function htmlCheckbox($name, $value, $checked ){  
  echo "<label>$value<input id=\"$name\" type='checkbox' name=\"$name\" ";
  echo  $checked ? "checked='checked' " : " ";
  echo "/></label>\n";
}


function htmlFieldGet($type, $name, $value, $text = "" ){
  $result = "";
  $result .= "<input type=\"$type\" name=\"$name\" value=\"$value\" ";
  if( $type == "radio" && isset($_POST["$name"]) && $_POST["$name"] == $value ){
    $result .= 'checked="checked"';
  }
  return ($type != "submit" ? $result . " /> $text \n" : $result . " />\n");
}

        
#meh, returns the value from a POST submission of data
#$name is the name of the form/field, and $default is waht is returned if no data was submitted
function olin($name, $default = ""){
   if( isset($_POST[$name]) && !empty($_POST[$name]) ){
     return $_POST[$name];
   }
   return $default;
}

     


#makes an html table to scale. Currently only implements elements no 
#customization yet. 
#parameters ( class, @elements, headers, siders, colspan, rowspan, cellpadding, cellspacing, border )
#$siders, basically headers on the side <th> </th>
function htmlTable( $id, $elements, $headers, $siders, $border = "1") { #prototype v0.1

  print !empty( $id ) ? "<table class=\"$_[0]\" border=\"$border\" >\n" : "<table border=\"$border\" >\n"; 
  print ($siders != "" && count($siders) && count($headers)) ?  "<tr><td></td>" : (count($headers)) ? "<tr>" : "";
  for ( $i = 0; $i < count($headers); $i++  ) { 
    print "<th>" . $headers[ $i ] . "</th>";
    print ($i == count($headers) - 1) ? "\n" : "";
  }
  print count($headers) ? "</tr>" : "";
  for ( $i = 1; $i <= count($elements) ; $i++ ) { 

    if ( $i == 1 || $i % count($headers) == 1 ) { 
	  print "<tr>";
	  
	  if ( $siders != "" ) { 
	    print "<th>" . $siders[ floor($i / count($headers)) ] . "</th>";
      }
    }
    if ( !empty( $elements[ $i - 1 ] ) ){
      print "<td>" . $elements[ $i - 1 ] . "</td>"; #assuming elements got the array passed in correctly
    }
    if ( $i % count($headers) == 0 ) { 
      print "</tr>\n";
    }
  }
  print "</table>\n";
}

/* 
    Designed for quick and dirty table printing based on a multidimensional array
    the rows do not need to be the same size, though that would be good I think.
*/
function htmlTable2($elements, $class = "", $indent = "") { #prototype v0.1
 
  print $indent . "<table class=\"$class\">\n";
  print $indent . tabs(1) . "<tbody>\n";   
  for ($i = 0; $i < count($elements) ; $i++ ) { 
    print $indent . tabs(2) . "<tr>";
    for($j = 0; $j < count($elements[$i]); $j++ ){
        if ( !empty( $elements[$i][$j] ) ){
          print "<td>" . $elements[$i][$j] . "</td>"; #assuming elements got the array passed in correctly
        }
    }
    print "</tr>\n";
  }
  print $indent . tabs(1) .  "</tbody>\n";   
  print $indent . "</table>\n";
}



function htmlTable3($elements, $class="", $indent="") { #prototype v0.1
  $result = array();
  $result[] = $indent . "<table class=". $class . " >\n";
  $result[] = $indent . tabs(1) . "<tbody>\n";   
  for ($i = 0; $i < count($elements) ; $i++ ) { 
    $b = "";
    $b .= $indent . tabs(2) . "<tr>";
    for($j = 0; $j < count($elements[$i]); $j++ ){
        if ( !empty( $elements[$i][$j] ) ){
          $b .= "<td>" . $elements[$i][$j] . "</td>"; #assuming elements got the array passed in correctly
        }
    }
    $b .= "</tr>\n";
    $result[] = $b;
  }
  $result[] = $indent . tabs(1) . "</tbody>\n";   
  $result[] = $indent . "</table>\n";
  return $result;
}

//associative array version
function mysqlResourceTable($resource, $class="", $indent="") { #prototype v0.1
   /* $result = array();
    $result[] = $indent . "<table class=". $class . " >\n";
    $result[] = $indent . tabs(1) . "<tbody>\n";   

    while($row = mysql_fetch_assoc($resource)){    
        foreach ($row as $key => $value){
            $b = "";
            $b .= $indent . tabs(2) . "<tr>";
            $b .= "<td>" . $key     . "</td>"; #assuming elements got the array passed in correctly
            $b .= "<td>" . $value   . "</td>"; #assuming elements got the array passed in correctly
            $b .= "</tr>\n";
            $result[] = $b;    
        }
    }
  $result[] = $indent . tabs(1) . "</tbody>\n";   
  $result[] = $indent . "</table>\n";
  return $result; */
    while($row = mysql_fetch_assoc($resource)){    
        echo $indent . "<table class='". $class . "' >\n";
        echo $indent . tabs(1) . "<tbody>\n";   
            foreach ($row as $key => $value){
                echo $indent . tabs(2) . "<tr>";
                echo "<td>" . $key     . "</td>"; #assuming elements got the array passed in correctly
                echo "<td>" . $value   . "</td>"; #assuming elements got the array passed in correctly
                echo "</tr>\n";
            }
        echo $indent . tabs(1) . "</tbody>\n";   
        echo $indent . "</table>\n";
        br(1);
    }
}

function beginCss() {
  print "<style>\n";
}

function endCss() {
  print "</style>\n";
}


#(background-color, text-align)
function cssBodyStyle($bg_color, $text_align) { 
  print "body { background-color: $bg_color; text-align: $text_align; } \n";
}


function htmlContentHeader() { 
  print "content-type: text/html\n\n" . "<!DOCTYPE html><head lang=en><meta charset=utf-8 />\n";
  
}


function htmlTitle($title) { 
  print "<title>$title</title>\n";
}


class Table {
    protected $tbl_name; #table name
    private $attributes; # = array();
    
    public function __construct($tbl_name){
        $this->tbl_name = $tbl_name;        
    }
    public function setTable($tbl_name){
        $this->tbl_name = $tbl_name;
    }
    public function exists($id_name, $id){
        return mysql_query("SELECT * FROM " . $this->tbl_name . " WHERE $id_name='$id'");
    }
    /* 
    
        EDIT: 8-19-2016
              Fixed this.
              Now you should be able to use any insert as many rows as you wish to
              Haven't tested yet though.
              
        This function seems to hinge on the following ideas:
        1.) 
            Input elements have same names as columns in the table
        2.) $values is the $_POST or $_GET
            Thus $key => $value
            means 
                "columnname" => user_input
            based on #1
        3.)$columns is here to allow us to specify the columns we wish to include
            since $_POST and $_GET could have other things which will mess up the SQL
            For example
            $_POST['submit'] => 'Submit'
            This will not work if this carries through.
                INSERT INTO (name, age) VALUES ('submit, 'john', 19);
            See? Won't work.        
    */
    public function insert($columns, $values){
        $sql = "INSERT INTO " . $this->tbl_name . " ";
        $matches = array();
        $keys = array();
        /* 
            Easier way:
            instead of doing this, make the assumption that the only
            different thing would be 
            $_POST['submit'];
            
            in which case you can do
            
            unset($values['submit']);
            or delete it from the array somehow, 
        */
        foreach( $values as $key => $value){
            if(in_array($key,$columns)){
                array_push($matches, $value); //this would be better if we actually collected the matching keys too instead of just using $columns
                                              //thus it will ignore anything which would cause errors for lack of pairing
                array_push($keys, $key); //this means the order you put the columns in doesn't need to match the order of $_POST ($values really)
            }
        }
        $sql .=        "( " . implode(", "  , $keys)    .  ") ";
        for($i = 0, $vals_to_insert = "(", $end = ")"; $i < count($matches); $i++){            

            //if we have passed a full set of values, and there are still more,
            //then set us up to insert the next row
            $matches[$i] = "'" . $matches[$i] . "'";
            if ( ((($i + 1) % count($columns)) == 0) && (($i + 1) != count($matches)) ) {
                $matches[$i] .= ")";# this should work..
            }else if ( ((($i + 1) % count($columns)) == 1) && (($i + 1) > count($matches))){
                $matches[$i] = "(" . $matches[$i] ;# the idea is that the commas will fit after each slot
            }
            
        }
        $sql .= "VALUES (" . implode(", ", $matches ) . ")";
        return mysql_query($sql); #return '$result'               
    }
    public function insert_prepared($columns, $values){
        $matches = array();
        $keys = array();

        foreach( $values as $key => $value){
            if(in_array($key,$columns)){
                array_push($matches, $value); //this would be better if we actually collected the matching keys too instead of just using $columns
                                              //thus it will ignore anything which would cause errors for lack of pairing
                array_push($keys, $key); //this means the order you put the columns in doesn't need to match the order of $_POST ($values really)
            }
        }
        $sql_prep = 
        'PREPARE statement FROM "INSERT INTO ' . $this->tbl_name . ' (' .implode(", "  , $keys)    .  
        ') VALUES(' . substr(str_repeat("?,", count($keys)), 0, -1) . ')"';//use count keys cuz matches could have multiple rows
            
        if(!mysql_query($sql_prep))
            return mysql_error();

        for($j = 0; $j < count($matches) && (count($matches) % count($keys) == 0); $j++){
            $sql_execute = "EXECUTE statement USING "; 
            $sql_bind    = "SET ";
        
            for($i = 0; ($i < count($keys)) && ($j <= count($matches) - 1); $i++ ){        
                $sql_bind    .= "@" . $keys[$i] . "='" . mysql_real_escape_string($matches[$j]) . "',";
                $sql_execute .= "@" . $keys[$i] . ",";
                $j++;
            }
            $sql_bind    = substr($sql_bind   , 0, -1);//gets rid of the last comma
            $sql_execute = substr($sql_execute, 0, -1);
            if(!mysql_query($sql_bind))
                return mysql_error();

            if(!mysql_query($sql_execute))
                return mysql_error();
        
        }
        $sql_deallocate = 'DEALLOCATE PREPARE statement';
        if(!mysql_query($sql_deallocate) )    
            return mysql_error();
        return "Insert successful";
              
    }
    /* 
        This function is overloaded in order to allow for the option where you feed it something like
        NOT TESTED
        [ "col1" => 'data1', "col2" => 'data2'] etc 
    
    public function insert($values){
        $sql = "INSERT INTO " . $this->tbl_name . " ";
        $values = array();
        $columns = array();
        foreach( $values as $key => $value){
            array_push($values, $value);                                               
            array_push($columns, $key); 
        }
        $sql .=        "( " . implode(", "  , $columns)    .  ") ";
        for($i = 0; $i < count($values); $i++){            
            $values[$i] = "'" . $values[$i] . "'";
            if ( ((($i + 1) % count($columns)) == 0) && (($i + 1) != count($values)) ) {
                $values[$i] .= ")";# this should work..
            }else if ( ((($i + 1) % count($columns)) == 1) && (($i + 1) > count($values))){
                $values[$i] = "(" . $values[$i] ;# the idea is that the commas will fit after each slot
            }
            
        }
        $sql .= "VALUES ('" . implode(", ", $values ) . "')";
        return mysql_query($sql); #return '$result'               
    }
    */
    //Assumes all values passed in for where are equals ones.
    #$story.getAll( array("user_id", $_SESSION['user_id']) );
    public function getAll($conditions = array(), $extra_query_stuff = ""){
        $sql = "SELECT * FROM " . $this->tbl_name;

        if(count($conditions)){
            $sql .= " WHERE ";
            for ($i = 0; ($i < count($conditions)); $i+=2){ //which happens first i+=2 or the other part... that changes things
                $sql .= $conditions[$i] . "='" . $conditions[$i + 1] . "' ";                 
                $sql .= " AND ";                
            }
        }
        if(count($conditions)){
            $sql = substr($sql, 0, strlen($sql) - 5);
        }
        if($extra_query_stuff){
            $sql .= " " . $extra_query_stuff;
        }
        return mysql_query($sql);
    }
    /* 
        Returns array of associative arrays for a resource
    */
    public static function getRowsAssoc($resource){
        $rows = array();
        if($resource){
            while($row = mysql_fetch_assoc($resource)){
                array_push($rows, $row);
            }
        }
        return $rows;
    }
    public function getAllAssoc($cond = array(), $extra_query_stuff = ""){
        return Table::getRowsAssoc($this->getAll($cond, $extra_query_stuff));//can do this because static 
    }
    public function getAttribute($attr, $conditions = ""){
        if($conditions){
            $rows = $this->getRowsAssoc(
                $this->getAll( $conditions )
            );
            if(count($rows))
                $this->attributes = $rows[0];//0 because getRowsAssoc returns an array of arrays
        }
        if($this->attributes)
            return $this->attributes[$attr];
        return "error";
    }
    //public function getAttributes($attrs) //easy to implement, though can just return the assoc array
    /* 
    The idea behind this function is that you input an associative array of the keys you
    wish to input, and map them to the text that should be displayed to the left of them
    //technically this could be used, if extended, for updating as well, not just creating
    //actually, let's code for that possibility. Adding in $cond array.
    //if there are conditions, then that means we are updating
    //else it means we are simply creating
    printAjaxInput($keyNames, $cond = array()){
    
    $keyNames should be like array(
                                "col1" => "First Name:",
                                "col2" => "Last Name:",
                                "col3" => "Address:" //etc
                             );
    
    if ajax, then we would't need a form...
    but we could still use this Table object to handle the ajax.
    if we create a function to do so.
    
    }
    
    One of the ideas is that this Table object can print the javascript automatically
    and just needs to be called at the end of the <body> tag
    */
    public function printAjaxInput($keyNames, $url, $method ="GET", $cond = array()){
        //hmm... the problem is if this is ajax, then we need a way to put the javascript in there.
        //we could add the javascript at the end of the body I guess
        //Another problem: I wish to use my helper functions htmlForm etc
        //but that destroys the integrity of this function
        //so maybe just do everything by hand??
        //another problem: how do we deal with abnormal types of data?
        //hmm all could be text, true
        //conversion is possible.
        //and we can handle certain parts 
        //maybe should consider adding in ids etc so it can be styled by someone else or anyone
         
        foreach($keyNames as $col_name => $label){
            echo "<label>$label<input type='text' id='$col_name' name='$col_name' \></label><br />\n";
        }
        echo "<input onclick='handleAjax([" . '"'.  implode('","', array_keys($keyNames)) . '"' ."], \"$url\", \"$method\");' type='submit' value='Submit' /><br />\n";
    
    }
    public function printAjaxScript($extra_data = ""){
        echo <<<END
    <script type="text/javascript">
        function addToTable(data){
            tables = document.getElementsByTagName("table");
            //this part doesn't seem to be working for some reason..
            if(!tables.length){
                table = document.createElement("table");
                document.body.appendChild(table);
                tables = document.getElementsByTagName("table");
            }
            tr = document.createElement("tr");
            //the idea here is that since the ids are auto-assigned, we have to let
            //can't know what the id is for the thing we are adding, so
            //if we are also displaying (presumably) the ID, then
            //we put a padding layer.


            //padding used to only get defined if the if statement works, (causing issues)
            // so we initialize it here:
            padding = "";
            if(tables[0].rows.length && (tables[0].rows[0].cells.length != data.length)){
                for(i = 0; i < tables[0].rows[0].cells.length - data.length; i++){
                    padding += "<td>Refresh to see</td>";    
                }
            }
            
            //can't use join because data is an object
            tr.innerHTML = padding + "<td>" + data.join("</td><td>") + "</td>";
            tables[0].appendChild(tr); //not sure if this will work
        }
        function handleAjax(keys, url, method){
            ajaxRequest = new XMLHttpRequest();
            if(!ajaxRequest){
                alert("Unable to make the ajax request");
                return false;
            }
            //alert(keys);Fine here
            data = [];//associative arrays are bad, we should be using objects I guess
            request_data = "";
            keys.forEach(function(element){
            //this is pretty cool. We don't even need an iterator
                data[data.length] = document.getElementById(element) ? document.getElementById(element).value : "NOT FOUND"; 
                request_data += element + "=" + data[data.length - 1] + "&";
            });
            //alert(request_data);
            ajaxRequest.onreadystatechange = function(){
                if(ajaxRequest.readyState === XMLHttpRequest.DONE){//ajax is DONE
                    if(ajaxRequest.status == 200){ //all OK
                        
                        alert("This is the response: " + ajaxRequest.responseText);
                        
                        addToTable(data);//we don't need the responseText
                        //because we already ahve the data for the table in the data var
                        //though we should clear all of the inputs now
                        keys.forEach(function(element){
                            document.getElementById(element).value = "";//not sure if this will work, because of closures and what have you
                        });
                    }else{
                        alert("There was a problem with the request")
                    }
                }
            }
            if(method.toUpperCase() == "GET"){
                ajaxRequest.open(method, url + "?" + request_data + "$extra_data");
                ajaxRequest.send();
            }else{
                ajaxRequest.open(method, url);
                ajaxRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                ajaxRequest.send(request_data + "$extra_data");            
            }
            
        }
    </script>
END;
    }
    //should mimick insert's masking $columns variable and logic
    //would enable us to not have to unset($_BLAH['submit'])
    public function update($pairs, $wheres){ //this is nice because you can pass it $_POST. //wait it would have been nice, except for $_POST['submit']
        $sql = "UPDATE " . $this->tbl_name . " SET";
        foreach ($pairs as $column => $value){
            $sql .= " $column='" . mysql_real_escape_string($value) . "', ";
        }        
        $sql = substr($sql, 0, strlen($sql) - 2);
        #$str .= count($wheres) > 1 ? " WHERE " . $wheres[0] . "='" . $wheres[1] . "'" : "";
        for($i = 0; $i < count($wheres); $i+=2){
            $link = ($i == 0) ? " WHERE " : " AND ";
            $sql .= $link . " " . $wheres[$i] . "='" . $wheres[$i + 1] . "'";
        }
        //return $sql;
        return mysql_query($sql); #return '$result'       
    }
    public function delete($wheres){
        $sql = "DELETE FROM " . $this->tbl_name . " ";        
        for($i = 0; $i < count($wheres); $i+=2){
            $link = ($i == 0) ? "WHERE" : "AND";
            $sql .= $link . " " . $wheres[$i] . "='" . $wheres[$i + 1] . "'";
        }
        return mysql_query($sql); #return '$result'       
    }
    //this one is different from the $_POST one I think
    //this one expects you to actually write out the values, and in the same order as the columns
    /* 
        There could be problems if each table has the same names for its columns
    */
    public function join($table2, $columns, $values){
        $sql = "SELECT * FROM " . $this->tbl_name . " JOIN " . $table2 . " ON ";
        for($i = 0; ($i < count($columns)) && ($sql .= " AND "); $i++){
            //including the .= " AND "; makes it not run the last time. It runs every time except for the last time, interesting.
            //oh wait, that would be the same anyways.
            $sql .= "'" . $columns[$i] . "'='" . $values[$i] . "'";
        }
        return mysql_query($sql);
    }
    public function join2($table2, $hash){
        $sql = "SELECT * FROM " . $this->tbl_name . " JOIN " . $table2 . " ON ";
        //foreach(){
            
        //}
        for($i = 0; ($i < count($columns)); $i++, $sql .= " AND "){
            $sql .= "'" . $columns[$i] . "'='" . $values[$i] . "'";
        }
        return mysql_query($sql);
    }
}

function connectDB($domain, $username, $pass, $db){    
    $conn = mysql_connect($domain, $username, $pass);
    mysql_select_db($db);
    
    if (!$conn) {
        echo "Database connection failed: " . mysql_error();
    }
    return $conn;
} 

function htmlTableAssoc($elements, $class="", $indent="") { #prototype v0.1
  $result = array();
  $result[] = $indent . "<table class='". $class . "' >\n";
  $result[] = $indent . tabs(1) . "<tbody>\n";   
  for ($i = 0; $i < count($elements) && count($elements[$i]); $i++ ) { 
    $b = "";
    $b .= $indent . tabs(2) . "<tr>";
    foreach($elements[$i] as $key => $element){
        if ( !empty( $element ) ){
          $b .= "<td>" . $element . "</td>"; #assuming elements got the array passed in correctly
        }else {
          $b .= "<td>" . "" . "</td>";
        }
    }
    $b .= "</tr>\n";
    $result[] = $b;
  }
  $result[] = $indent . tabs(1) . "</tbody>\n";   
  $result[] = $indent . "</table>\n";
  return $result;
}

function printHtmlTableAssoc($elements, $class="", $indent="") { #prototype v0.1
  $result = array();
  $result[] = $indent . "<table class='". $class . "' >\n";
  $result[] = $indent . tabs(1) . "<tbody>\n";   
  for ($i = 0; $i < count($elements); $i++ ) { 
    $b = "";
    $b .= $indent . tabs(2) . "<tr>";
    foreach($elements[$i] as $key => $element){
        if ( !empty( $element ) ){
          $b .= "<td>" . $element . "</td>"; #assuming elements got the array passed in correctly
        }else {
          $b .= "<td>" . "" . "</td>";
        }
    }
    $b .= "</tr>\n";
    $result[] = $b;
  }
  $result[] = $indent . tabs(1) . "</tbody>\n";   
  $result[] = $indent . "</table>\n";
  echo implode("", $result);
}

/* 
    This version is designed to only display certain keys
    (allowing you to not display the pk and fks for example.
*/
function htmlTableAssoc2($elements, $keys, $class="", $indent="") { #prototype v0.1
  $result = array();
  $result[] = $indent . "<table class=". $class . " >\n";
  $result[] = $indent . tabs(1) . "<tbody>\n";   
  for ($i = 0; $i < count($elements) && count($elements[$i]); $i++ ) { 
    $b = "";
    $b .= $indent . tabs(2) . "<tr>";
    foreach($elements[$i] as $key => $element){
        if ( !empty( $element ) && in_array($key, $keys) ){
          $b .= "<td>" . $element . "</td>"; #assuming elements got the array passed in correctly
        }else if(in_array($key, $keys)) {
          $b .= "<td>" . "" . "</td>"; #assuming elements got the array passed in correctly
        }
    }
    $b .= "</tr>\n";
    $result[] = $b;
  }
  $result[] = $indent . tabs(1) . "</tbody>\n";   
  $result[] = $indent . "</table>\n";
  return $result;
}
function printHtmlTableAssoc2($elements, $keys, $class="", $indent="") { #prototype v0.1
  $result = array();
  $result[] = $indent . "<table class=". $class . " >\n";
  $result[] = $indent . tabs(1) . "<tbody>\n";   
  for ($i = 0; $i < count($elements) && count($elements[$i]); $i++ ) { 
    $b = "";
    $b .= $indent . tabs(2) . "<tr>";
    foreach($elements[$i] as $key => $element){
        if ( !empty( $element ) && in_array($key, $keys) ){
          $b .= "<td>" . $element . "</td>"; #assuming elements got the array passed in correctly
        }else if(in_array($key, $keys)) {
          $b .= "<td>" . "" . "</td>"; #assuming elements got the array passed in correctly
        }
    }
    $b .= "</tr>\n";
    $result[] = $b;
  }
  $result[] = $indent . tabs(1) . "</tbody>\n";   
  $result[] = $indent . "</table>\n";
  echo implode("", $result);
}


/* 
    3-28-2017
    Fixes an issue I had where the header won't align with the contents, because it is based off of
    the order of $elements, instead of $keys
*/
function printHtmlTableAssoc3($elements, $keys, $class="", $indent="") { #prototype v0.1
  $result = array();
  $result[] = $indent . "<table class='". $class . "' >\n";
  $result[] = $indent . tabs(1) . "<tbody>\n";   
  for ($i = 0; $i < count($elements) && count($elements[$i]); $i++ ) { 
    $b = "";
    $b .= $indent . tabs(2) . "<tr>";
    $row = $elements[$i];

    foreach($keys as $index => $key){
        if ( !empty( $row[$key] ) || $row[$key] == "0"  ){
          $b .= "<td>" . $row[$key] . "</td>"; #assuming elements got the array passed in correctly
        }else {
          $b .= "<td>" . "<i>attribute_empty</i>" . "</td>"; #assuming elements got the array passed in correctly
        }            
    }        
    
    $b .= "</tr>\n";
    $result[] = $b;
  }
  $result[] = $indent . tabs(1) . "</tbody>\n";   
  $result[] = $indent . "</table>\n";
  echo implode($result, "");
}



/*

An example of how this class is supposed to work. 
Can probably subclass it for specific applications and override functionality.
As of 3-28-2017 it is incomplete:

    To-do

Example parameters
$crud = new CRUD(
    "users", 
    array(
        "fname"     => "text",
        "lname"     => "text",
        "email"     => "text",
        "birth"     => "date",
        "about"     => "textarea",
        "activated" => "text"
    )
);

*/
class CRUD {
    private $keys;//      = array(); //the columns
    private $tablename;// = "";
    private $columns;// = array();
    private $table;//for caching purposes
    //$array = ($column => type, column => type);
    
    public function __construct($tablename, $columns){
        $this->tablename = $tablename;
        $this->columns   = $columns;
                
        try{
            $this->createPage();
        }catch(Exception $e){
            echo $e->getMessage();
        }
        $this->table = new Table($tablename);
        
        /*readPage();
        deletePage();
        updatePage(); */
    }
    private function createPage(){
        $file = fopen("create" . $this->tablename . ".php", "w");
        $html = "<!DOCTYPE html>\n";
        $html .= "<html>\n".
                 "<head>"  .
                 "    <title>Create for " . $this->tablename . "</title>" .
                 "</head>" .
                 "<body>"  .
                 '<?php 
                     echo "I am interpreting this program.\n";
                     //now we have to handle the form
                    if(!isset($_POST[Submit])){
                 ?>' .
                    $this->getForm() .
                 '<?php
                    }else{
                        //store all of the data in the table
                        //ie create the new entry in the table
                        $table = new Table(' . $this->tablename . ');
                        $result = $table->insert( $_POST, ' . $this->getKeys() . ');
                        if(!$result){
                           echo "There was an error creating the new object<br />\n";
                           //echo mysqli_error();
                        }else{
                           echo "Congratulations, object successfully created<br />\n";
                        }
                    }
                 ?>' .
                 "</body>" .
                 "</html>";
        fwrite($file, $html);        
        fclose($file);
    }
    /*
        ReadPage by default depends on specific assumptions
        $column named $id perhaps? Or some such thing?
        
    */
    private function readPage(){
       echo "";
    }
    private function deletePage(){
       echo "";
        
        
    }
    private function updatePage(){
       echo "";
        
        
    }
    private function getKeys(){
        $result = "array(";
           foreach($this->columns as $key => $value){
              $result .= "'" . $key . "',";
           }
           $result = substr($result, 0, strlen($result) - 1); //remove extra comma
        $result .= ")";
        return $result;
    }

    private function getForm(){
        $result = "<form action='" . "create" . $this->tablename . ".php' method='post'>\n";
        foreach($this->columns as $column_name => $type){
            echo "$column_name $type in the foreach loop\n\n";
            $result .= "<label>$column_name" . $this->getInput($column_name, $type) . "</label>";
        }
            $result .= "<input type='Submit' value='Submit' />\n";
        $result .= "</form>";
        return $result;
    }   
    private function getMainReadDiv(){
        //idea is to display all the pieces of the item
        /* 
            depends on $_GET['id'] though I believe
            so probably should be part of the page_creation logic
        */
        //$table = new Table( $this->tablename );
        $table = $this->table;
        $table->getAllAssoc(array()); //something like this
        $result = "";
        /*
        foreach($table as $row){
            $result .= "<div class='content-box'>\n";
            foreach($this->keys as $key){
                $result .= $key . ": " . $row[$key];
            }
            $result .= "</div>\n";
        }
        */
        return $result;    
    }
    
    private function getInput($col_name, $type){
        switch($type){
            case "text":
                return "<input type='text' name='$col_name' value='' />\n";
                break;            
            case "textarea":
                return "<textarea name='$col_name' value='' ></textarea>\n";
                break;            
            case "date":
                return "<input type='date' name='$col_name' value='' />\n";
                break;            
            default:
                return "No satisfactory input field found for this object\n";
                break;
            
        }        
    }    
    
     
}
interface Printable {
    public function printElement();
    
}
class HTMLElement implements Printable {
    private $tag;       
    private $single;    
    private $inside;    //(new HTMLElement()).setSingle(true); 
    private $attributes;

    public function __construct(){
        $this->tag        = "";//default is nothing
        $this->single     = false;
        $this->inside     = array();//(new HTMLElement()).setSingle(true); 
        $this->attributes = array();
        //return $this;
    }
    public function setTag($tag){
        $this->tag    = $tag;
        return $this;
    }
    public function setSingle($single){
        $this->single = $single;    
        return $this;                
    }    
    public function addElement($element){
        if(!$this->single)
            $this->inside[] = $element;
        return $this;
    }
    public function addAttribute($attribute){
        $this->attributes[] = $attribute;
        return $this;
    }
    public function addAttributes($attributes){
        foreach($attributes as $attribute  ){
            $this->attributes[] = $attribute;
        }
        return $this;
    }
    /* 
        We are allowing for text to be used inside of elements, and text should count as its own node
    */
    public function addText($text){
        if(!$this->single){
            $newElement = new TextElement($text); //(new HTMLElement())->setTag("p")->addElement( new TextElement($text));
            $this->inside[] = $newElement;
        }
        return $this;
    }
    public function printElement($tabs = ""){
        if($this->single){
            echo "$tabs<" . $this->tag . " " . implode(" ", $this->attributes) . " />\n";
        }
        else{   
            echo "$tabs<" . $this->tag . " " . implode(" ", $this->attributes) . " >\n";
            foreach($this->inside as $key => $element){
                $element->printElement($tabs . "    ");
            }
            echo "$tabs</" . $this->tag . ">\n";
        }
    }
}
/* 
    3-31-2017
    Create two abstract classes
        HTMLElement
        SingleElement
        and
        DoubleElement //or something like that
    Then create specific subclasses for each type
    
    ATM Double element is just the same as HTMLElement sooo idk
    
    i.e.
    class ImageElement extends SingleElement {
        
    }
    class ParaElement extends DoubleElement {
    
    }
*/
class TextElement extends HTMLElement {
    private $text = "";    
    public function __construct($text){
        $this->text = $text;
    }
    //override
    public function addElement($element){
        //do nothing
        return $this;
    }
    public function setText($text){
        $this->text = $text;
        return $this;
    }
    //override
    public function printElement($tabs = ""){
        echo $tabs . $this->text . "\n";
    }
    
}

class PageHeader implements Printable {
    private $items = array(
    );    
    public function __construct(){
            
    }
    public function addElement(){
        
    }   
    public function printElement(){
        if(items.length) //not really what we would do, since it'll have html elements
            echo implode(" ", $items);
    } 
}



?>