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
				<h1 id="title"> Login </h1> 
				
				<form id="form-login" method="POST">
					<label id="email-label" for="email">Email:</label><br>
					<input type="email" name="email" id="email" placeholder="Insert the email"/><br><br>
					
					<label id="password-label" for="password">Password:</label><br>
					<input type="password" name="password" id="password" placeholder="Insert the password"/><br><br>
					
					<a href="signin.php">Don't you have an account? Make it</a><br><br>
                                        <a href="Forgot_sendemail.php">Did you forget your password? Recover it</a><br><br>
                                        <?php
                                            session_start();
                                            $_SESSION["page"]=basename($_SERVER['PHP_SELF']);
                                            if(isset($_POST['submit'])) {
                                                if(strlen($_POST['email'])!=0 && strlen($_POST['password'])!=0){
                                                   
                                                    include "conDB.php";
                                                    $row = mysqli_fetch_array(mysqli_query($dbconn, "SELECT id_user,email, password_user, teacher FROM users WHERE email='".$_POST['email']."'AND password_user='".$_POST['password']."';"));
                                                    
                                                    if($row!=0){
                                                        $_SESSION["email"]=$row["email"];
                                                        $_SESSION["teacher"]=$row["teacher"];
                                                        $_SESSION["id_user"]=$row["id_user"];
                                                        
                                                        header("Location:homepage.php");
                                                    }else{
                                                        echo '<script>alert("Error in email or password")</script>';
                                                    }
                                                    mysqli_close($dbconn);
                                                }else{
                                                    echo '<script>alert("You need to compile all the text area")</script>';
                                                }
                                            }
                                        ?>
                                        
					<input type="submit" name="submit" id="submit" value="Login"/>
				</form>
				
			</content>
		</main>
		
		<footer>
			<p>&copy;Granata, Nosotti </p>
		</footer>
            
    </body>
</html>