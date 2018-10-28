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
function getNavDropDown($menuTitle, $submenus, $dividerIndex = 0){
    $text = '<li class="nav-item dropdown">' . "\n";
    $text .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . 
              $menuTitle . "</a>\n";
    $text .= getDropDown($submenus);
    $text.= "</li>\n";
    return $text;
}

function navBar($elements){
?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
    
    
    
    
    
    
    
    
function printHead($title, $styles = array(), $script = array()){
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
"        <script src='js/$script'></script>/n"
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


?>