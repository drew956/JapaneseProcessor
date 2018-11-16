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
        id: 1,
        type: 'radio',
        question: "How long will this page take to load?",
        answers: [
            "A few minutes.",
            "An hour.",
            "It'll never load.",
            "Trick question: it's already loaded."
        ]
    }
];

function getGrammarInput(id, type, question, answers){
    html = "";
    switch(type){
        case "text":
            html = '<div class="form-group">' + "\n" +
                        '<label>' + "Please answer the following question." +  "<br />" + "\n" + question +   
                        '<input type="text" class="form-control" name="' + 'qid' + id + '" placeholder="Enter your answer here">' + "\n" +
                        '</label>' + "\n" +
                    "</div>";
            break;
            
        case "radio":
            html = '<div class="input-group col-12">' + "\n" +
                        '<div class="input-group-text">' + "\n" + 
                            "<label class='text-left'>" + question + "<br />" + "\n";
                        
            for(j = 0; j < answers.length; j++){
                html += '<input type="radio" name="' + 'qid' + id + '" value="' + j + '" />' + answers[j] + '<br />';
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
    return false;
}

function generateQuiz(){
    html = $("form[name=quizform]")[0].innerHTML; //this is probably unnecessary and unwanted.

    for(i = 0; i < data.length; i++){
        html += getGrammarInput(data[i].id, data[i].type, data[i].question, data[i].answers);
    }
    
    html += "<button type='button' name='submit' onclick='processAnswers();' class='btn btn-primary'>" +  "Submit</button>\n";
    $("form[name=quizform]")[0].innerHTML = html;
}


$(function(){
    //generateQuiz(); //to prevent default page from being jarring.
    //actually... that is more jarring,
    $.ajax({
        url: "get_questions.php",
    })
    .done(function( dbdata ) {
        data = JSON.parse(dbdata);
        generateQuiz(); //generates the quiz once the data is loaded. Should make sure base page isn't too ugly, maybe add a "Please wait" message or something.
    });
});