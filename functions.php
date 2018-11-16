<?php
    /* 
        Functions that will help customize / make the site more flexible
        
    */

function getNavLink($text, $href = "#", $class=""){
    return "<li class='nav-item $class'>
                <a class='nav-link' href='$href'>$text</a>
            </li>";
}
function getDropDown($submenus){
    $text = '<div class="dropdown-menu" aria-labelledby="navbarDropdown">' . "\n";
    
    foreach($submenus as $submenu => $href){
        $text .= "    <a class='dropdown-item' href='$href'>$submenu</a>\n";
    }
    $text .= "</div>\n";
    return $text;
}
/* 
    Class is used to make the menu "active". (i.e. to show that it is highlighted)
*/
function getNavDropDown($menuTitle, $submenus, $class = "" ,$dividerIndex = 0){
    $text = "<li class=\"nav-item dropdown $class\">" . "\n";
    $text .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . 
              $menuTitle . "</a>\n";
    $text .= getDropDown($submenus);
    $text.= "</li>\n";
    return $text;
}

function navBar($elements){
?>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
<?php
    foreach( $elements as $element){
        print($element);
    }
?>
                    
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
<?php
}
    
    
    
/*
    0 - prelearning
    1 - engaging the text
    2 - comprehension quiz, etc 

    The blacklist are just the list of possible ones minus the current one.
    So probably there is a better way of coding this. 
    Oh well, this is customizable. 
*/



function redirected($location, $html = "<html><body><a href='home.php'>Click me!</a></body></html>"){
    header("Location: $location");
    echo $html;
    //if doesn't listen to headers
    die();
}

/*
    Not the most elegant solution... 
    but if we let this run on login.php we get infinite redirects.
*/    
function gateway(){
    //would have to use global keyword, so I'd rather include it here for now.
    //this isn't a very good idea though.
    $black_list = array(
        0 => array(
            "quiz.php",
            "book.php"
        ),
        1 => array(
            "overview.php",
            "quiz.php",
        ),
        2 => array(
            "overview.php",
            "book.php",        
        )
    );
    $page_name = basename($_SERVER['PHP_SELF']);
    $data = getStatePhaseBookId();
    
    if(!isset($_SESSION['username']) && $page_name != 'login.php' ){
        redirected("login.php");
    }

    if(in_array($page_name, $black_list[$data["state"]])){
        redirected("home.php");        
    }
    
}    
    

function printHead($title, $styles = array(), $scripts = array()){
gateway();
?>
<!Doctype html>
<html lang=en>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo $title ?></title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
        
        <!-- Scripts -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        
        <!-- Custom styles -->
<?php
foreach($styles as $style){
print(
"        <link rel='stylesheet' href='css/$style' type='text/css' />\n"
);
}    
?>
       <!-- Custom scripts -->
<?php
foreach($scripts as $script){
print(
"        <script src='js/$script'></script>\n"
);
} 
?>
    </head>
    <body>    
    
<?php    
}

function printFoot(){
print(
"    </body>
</html>"
);
}










function printCarousel($images){
print <<<END
<div id="carousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
END;
if(count($images) >= 2){
    echo '<div class="carousel-item active text-center">' . "\n" .
           "    <img class=' img-responsive center-block' src='images/$images[0]' alt='$images[1]'>\n" .
         "</div>\n";
}
for($i = 2; $i < count($images) - 1; $i += 2){
    echo '<div class="carousel-item text-center">' . "\n" .
           "    <img class='img-fluid' src='images/" . $images[$i] . "' alt='" . $images[$i+1] . "'>\n" .
         "</div>\n";
    echo <<<END
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
END;
}

}





function getStatePhaseBookId(){
    $state   = $_SESSION['state'];
    $phase   = $state % 3; //phase starts at 1 so oddly goes 1 2 0, should have phase start at 0..
    $book_id = floor($state/3);
    
    //return array("state" => $state, "phase" => $phase, "book_id" => $book_id);
    return array("state" => $phase, "book_id" => $book_id); //this is what we really mean by "state"
}
/* 
    For the purpose of this website the navbar will be static.
    I.e. it will not suddenly have new items in it just because you are on a different page.
    Thus, although I dislike doing it, I will put the layout of the navbar in here.
    (by layout I mean the variables specifying where everything is)
    
    NOTICE this function uses "active", which is the name of the item in the navbar to highlight
*/
function setUpNavBar($active){
    $content = array("Home" => "home.php");
    
    //the idea is that there are 3 main states across a few texts.
    //thus %3 we get which phase they are in, and without mod 3 we get which text
    $data = getStatePhaseBookId();
    switch($data['state']){
        case 0:
            $content["Study"] = array(
                "Overview"   => "overview.php?id=$book_id", //${_SESSION['current_book']}",            
                "Vocabulary" => "vocabulary.php",
                "Grammar"    => "grammar.php"
            );
            break;
        case 1:
            $content["Read"] = "book.php";
            break;
        case 2:
            $content["Quiz"] = "quiz.php";
            break;
    }
    
    $title   = isset($_SESSION['username']) ? $_SESSION['username'] : "Login";
    $submenu = isset($_SESSION['username']) ? array(
            "Activity"   => "activity.php",
            "Profile"    => "profile.php" , 
            "Logout"     => "logout.php"   ) : "login.php";
    
    $content[$title] = $submenu;

    $elements = array();
    foreach($content as $name => $href){
        if(gettype($href) == "array"){ //if it is a dropdown
            if($name == $active)
                $elements[] = getNavDropDown($name, $href, "active");
            else
                $elements[] = getNavDropDown($name, $href);
        }else{
            if($name == $active)
                $elements[] = getNavLink($name, $href, "active");
            else
                $elements[] = getNavLink($name, $href);
        }
    }
    navBar($elements);
}

