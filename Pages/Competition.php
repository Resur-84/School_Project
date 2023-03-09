<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8"> <!--use of special and accented character-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--Support Edge new version-->
        <link rel="stylesheet" type="text/css" href="style_normal.css?ts=<?=time()?>&quot">
        <title>Humor Competition - Competition</title>
        <script>
            function checkTitle(s,output){
                output.innerHTML="a";
                if(s.length>0 && s.length<20 )
                    output.innerHTML=" ";					
                        else
                    output.innerHTML="*";
            }
            function checkText(s,output){
                if(s.length>0 && s.length<250 )
                    output.innerHTML=" ";					
                        else
                    output.innerHTML="*";
            }
        
        
        
        </script>
    </head>
    <body>
		<header>
        <h1 id="title">Competition</h1>
        <h4 class="logsign">
            <?php
            session_start();
            $_SESSION["page"]=basename($_SERVER['PHP_SELF']);
            if($_SESSION["email"]!=null && $_SESSION["teacher"]!=null ){
                if($_SESSION["email"]=="true.admin@galileo.galileicrema.it")
                    echo "<a  id=\"lg\" href=\"admin_page.php\" style=\"text-align: right;\">".$_SESSION["email"]."</a> | <a id=\"si\" href=\"index.php\" style=\"width:116px\">Exit</a>"; 
                else 
                    echo "<font  id=\"lg\" style=\"text-align: right;\">".$_SESSION["email"]."</font> | <a id=\"si\" href=\"index.php\" style=\"width:116px\">Exit</a>";
            }
            else 
                echo"<a id=\"lg\" href=\"login.php\" style=\"text-align: right;\">Log in</a> | <a id=\"si\" href=\"signin.php\" style=\"width:116px\">Sign in</a>";
            ?>
        </h4>
        <nav id="drop-menu">
            <ul id="menu">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">Post</a>
                    <ul id="submenu">
                        <li><a href="post_recent.php" style="width:116px">Most Recent</a></li>
                        <li><a href="post_upvoted.php" style="width:116px">Most Upvoted</a></li>
                        <li><a href="post_older.php" style="width:116px">Older jokes</a></li>
                    </ul>
                </li>
                <li><a href="chat-bot.php" style="width:116px">Chat-bot</a></li>
                <li><a href="competition.php" style="width:116px">Competition</a></li>
            </ul>
        </nav>
		</header>
		
		<main>
			<content>
				<form id="form-competition"  method="POST">
					
					<br>
					<label class="mini-title">Digit your own joke</label>
					<br><br>
					
					<label>Title of the joke</label> <font id="t"  color="red"></font>
					<br>
					<input type="text" id="write-title" name="write-title" placeholder="Write here the title" onblur="checkTitle(document.getElementById('write-title').value,document.getElementById('t'))"/>
					<br><br>
					
					<label>Digit here your joke</label> <font id="t2" color="red"></font>
					<br>
					<textarea id="write-joke" name="write-joke" rows="10" cols="70" placeholder="Write here the joke" onblur="checkTitle(document.getElementById('write-joke').value,document.getElementById('t2'))"></textarea>
					<br><br>
					
                                        <label id="message">Jokes about insult a specific person, gender, race or religious will be delete</label>
					<br>
					IRONY->YES<span id="spaceb"></span>INSULT->NO
					<br><br>
					<input type="submit" name="submit" id="submit" value="Send"><br>
						
				</form>
				<?php
                
                                    if(isset($_POST['submit']) && strlen($_POST['write-title'])<=20 && !empty($_POST["write-title"]) && strlen($_POST['write-joke'])<=250 && !empty($_POST['write-joke']) ) {
                                        if($_SESSION["email"]!=null && $_SESSION["teacher"]!=null){
                                            if($_SESSION["teacher"]==false){
                                                include "conDB.php";
                                                $row1 = mysqli_fetch_array(mysqli_query($dbconn, "SELECT u.id_user , title FROM users u left join jokes j on u.id_user=j.id_user where teacher=0 AND title is null and email=\"".$_SESSION["email"]."\";" ));
                                                if($row1!=null){
                                                    $row = mysqli_fetch_array(mysqli_query($dbconn, "SELECT max(id_joke)+1 as max FROM jokes;" ));
                                                    mysqli_query($dbconn, "INSERT INTO jokes (id_joke, id_user, title, text_joke,shows) VALUES (".$row['max'].",".$row1['id_user'].",'".$_POST["write-title"]."','".$_POST["write-joke"]."',0);" );
                                                    mysqli_close($dbconn);
                                                    header("Location:homepage.php");
                                                }
                                                else {echo "<script>alert(\"You have already posted a joke\")</script>";}
                                            }
                                            else {echo "<script>alert(\"Teachers cannot post jokes\")</script>";}
                                        }
                                        else {echo '<script>alert("You must log in")</script>';}
                                    }
                                    else{}
                                ?>
			</content>
                    
		</main>
		
		<footer>
			<p>&copy;Granata, Nosotti </p>
		</footer>
		
    </body>
</html>

