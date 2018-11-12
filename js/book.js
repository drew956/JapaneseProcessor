var data =  
{
    title: "日本のお風呂",
    pages: [
        {   page: 1,
            text: [
                "日本人は、お風呂が大好きです。",
                "毎日、お風呂に入る人が、多いです。",
                "だから、いつでもお風呂に入りたくなるのです。"
            ]
        },
        {
            page: 2,
            text: [
                "日本には、温泉がたくさんあります。",
                "温泉に入ると、とても気持ちがよくて、体にもいいことを、昔の人は知っていました。",
                "熊や鹿や猿など、動物も温泉に入りました。",
                "「熊の湯」や「鹿の湯」など、動物の名前の温泉が、今もいろいろなところにあります。"
            ]
        },
        {
            page: 3,
            text: [
                "温泉がないところに住んでいる人は、どんなお風呂に入っていたのでしょうか？",
                "昔は、水をたくさん使うことができませんでした。",
                "ですから、昔の人は、「蒸し風呂」に入りました。",
                "「蒸し風呂」は、お湯から出る蒸気を浴びて、体を洗う温泉です。"
            ]
        }
    ]
};

page_n = 0; //page number

function getCurrentPageNumber(){
    return 1;
}

/* needs to also update the page # */
function updateText(){
    html = data.pages[page_n].text.join("");
    document.getElementById("text").innerHTML = html;
    document.getElementById("page_number").innerHTML = "<h3> Page" + (page_n + 1) + " </h3>";
}
function nextPage(){
    page_n = (page_n + 1) % data.pages.length;
    updateText();
}
function priorPage(){
    page_n = (page_n - 1 < 0) ? data.pages.length - 1 : page_n - 1;
    displayAndFormatText();
}
function displayAndFormatText(){
    var html = "";//"<div id='page_number' class='col-12 text-center'><h3>" + data.title +  " </h3></div>\n";

    html += "<p id='text'>\n";
    data.pages.forEach(
        function(elem){
            html += elem.text.join("");
        }
    );
    //html += data[page_n].text.join("");
    html += "</p>\n";

    html += '<div class="col-12 text-right">' +
                '<button id="quiz">Take comprehension quiz</button>' +
            '</div>';
    /*
    html += '<div class="col-6 text-left">' +
                '<span id="left">< </span>' +
            '</div>' +
            '<div class="col-6 text-right">' +
                '<span id="right"> > </span>' +
            '</div>';
    */
    document.getElementById("textBox").innerHTML = html;
    $("#quiz").click(function(){
        document.location = "quiz.php";
    });

}

$(function(){
    displayAndFormatText();
    //$("#right").click(nextPage);
    //$("#left").click(priorPage);    
});
