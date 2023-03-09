<?php
    session_start();
    $_SESSION["email"]=null;
    $_SESSION["teacher"]=null;
    $_SESSION["id_user"]=null;
    $_SESSION["chat"]="\n<bot>\n \tHi, write a word and I will find a joke that matches your word\n \n";
    $_SESSION["page"]=basename($_SERVER['PHP_SELF']);
    header("Location:homepage.php");
    
?>

