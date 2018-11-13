        
/* 

    Prototype example of data that the server will send to the client.
    Should also have a page tag or something so we can easily figure out what page we are working with.
    
*/

function getCurrentPageNumber(){
    return 1;
}
/* 
return overlib(
    '<span class=\'summary_jyutping\'>
        ji4 gaa1
    </span>
    <br/>
    <span class=\'summary_pinyin\'>
        er2 jia1
    </span>
    <br/>
    now; this moment 
    <a title=\'Cantonese only, (usually spoken but can be written)\'>
        <span class=\'cantonesebox\'>
            粵
        </span>
    </a>'
,CAPTION,
    '<div class=\'olibunicodecaption\'>
        而家
    </div>', 
AUTOSTATUS, 
WRAP);
*/
//onmouseover="return overlib('<span class='popup'>にほんじん</span>', WRAP);"
function popUpHtml(text, popupText){
    return "<span onmouseover=\"return overlib('<span class=\\'popup\\'>" + popupText + "</span>', WRAP);\" onmouseout=\"nd();\" >" + text + "</span>\n";
}

function displayAndFormatVocabulary(){
    
    var html = "";
    html += "<div class='col-12 text-center'><h3> Page " + getCurrentPageNumber() + ": Vocabulary </h3></div>\n";
    vocabulary.forEach(function(obj){
        html += "<div class='col col-12 cell vocabBox'>\n";
        html += "<div class='row text-center cell'>\n<div class='col-12'>" + obj.sentence + "</div>\n</div>\n";
        for(i = 0; i < obj.vocab.length - 2; i+=3){
            html += "<div class='row'>\n";
            html += "<div class='col-4 col-md-4 col-lg-4 text-center'>" + 
                popUpHtml(obj.vocab[i], obj.vocab[i+1]) + 
            "</div>\n";
            //if(obj.vocab[i] != obj.vocab[i+1] )
                html += "<div class='col-4 col-md-4 col-lg-4 text-center'>" + obj.vocab[i+1] + "</div>\n";
            //else
            //    html += "<div class='col-4 col-md-4 col-lg-4 text-center'></div>\n";
            html += "<div class='col-4 col-md-4 col-lg-4 text-center'>" + obj.vocab[i+2] + "</div>\n";
            html += "</div>";
        }
        html += "</div>\n";
    });
    html += "<div class='col-12 text-right'>" + 
        "<button id='studyvocab'>Study Vocabulary</button>" +
        "</div>\n";
    document.getElementById("textBox").innerHTML = html;
    $("#studyvocab").click(
        function(){
            document.location = "vocabulary.php";
        }
    );
}

function displayAndFormatText(){
    var html = "<div class='col-12 text-center'><h3> Page " + getCurrentPageNumber() + ": Kanji </h3></div>\n";

    html += "<p>\n";
    data.forEach(function(obj){
        html += obj.sentence;
    });
    html += "</p>\n";

    
    html += '<div class="col-6 text-left">' +
        '<span onclick="alert(\'prior page\');">< </span>' +
        '</div>' +
        '<div  onclick="alert(\'next page\')"class="col-6 text-right">' +
         '  > ' +
         '</div>';
    
    document.getElementById("textBox").innerHTML = html;
}

function displayAndFormatGrammar(){
    var html = "";
    html += "<div class='col-12 text-center'><h3> Page " + getCurrentPageNumber() + ": Grammar </h3></div>\n";
    grammar.forEach(function(obj){        
        html += "<div class='col col-12 grammarBox'>\n";
            html += "<div class='row text-center cellTop headerCell'>\n<div class='col-12'>" + obj.title + "</div>\n</div>\n";
            html += "<div class='row cellBottom'>\n";
                html += "<div class='col-12 grammar-explanation text-center'>" + obj.explanation + "</div>\n";
            html += "</div>";
        html += "</div>\n";
    });
    html += "<div class='col-12 text-right'>" + 
    "<button id='studygrammar'>Take Grammar Quiz</button>" +
    "</div>\n";
    document.getElementById("textBox").innerHTML = html;
    
    $("#studygrammar").click(
        function(){
            document.location = "grammar.php";
        }
    );
}
vocabulary = [];
grammar = [];
$(function(){
    /* 
        get and load the data from the server.
    */
    $.ajax({
        url: "get_vocab.php",
    })
    .done(function( data ) {
        vocabulary = JSON.parse(data);
    });
    
    $.ajax({
        url: "get_grammar.php",
    })
    .done(function( data ) {
        grammar = JSON.parse(data);
    });
    
    $("#vocab").click(displayAndFormatVocabulary); //uses data from the server now
    $("#book").click(displayAndFormatText);
    $("#grammar").click(displayAndFormatGrammar);
});