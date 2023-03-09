<?php
    session_start();
    include "conDB.php";
        for($star=0;$star<10;$star++){
            for($button=5;$button>0;$button--){
                //echo $star+$button;
                if(isset($_POST["star".$button+($star*10)]) ) {
                        //echo $_POST["idJ".$star].":".$_SESSION["id_user"].":".$button;
                        $result=mysqli_fetch_array(mysqli_query($dbconn, "select  id_joke from votes where  id_user=\"".$_SESSION["id_user"]."\" and id_joke=\"".$_POST["idJ".$star]."\";"));
                        if($result==null){
                        mysqli_query($dbconn, "INSERT INTO votes VALUES ('".$_POST["idJ".$star]."', '".$_SESSION["id_user"]."', '".$button."');"); 
                        mysqli_close($dbconn);
                        }
                        
                }
            }
        }
   header("Location:".$_SESSION["page"]);
?>