function getTaskUrl(){
    $data = getStatePhaseBookId();
    $url = "";
    switch($data["state"]){
        case 0:
            $url = "overview.php";
            break;
        case 1:
            $url = "book.php?id=" . $data['book_id']; 
            break;
        case 2:
            $url = "quiz.php";
            break;
        default:
            $url = "http://www.google.com";
            break;            
    }
    return $url;
}
/* 
    How are we going to handle the javascript hmmm.
*/
function createTaskBox(){
    $data = getStatePhaseBookId();
    $msg = "";                        
    switch($data["state"]){
        case 0:
            $msg = "<p>Welcome to week 1 of the study. Please continue to review the vocabulary and grammar.</p>";
            break;
        case 1:
            $msg = "<p>Welcome to week 1 of the study. Please continue reading the text. You can take the quiz "
            . "whenever you are ready.</p>";
            break;
        case 2:
            $msg = "<p>Welcome to week 1 of the study. Please continue to the comprehension quiz.</p>";
            break;
        default:
            $msg = "default message. Shouldn't be seen normally. (or, like, ever.)\n";                        
            break;            
    }
?>
<div class="task-box">
<?php
    echo $msg . "\n";
?>
    <a href="<?php echo getTaskUrl(); ?>" ><button type="button" id="task-button">Continue</button></a>
</div>
<?php
}



/*
    Class created by:  linblow at hotmail dot fr
    Use the static method getInstance to get the object.
*/

class Session
{
    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;
    
    // The state of the session
    private $sessionState = self::SESSION_NOT_STARTED;
    
    // THE only instance of the class
    private static $instance;
    
    
    private function __construct() {}
    
    
    /**
    *    Returns THE instance of 'Session'.
    *    The session is automatically initialized if it wasn't.
    *    
    *    @return    object
    **/
    
    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self;
        }
        
        self::$instance->startSession();
        
        return self::$instance;
    }
    
    
    /**
    *    (Re)starts the session.
    *    
    *    @return    bool    TRUE if the session has been initialized, else FALSE.
    **/
    
    public function startSession()
    {
        if ( $this->sessionState == self::SESSION_NOT_STARTED )
        {
            $this->sessionState = session_start();
        }
        
        return $this->sessionState;
    }
    
    
    /**
    *    Stores datas in the session.
    *    Example: $instance->foo = 'bar';
    *    
    *    @param    name    Name of the datas.
    *    @param    value    Your datas.
    *    @return    void
    **/
    
    public function __set( $name , $value )
    {
        $_SESSION[$name] = $value;
    }
    
    
    /**
    *    Gets datas from the session.
    *    Example: echo $instance->foo;
    *    
    *    @param    name    Name of the datas to get.
    *    @return    mixed    Datas stored in session.
    **/
    
    public function __get( $name )
    {
        if ( isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }
    
    
    public function __isset( $name )
    {
        return isset($_SESSION[$name]);
    }
    
    
    public function __unset( $name )
    {
        unset( $_SESSION[$name] );
    }
    
    
    /**
    *    Destroys the current session.
    *    
    *    @return    bool    TRUE is session has been deleted, else FALSE.
    **/
    
    public function destroy()
    {
        if ( $this->sessionState == self::SESSION_STARTED )
        {
            $this->sessionState = !session_destroy();
            unset( $_SESSION );
            
            return !$this->sessionState;
        }
        
        return FALSE;
    }
}


/*
    Putting this here so I don't have to change it in all the pages once it goes live.
    
*/
function connectToDB(){
    $conn = connectDB("localhost", "root", "root", "mydb");
    if(!$conn)
        die("noooo\n");

}



//bad form, but makes it convenient
session_start();
?>