<?php
    include "conDB.php"; 
    for($pos=1;$pos<11;$pos++){
        if(isset($_POST["accept".$pos])){
            $subject = "Humor Competition, joke accepted";
            $body = "Hi,I'm the admin of the Humor Competition site.\nI wanted to inform you that your joke was accepted \n \nThanks for the attention";
            $headers = "From: riccardo.nosotti@galileo.galileicrema.it";
            mail($_POST["userJ".$pos], $subject, $body, $headers);    
            mysqli_query($dbconn, "UPDATE jokes SET shows = 1 WHERE (id_joke =".$_POST["idJ".$pos].");");
            //echo $_POST["idJ".$pos];
            header("Location:admin_page.php");      
        }
        if(isset($_POST["refuse".$pos])){
            $subject = "Humor Competition, joke rejected";
            $body = "Hi,I'm the admin of the Humor Competition site.\nI wanted to inform you that your joke was rejected because it did not respect the policies of our site.\nIf you want, you can post a new joke.\n \nThanks for the attention";
            $headers = "From: riccardo.nosotti@galileo.galileicrema.it";
            mail($_POST["userJ".$pos], $subject, $body, $headers);    
            mysqli_query($dbconn, "DELETE FROM jokes WHERE (id_joke =".$_POST["idJ".$pos]." );");
            //echo $_POST["idJ".$pos];
            header("Location:admin_page.php");
            }
    }

?>
