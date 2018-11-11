/* 
    The back-end can process the answers easily by using a pre-determined naming convention
    on the front end.
    Such as 
    "qid1"
    "qid2" for the ids of the inputs. 
    
    Actually, we can just use ajax and pass it all the information it needs.
    
    The question is do we want the code to dynamically make the quizzes,
    or do we want hand-crafted quizzes for each book to be stored on the server,
    and to have these loaded via ajax directly into the webpage?
    Then our back-end would already know the answers because the quizzes are specifically 
    intended for that purpose.
    
    The question is do we want the exams to be randomized or to be identical for all participants.

*/
var data =  
[
    {
        qid: 1,
        type: 'text',
        prompt: "Please conjugate the verb in the te form and fill in the blank:",
        question: "ビールを（飲む）、帰りました。",
    },
    {
        qid: 2,
        type: 'radio',
        prompt: "Please choose the best sentence:",
        question: [
            "お風呂を入る人が多いです。",
            "多い人がお風呂に入ります。",
            "お風呂に入る人が多いです。",
            "多い人がお風呂を入ります。"
        ]
    },
    {
        qid: 3,
        type: 'text',
        prompt: "Please conjugate the following adjective in the te form:",
        question: "美味しい"
    },
    {
        qid: 4,
        type: 'text',
        prompt: "Please conjugate the following adjective in the te form:",
        question: "きれい"
    },
    {
        qid: 5,
        type: 'text',
        prompt: "Please conjugate the following adjective in the te form:",
        question: "寒い"
    },
    {
        qid: 6,
        type: 'text',
        prompt: "Please conjugate the following adjective in the te form:",
        question: "暑い"
    },
    {
        qid: 7,
        type: 'radio',
        prompt: "Which one of the following best demonstrates how to properly modify a noun with a verb or adjective?",
        question: [
            "リンゴを食べました人がどこに行きましたか。",
            "美味しいなパンはどこで買いましたか。",
            "リンゴを食べた人がどこに行きましたか。",
            "美味しいのパンはどこで買いましたか。"
        ]
    },
    {
        qid: 8,
        type: 'text',
        prompt: "What is the volitional form of the following verb?",
        question: "行く"
    },
    {
        qid: 9,
        type: 'text',
        prompt: "What is the adverbial form of the following adjective?",
        question: "長い"
    },
    {
        qid: 10,
        type: 'text',
        prompt: "Using the verb なる, how would you say 'becomes hot'?",
        question: ""
    }
];

/* This... idk. This shouldn't be here. 
    I will remove it once I hook up the DB */
function getCurrentPageNumber(){
    return 1;
}

function getGrammarInput(id, type, prompt, question){
    html = "";
    switch(type){
        case "text":
            html = '<div class="form-group">' + "\n" +
                        '<label>' + prompt +  "<br />" + "\n" + question +   
                        '<input type="text" class="form-control" name="' + 'qid' + id + '" placeholder="Enter your answer here">' + "\n" +
                        '</label>' + "\n" +
                    "</div>";
            break;
            
        case "radio":
            html = '<div class="input-group col-12">' + "\n" +
                        '<div class="input-group-text">' + "\n" + 
                            "<label class='text-left'>" + prompt + "<br />" + "\n";
                        
            for(j = 0; j < question.length; j++){
                html += '<input type="radio" name="' + 'qid' + id + '" value="' + j + '" />' + question[j] + '<br />';
            }
            html +=        "</label>\n";
            html +=   "</div>\n" +
                    "</div>\n";
            break;
        default:
            html = 'Something went wrong, that type of question doesn\'t exist.\n';
            break;
    }
    return html;
}

function processAnswers(){
    alert("clicked me");
    //should do something with ajax, or pass the data to a form to parse it
    return false;
}

function generateQuiz(){
    html = $("form[name=quizform]")[0].innerHTML;
    test = [ 
        {
            qid: 2,
            type: 'radio',
            prompt: "Please choose the best sentence:",
            question: [
                "お風呂を入る人が多いです。",
                "多い人がお風呂に入ります。",
                "お風呂に入る人が多いです。",
                "多い人がお風呂を入ります。"
            ]
        }
    ];
    //html += getGrammarInput(test[0].qid, test[0].type, test[0].prompt, test[0].question);
    
    for(i = 0; i < data.length; i++){
        html += getGrammarInput(data[i].qid, data[i].type, data[i].prompt, data[i].question);
    }
    
    html += "<button type='button' name='submit' onclick='processAnswers();' class='btn btn-primary'>" +  "Submit</button>\n";
    $("form[name=quizform]")[0].innerHTML = html;
}

/* 
    For now we are not going to call this, because it should already be a quiz.
    
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
    generateQuiz();
});