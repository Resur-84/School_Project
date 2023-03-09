<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8"> <!--use of special and accented character-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--Support Edge new version-->
        <link rel="stylesheet" type="text/css" href="style_normal.css?ts=<?=time()?>&quot">
        <title>Humor Competition - Chat-Bot</title>
    </head>
    <body>
		<header>
        <h1 id="title">Chat-Bot</h1>
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
                    <form id="chat-box" method="POST">
                        <textarea id="chat" name="chat" rows="20" cols="95" readonly >
                    <?php
                            echo $_SESSION["chat"];
                            if(isset($_POST['button-message'])) {
                                echo "<you>\n \t".$_POST['text-message']."\n \n ";
                                $_SESSION["chat"]=$_SESSION["chat"]."<you>\n \t".$_POST['text-message']."\n \n ";
                                include "conDB.php";
                                $row = mysqli_fetch_array(mysqli_query($dbconn, "SELECT text_joke FROM jokes WHERE text_joke like '%".$_POST['text-message']."%' order by rand() limit 1 ;"));
                                if($row!=null && $_POST['text-message']!=""){
                                    $_SESSION["chat"]=$_SESSION["chat"]."<bot>\n \t".$row["text_joke"]."\n \n";
                                    echo "<bot>\n \t".$row["text_joke"]."\n \n";
                                }
                                else{
                                    $_SESSION["chat"]=$_SESSION["chat"]."<bot>\n \tThere is not any joke with the word you write"."\n \n";
                                    echo "<bot>\n \tThere is not any joke with the word you write"."\n \n";
                                    
                                }
                                mysqli_close($dbconn);
                            }
                            
                        ?>
                        </textarea>
                    <div id="chat-bar">
                        <input id="text-message" name="text-message" type="text" placeholder="digit a word">
                        <input type="submit" name="button-message" id="button-message" value="Send">
                    </div>
                    </form>
                    
            </content>
		</main>
		
		<footer>
			<p>&copy;Granata, Nosotti </p>
		</footer>
		
    </body>
</html>

