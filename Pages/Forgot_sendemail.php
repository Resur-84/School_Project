<!DOCTYPE html>
<html>
    <head>
	<meta charset="UTF-8"> <!--use of special and accented character-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--Support Edge new version-->
        <link rel="stylesheet" type="text/css" href="style_login_signin.css ?ts=<?=time()?>&quot">
        <title>Humor Competition - Login</title>
    </head>
    <body>
        
		<main>
			<content>
				<h1 id="title"> Forgot Password </h1> 
				
				<form id="form-forgotpassword" method="POST">
					<label id="email-label" for="email">Email:</label><br>
					<input type="email" name="email" id="email" placeholder="Insert the email"/><br><br>
					<input type="submit" name="submit" id="submit" value="Login"/>
                                        
                                        <?php
                                            session_start();
                                            $_SESSION["page"]=basename($_SERVER['PHP_SELF']);
                                            
                                            if(isset($_POST['submit'])) {
                                                
                                                if(strlen($_POST['email'])!=0 ){
                                                   
                                                    include "conDB.php";
                                                    $row = mysqli_fetch_array(mysqli_query($dbconn, "SELECT id_user FROM users WHERE email='".$_POST['email']."';"));
                                                    if($row!=0){  
                                                        do{
                                                            $temp_pass=rand(1000,10000);
                                                            $row1 = mysqli_fetch_array(mysqli_query($dbconn, "SELECT temporary_password FROM users WHERE temporary_password=".$temp_pass." ;"));
                                                        }while($row1!=0);
                                                        $subject = "Humor Competition, attempt to change password";
                                                        $body = "Hi, I'm the admin of the Humor Competition site.\nI wanted to inform you that \"".$temp_pass."\" is the temporary password for changing your password. \nIf you didn't request a password change, delete this email. \n \nThanks for the attention";
                                                        $headers = "From: riccardo.nosotti@galileo.galileicrema.it";
                                                        mail($_POST['email'], $subject, $body, $headers);  
                                                        mysqli_query($dbconn, "UPDATE users SET temporary_password =\"".$temp_pass."\" WHERE (id_user =".$row["id_user"].");");
                                                        header("Location:ForgotPassword.php");
                                                    }else{
                                                        echo '<script>alert("Email does not exist")</script>';
                                                    }
                                                    
                                                    mysqli_close($dbconn);
                                                    
                                                }else{ 
                                                    echo '<script>alert("You need to compile all the text area")</script>';
                                                }
                                                
                                            }
                                        ?>
				</form>
				
			</content>
		</main>
		
		<footer>
			<p>&copy;Granata, Nosotti </p>
		</footer>
            
    </body>
</html>