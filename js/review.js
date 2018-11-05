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

/* 
    the data should really be pulled from the server tbh
    and then this function should dynamically create the vocab list each time.
    That, or the list should be stored in the server somewhere. 
    perhaps in the db.
    Just tag all the words?
    Would have to be pairs then, because different stories could have overlaps in the words.
*/
data.forEach(function(obj){
    for(i = 0; i < obj.vocab.length - 1; i+=2){
    vocab.push(obj.vocab[i]); 
    vocab.push(obj.vocab[i+1]);
    }
});


function getCurrentPageNumber(){
    return 1;
}

function updateFlashCard(){
    $("#card > .front")[0].innerHTML = vocab[v_idx];
    $( "#card > .back")[0].innerHTML = vocab[v_idx + 1];

}

/*
$("#vocab").click(displayAndFormatVocabulary);
$("#book").click(displayAndFormatText);
$("#grammar").click(displayAndFormatGrammar);
*/
$(function(){
    updateFlashCard();
    $("#card").flip({
        axis: 'x',
        trigger: 'click',
        reverse: true
    });
    $("#right-arrow").click(function(){
        if(v_idx != null)
            v_idx = (v_idx + 2) >= vocab.length ? 0 : v_idx + 2;
        updateFlashCard();
    });
    $("#left-arrow").click(function(){
        if(v_idx != null){
            v_idx = (v_idx - 2) < 0 ? vocab.length - 2 : v_idx - 2;
        }
        updateFlashCard();
    });

});