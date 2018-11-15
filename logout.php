<?php
    session_start();
    $_SESSION = array();
    session_unset();
    session_destroy();
    header("Location: login.php");
?>
<html>
<head>
</head>
<body>
    <a href="login.php">Click here to login!</a>
</body>
</html>