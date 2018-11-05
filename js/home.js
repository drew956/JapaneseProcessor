/* 
    11-5-2018
    
    I guess the question is how we want to handle this?
    We could just have the button be part of a form
    that the php changes the target of when creating the taskbox.
    
    <form id="task-form" target="review.php">
        <button type="submit">Continue</button>
    </form>
*/
$( document ).ready(function() {
    $("#task-button").click(
        function(){
            //document.location = "books.php";
            //alert("hello you clicked me!");
        }
    );
});