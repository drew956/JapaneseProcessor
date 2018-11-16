<?php
    header('content-type: text/html; charset=utf-8');
    /* 
        We should probably check $_SESSION['state']
        Regardless, this should get specific types of questions depending on 
        whether we are doing the practice quizzes or the comprehension quizzes.
        SELECT Question.question, Question.type, Question_choice.choice, Question_choice.is_right FROM Question join Question_choice on Question_choice.question_id = Question.id;
        For long-answer the answer in the DB is just for reference, since we cannot be sure of all possible ways of phrasing it.


SELECT Question.id, Question.question, 
       Question.type, Group_Concat(Question_choice.choice SEPARATOR ';') as questions, 
       Question_choice.is_right, Question.Story_id
FROM Question join Question_choice 
on Question_choice.question_id = Question.id
WHERE Question.Story_id = 0 //this here should be the current book id
GROUP BY Question.id;

NOTE:
We will have to restrict it to the current book / story id, otherwise it will pull all questions from all stories
can use the getStateBookId() or whatever function.

example data format expected
qid  = question id
type = text (0) or radio (1)
question = all of the  
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
    }
]
    */
    require_once("LH_Library.php");
    require_once("functions.php");
    
    /* 
        Convenience constants and translation of constants/ids.
    */
    $types = array('text', 'radio');
    $TEXT  = $types[0]; //so  changes will propagate.
    $RADIO = $types[1];
    $DELIMITER = ';';

    connectToDB();
    mysql_set_charset("utf8");

    $Question  = new Table("Question");

    //WHERE Question.Story_id = 0
    $state_data = getStatePhaseBookId();
    $story_id = $state_data['book_id'];

    $questions = $Question->joinSpecific(
        "Question.id, Question.question, Question.type, Group_Concat(Question_choice.choice SEPARATOR ';') as answers, Question_choice.is_right ", 
        "Question_choice", 
        array("Question.id"), 
        array("Question_choice.question_id"),
        "WHERE Question.Story_id = $story_id GROUP BY Question.id"
    );


    for($i = 0; $i < count($questions); $i++){
        //format data so the answers are an array if the type is a radio
        $questions[$i]['type'] = $types[$questions[$i]['type']];
        if($questions[$i]['type'] == $RADIO)
            $questions[$i]['answers'] = explode($DELIMITER, $questions[$i]['answers']);
        //echo "<div style='border: 1px solid red; padding: 10px;'> <p> " . $row['id'] . " " . $row['question'] . " <br />" . $row['choice'] . " (" . $row['is_right'] . ") " . " </p></div>\n";
    }

    echo json_encode( $questions);

    /*
    echo str_replace(",", "<br />",
            json_encode( $questions)
         );
    */
?>