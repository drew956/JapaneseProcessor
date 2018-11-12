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
        prompt: "Please answer the following question.",
        question: "What is an 温泉?",
    },
    {
        qid: 2,
        type: 'radio',
        prompt: "According to the story, what did people long ago know about 温泉?",
        question: [
            "温泉 are naturally occurring hot springs.",
            "温泉 are good-feeling and are good for your health.",
            "温泉 are unique to Japan.",
            "温泉 are dangerous to stay in for too long."
        ]
    },
    {
        qid: 3,
        type: 'radio',
        prompt: "Are humans the only ones who like to bathe in 温泉?",
        question: [
            "Yes they are.",
            "No they are not."
        ]
    },
    {
        qid: 4,
        type: 'text',
        prompt: "Please answer the following question.",
        question: "What other creatures like to bathe in 温泉?"
    },
    {
        qid: 5,
        type: 'text',
        prompt: "Please answer the following question.",
        question: "What is a 蒸し風呂?"
    },
    {
        qid: 6,
        type: 'text',
        prompt: "Please answer the following question.",
        question: "How do you use a 蒸し風呂?"
    },
    {
        qid: 7,
        type: 'radio',
        prompt: "Why did people long ago use 蒸し風呂?",
        question: [
            "They realized it would prevent wrinkles.",
            "They wanted to invent new ways of bathing.",
            "They could not use a lot of water like we can today.",
            "They did not like 温泉."
        ]
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