<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8"> <!--use of special and accented character-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--Support Edge new version-->
        <link rel="stylesheet" type="text/css" href="style_login_signin.css ?ts=<?=time()?>&quot">
        <title>Humor Competition - Sign in</title>
    </head>
	<body>
		<main>
			<content>
				<h1 id="title"> Sign in </h1> 
				
				<form id="form-signin" method="POST">
					<label id="email-label" for="email">Email:</label><br>
					<input type="email" name="email" id="email" placeholder="Insert the email"/><br><br>
					
					<label id="password-label" for="password">Password:</label><br>
					<input type="password" name="password" id="password" placeholder="Insert the password"/><br><br>
					
					<label id="cpassword-label" for="confirm-label">Confirm Password:</label><br>
					<input type="password" name="cpassword" id="cpassword" placeholder="Re-insert the password"/><br><br>
					
                                        <input type="radio" id="Student" name="type_user" value="Student" checked="checked">
                                        <label for="Student">Student</label>
                                        
                                        <input type="radio" id="Teacher" name="type_user" value="Teacher">
                                        <label for="Teacher">Teacher</label><br><br>
                                        
                                        <label for="Error" name="error"> </label>
                                        
					<input type="submit" name="submit" id="submit" value="Create"/>
                                       
                                        <?php
                                            session_start();
                                            $_SESSION["page"]=basename($_SERVER['PHP_SELF']);
                                            if(isset($_POST['submit'])) {
                                            
                                                if(strlen($_POST['email'])==0 || strlen($_POST['password'])==0 || strlen($_POST['cpassword'])==0){
                                                    echo '<script>alert("You need to compile all the text area")</script>';
                                                }
                                                else{
                                                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)==false){
                                                        echo '<script>alert("Invalid email")</script>';
                                                    }
                                                    else{
                                                        $allowed=['galileo.galileicrema.it','aeffl.pt'];
                                                        $parts=explode('@',$_POST['email']);
                                                        $domin=array_pop($parts);
                                                        if(!in_array($domin, $allowed)){
                                                            echo '<script>alert("You must use the school email")</script>';
                                                        }
                                                        else{
                                                        if(empty($_POST['password'])){
                                                            echo '<script>alert("You need to insert a password")</script>';
                                                        }
                                                        else{
                                                            if(strlen($_POST['password'])>13){
                                                                echo '<script>alert("The password is too long (max 12)")</script>';
                                                            }
                                                            else{
                                                                if(strcmp($_POST['cpassword'], $_POST['password'])!=0){
                                                                    //echo strcmp($cp, $p);
                                                                    echo '<script>alert("Error confirm password")</script>';
                                                                }
                                                                else{
                                                                    include "conDB.php";
                                                                
                                                                    $result=mysqli_query($dbconn, "SELECT email, password_user FROM users WHERE email='".$_POST['email']."';");
                                                                    $row = mysqli_fetch_array($result);
                                                                
                                                                    if($row==0){
                                                                        if($_POST['type_user']=="Teacher")
                                                                            $type=1;
                                                                        else
                                                                            $type=0;
                                                                        $row = mysqli_fetch_array(mysqli_query($dbconn, "SELECT max(id_user)+1 as max FROM users;" ));
                                                                        mysqli_query($dbconn, "INSERT INTO users VALUES ('".$row['max']."', '".$_POST['email']."', '".$_POST['password']."','".$type."', null);");
                                                                        
                                                                        
                                                                        header("Location:homepage.php");
                                                                    
                                                                    }else{
                                                                        echo '<script>alert("This email is already taken")</script>';
                                                                    }
                                                                    mysqli_close($dbconn);
                                                                }
                                                            }
                                                        }
                                                    }
                                                    }
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