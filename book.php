<?php 
    /*
        This is from here on out the "overview" page for a given text. 
        It should load the data from the server and should 
        There isn't really 
    */
    require_once("functions.php");
?>
<?php
            printHead("Books", array("main_style.css", "book.css"), array("overlibmws.js", "overlibdefaults.js"));
            setUpNavBar("Books");

        ?>
        <div class="container-fluid" style="border: 1px solid black;">
            <div class='row' style=" ">
                <div class='panel col-lg-12 col-md-12 text-center'>
                    <div class="row cellTop headerCell">
                        <div class='col-xs-12 col sm-12 col-lg-12 col-md-12 text-center'>
                            日本のお風呂
                        </div>
                    </div>
                    <div class="row cell ">
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            <button id="vocab"><p>Vocabulary</p></button>
                        </div>
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            <button id="book"><p>Kanji</p></button>
                        </div>
                        <div class='col-xs-4 col sm-4 col-lg-4 col-md-4 text-center'>
                            <button id="grammar"><p>Grammar</p></button>
                        </div>
                    </div>
                    <div id="textBox" class="row cellBottom ">
                        <div  class='col-xs-12 col-12 sm-12 col-lg-12 col-md-12 text-center'>
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
                        <div class="col-6 text-left">
                            <span onclick="alert('hello');">< </span>
                        </div>
                        <div class="col-6 text-right">
                            >
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script>
        
/* 

    Prototype example of data that the server will send to the client.
    Should also have a page tag or something so we can easily figure out what page we are working with.
    
*/
var data =  
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
    {
        sentence: "毎日、お風呂に入る人が、多いです。",
        vocab: [
            "毎日",
            "まいにち",
            "every day",
            "お風呂",
            "おふろ",
            "bathtub",
            "入る",
            "はいる",
            "to enter",
            "人",
            "ひと",
            "person, people",
            "多い",
            "おおい",
            "many",
            "です",
            "です",
            "is"
        ],
        grammar: [
            "に", 
            "direction indicator", 
            "specifically with verb 'に入る'",
            "が", 
            "subject indicator"
        ]
    },
    {
        sentence: "日本は、夏は暑くて、冬は寒い国です。",
        vocab: [
            "日本",
            "にほん",
            "japan",
            "夏",
            "なつ",
            "summer",
            "暑い",
            "あつい",
            "hot",
            "冬",
            "ふゆ",
            "winter",
            "寒い",
            "さむい",
            "cold",
            "国",
            "くに",
            "country",
            "です",
            "です",
            "is"
        ],
        particles: [
            "は subject indicator",
            "は contrastive"
        ],
        grammar: [
            "te form (specifically of i adjectives)",
            "modification of a noun using an adjective or verb"
        ]
    },
    {
        sentence: "だから、いつでもお風呂に入りたくなるのです。",
        vocab: [
            "だから",
            "だから",
            "thus, because of (that)",
            "いつでも",
            "いつでも",
            "anytime",
            "お風呂",
            "おふろ",
            "bathtub",
            "に",
            "に",
            "to, towards, in",
            "入りたく",
            "はいりたく",
            "want to enter (adverb)",
            "なる",
            "なる",
            "to become",
            "です",
            "です",
            "is"
        ],
        particles: [
          "に",
          "の"
        ],
        grammar: [
          "volitional form of verbs",
          "adverbal form of i adjectives",
          "adverb + naru",
          "to become",
          "assertion of fact",
          "no"
        ]
    }
];

var data_old =  
[
    {
        sentence: "日本人は、お風呂が大好きです。",
        vocab: [
            "日本人",
            "Japanese person",
            "お風呂",
            "bathtub", 
            "大好き",
            "love",
            "です",
            "is"
        ],
        particles: [
            "は",
            "が"
        ]
    },
    {
        sentence: "毎日、お風呂に入る人が、多いです。",
        vocab: [
            "毎日",
            "every day",
            "お風呂",
            "bathtub",
            "入る",
            "to enter",
            "人",
            "person, people",
            "多い",
            "many",
            "です",
            "is"
        ],
        grammar: [
            "に", 
            "direction indicator", 
            "specifically with verb 'に入る'",
            "が", 
            "subject indicator"
        ]
    },
    {
        sentence: "日本は、夏は暑くて、冬は寒い国です。",
        vocab: [
            "日本",
            "japan",
            "夏",
            "summer",
            "暑い",
            "hot",
            "冬",
            "winter",
            "寒い",
            "cold",
            "国",
            "country",
            "です",
            "is"
        ],
        particles: [
            "は subject indicator",
            "は contrastive"
        ],
        grammar: [
            "te form (specifically of i adjectives)",
            "modification of a noun using an adjective or verb"
        ]
    },
    {
        sentence: "だから、いつでもお風呂に入りたくなるのです。",
        vocab: [
            "だから",
            "thus, because of (that)",
            "いつでも",
            "anytime",
            "お風呂",
            "bathtub",
            "に",
            "to, towards, in",
            "入りたく",
            "want to enter (adverb)",
            "なる",
            "to become",
            "です",
            "is"
        ],
        particles: [
          "に",
          "の"
        ],
        grammar: [
          "volitional form of verbs",
          "adverbal form of i adjectives",
          "adverb + naru",
          "to become",
          "assertion of fact",
          "no"
        ]
    }
];
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
    data.forEach(function(obj){
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
    var html = "<div class='col-12 text-center'><h3> Page " + getCurrentPageNumber() + " </h3></div>\n";

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
    /*var html = "";
    data.forEach(function(obj){
        if(obj.grammar){
            html += "<div class='col-12'>\n<span class='grammar-box'>";
            for(i = 0; obj.grammar && i < obj.grammar.length; i++){
                html += obj.grammar[i] + " ";
            }
            html += "</span></div>\n";
        }
    });
    */
    var html = "";
    html += "<div class='col-12 text-center'><h3> Page " + getCurrentPageNumber() + ": Grammar </h3></div>\n";
    data.forEach(function(obj){
        html += "<div class='col col-12 cell grammarBox'>\n";
        html += "<div class='row text-center cell'>\n<div class='col-12'>" + obj.sentence + "</div>\n</div>\n";
        for(i = 0; obj.grammar && i < obj.grammar.length; i++){
            html += "<div class='row'>\n";
            html += "<div class='col-12 col-md-12 col-lg-12 text-center'>" + obj.grammar[i] + "</div>\n";
            html += "</div>";
        }
        html += "</div>\n";
    });
    document.getElementById("textBox").innerHTML = html;
}
$("#vocab").click(displayAndFormatVocabulary);
$("#book").click(displayAndFormatText);
$("#grammar").click(displayAndFormatGrammar);
        </script>
<?php
    printFoot();
?>