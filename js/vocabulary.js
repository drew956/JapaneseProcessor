/* 

    Prototype example of data that the server will send to the client.
    Should also have a page tag or something so we can easily figure out what page we are working with.

    
    
*/

var filter = [
    "です",
    "is"
];
//should only really be loaded once
var vocab = [];
var v_idx = 0; // index into vocab list

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

/* 
    the data should really be pulled from the server tbh
    and then this function should dynamically create the vocab list each time.
    That, or the list should be stored in the server somewhere. 
    perhaps in the db.
    Just tag all the words?
    Would have to be pairs then, because different stories could have overlaps in the words.
*/

//this should be put in whatever function gets the data from the server.
data.forEach(function(obj){
    for(i = 0; i < obj.vocab.length - 2; i+=3){
    vocab.push(obj.vocab[i]); 
    vocab.push(obj.vocab[i+1]);
    vocab.push(obj.vocab[i+2]);
    }
});


function getCurrentPageNumber(){
    return 1;
}

function updateFlashCard(){
/*
    if(vocab[v_idx] == vocab[v_idx+1])
        $("#card > .front")[0].innerHTML = vocab[v_idx];
    else
        $("#card > .front")[0].innerHTML = vocab[v_idx] + "<br />(" + vocab[v_idx+1] + ")";    
    $( "#card > .back")[0].innerHTML = vocab[v_idx + 2];
*/
    $("#card > .front")[0].innerHTML = vocab[v_idx];
    if(vocab[v_idx] == vocab[v_idx+1])
        $( "#card > .back")[0].innerHTML = vocab[v_idx + 2];
    else
        $( "#card > .back")[0].innerHTML = vocab[v_idx + 2] + "<br />(" + vocab[v_idx+1] + ")";    

}


/* 
    Divides by 3 because each word has 3 elements in the array
        kanji (or just hiragana)
        hiragana reading
        english meaning
*/
function updateCount(){
    $("#count")[0].innerHTML = "Word " + (v_idx + 3)/3 + " of " + (vocab.length / 3);
}
function moveFlashCardRight(){
    var flip = $("#card").data("flip-model");

    if(flip.isFlipped){
        $("#card").flip(false, function(){ //flip to front (reset before transitioning)
    
            if(v_idx != null)
                v_idx = (v_idx + 3) >= vocab.length ? 0 : v_idx + 3;
            updateFlashCard();
            updateCount();
        });
    } else {
        if(v_idx != null)
            v_idx = (v_idx + 3) >= vocab.length ? 0 : v_idx + 3;
        updateFlashCard();
        updateCount();
    }
}
function moveFlashCardLeft(){
    var flip = $("#card").data("flip-model");

    if(flip.isFlipped){
        $("#card").flip(false, function(){
            if(v_idx != null){
                v_idx = (v_idx - 3) < 0 ? vocab.length - 3 : v_idx - 3;
            }
            updateFlashCard();
            updateCount();
        });
    } else {
        if(v_idx != null){
            v_idx = (v_idx - 3) < 0 ? vocab.length - 3 : v_idx - 3;
        }
        updateFlashCard();
        updateCount();
    }
}
function toggleFlashCard(){
    $("#card").flip('toggle');
}


function getVocabInput(word){
    return '<div class="form-group">' + "\n" +
                '<label>' + word +  "\n" +
                '<input type="text" class="form-control" name="word[]" placeholder="Reading in hiragana">' + "\n" +
                "<br />" +
                '<input type="text" class="form-control" name="word[]" placeholder="English translation">' + "\n" +
                '</label>' + "\n" +
            "</div>";
}

function processAnswers(){
    //alert("clicked me");
    total = 0; //total number of points possible
    console.log(vocab.length);
    $("input[type=text]").each(function(index, element){ 
        console.log(index);
        if(index % 2 == 0){    //checking hiragana     
            console.log(element.value + " " + vocab[ (index/2)*3 + 1 ]);
            if(element.value == vocab[ (index/2)*3 + 1 ] ) //checking the english value
                total++;    
        } else { //checking english
            console.log(element.value + " " + vocab[ ((index-1)/2)*3 + 2  ]);
            if(element.value == vocab[ ((index-1)/2)*3 + 2 ] ) //checking the english value
                total++;  
        }
    });
    if(total/(vocab.length*2/3) >= 0.80){
        /* 
            1.) Create a box congratulating them and asking them if they want to try again
                or to return to the overview page
        */
        alert("You did it! You passed");
    } 
    alert(total);
    return false;
}

/*
    This could probably be done server-side with PHP, using a get book or id attribute
    But for this mock-up we will generate it with javascript
*/
function generateQuiz(target){
    html = $("form[name=quizform]")[0].innerHTML;
    for(i = 0; i < vocab.length - 3; i += 3){
        html += getVocabInput(vocab[i]);
    }
//    html += "<button type='submit' name='submit' form='quizform' class='btn btn-primary'>" +  "Submit</button>\n";
      html += "<button type='button' name='submit' onclick='processAnswers();' class='btn btn-primary'>" +  "Submit</button>\n";
    $("form[name=quizform]")[0].innerHTML = html;
}

/* 
    Inserts the quiz into the dom.
    Loads data for quiz from server
*/
function startQuiz(){
    $("#cardrow").remove(); //should probably store and reattach later
    $("#startdiv").remove();
    $("#quiz").css("visibility", "visible");
    generateQuiz();
}

$(function(){
    $(document).keydown(
        function(event){
            // left 37  
            // right 39
            // up 38  
            // down 40
            switch(event.which){
                case 37: //left
                    moveFlashCardLeft();
                    break;
                case 38: //up
                case 40: //down
                    toggleFlashCard();
                    break;
                case 39: //right
                    moveFlashCardRight();
                    break;
                default: 
                    //alert(event.which);
                    break;
            }
        }
    );
    updateFlashCard();
    updateCount();    
    $("#card").flip({
        axis: 'x',
        trigger: 'click',
        reverse: true
    });
    $("#right-arrow").click(moveFlashCardRight);
    $("#left-arrow").click(moveFlashCardLeft);
    $("#start").click(startQuiz);

});