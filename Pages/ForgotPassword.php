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
                                        
					<label id="password-label" for="password">Temporary Password:</label><br>
					<input type="password" name="temp_password" id="password" placeholder="Insert the password sent by mail"/><br><br>
                                        
					<label id="password-label" for="password">New Password:</label><br>
					<input type="password" name="password" id="password" placeholder="Insert the password"/><br><br>
                                        
                                        <label id="cpassword-label" for="confirm-label">Confirm New Password:</label><br>
					<input type="password" name="cpassword" id="cpassword" placeholder="Re-insert the password"/><br><br>
                                        
					<input type="submit" name="submit" id="submit" value="Login"/>
                                        
                                        <?php
                                            session_start();
                                            if($_SESSION["page"]="Forgot_sendemail.php"){
                                                echo '<script>alert("An email has been sent to your postal address containing the temporary password")</script>';
                                            }
                                            $_SESSION["page"]=basename($_SERVER['PHP_SELF']);
                                            if(isset($_POST['submit'])) {
                                             
                                                if(strlen($_POST['email'])!=0 && strlen($_POST['temp_password'])!=0 && strlen($_POST['cpassword'])!=0){
                                                    include "conDB.php";
                                                    $row = mysqli_fetch_array(mysqli_query($dbconn, " SELECT id_user,email FROM users WHERE email=\"".$_POST['email']."\" AND temporary_password=\"".$_POST['temp_password']."\";"));
                                                   
                                                    if($row!=0){
                                                        
                                                        if(strlen($_POST['password'])>1 && strlen($_POST['password'])<13){
                                                            
                                                            if(!strcmp($_POST['cpassword'], $_POST['password'])){
                                                                mysqli_query($dbconn, "UPDATE users SET password_user = '".$_POST['password']."' WHERE (id_user =".$row["id_user"].");");
                                                                mysqli_query($dbconn, "UPDATE users SET temporary_password = null WHERE (id_user =".$row["id_user"].");");
                                                                header("Location:login.php");
                                                           
                                                            }else
                                                                echo '<script>alert("The password and the confirm password must be the same")</script>';
                                                            
                                                            }else
                                                                echo '<script>alert("The password needs to be between 1 and 12 ")</script>';
                                                            
                                                        }else
                                                            echo '<script>alert("The email or temporary password is incorrect")</script>';
                                                         
                                                    mysqli_close($dbconn); 
                                                    }else
                                                        echo '<script>alert("You need to compile all the text area")</script>';
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