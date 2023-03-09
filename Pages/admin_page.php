<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8"> <!--use of special and accented character-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--Support Edge new version-->
        <link rel="stylesheet" type="text/css" href="style_normal.css?ts=<?=time()?>&quot">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Font Star -->
        <title>Humor Competition - Admin</title>
    </head>
    <body>
		<header>
        <h1 id="title">Admin page</h1>
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
                <form method="post" action="sendMail.php">
		<div id="jokes-container">
                    <div class="joke-box">
                    <?php
                        
                        $pos=1;
                        if($_SESSION["email"]!="true.admin@galileo.galileicrema.it"){
                            header("Location:homepage.php");
                        }
                        include "conDB.php"; 
                        $result=mysqli_query($dbconn, "SELECT email ,j.id_joke as id_joke , title, text_joke FROM users u inner join jokes j on u.id_user=j.id_user where shows=false order by created_at limit 10;");
                        while ($row = mysqli_fetch_array($result) ) {
                            echo "
                                <table>
                                    <tr>
                                        <th class=\"title_joke\" >".$row['title']."</th> 
                                    </tr>
                                    <tr>
                                        <td class=\"author_joke\" id\"".$row['id_joke']."\">".$row['email']."</td>
                                    </tr>
                                    <tr>
                                        <td class=\"joke\">".$row['text_joke']."</td>
                                    </tr>
                                    <tr class=\"last-row\"> 
                                        <td>
                                            <input type=\"hidden\" name=\"userJ".$pos."\"value=\"".$row['email']."\">
                                            <input type=\"hidden\" name=\"idJ".$pos."\"value=\"".$row["id_joke"]."\">
                                            <input type=\"submit\" name=\"accept".$pos."\" id=\"acc-ref\" value=\"Accept\">
                                            <input type=\"submit\" name=\"refuse".$pos."\" id=\"acc-ref\" value=\"Refuse\">";
                            
                            
                                        
                                            
                                        echo"</td>
                                    </tr>
                                    
                                </table>";     
                            if($pos%2==0)
                                echo"</div><br><div class=\"joke-box\">";
                            
                            $pos++;
                        }
            
                mysqli_close($dbconn);
                    ?>
                                          
                    </div>                                        
                </div>
            </form>
            </content>
		</main>	
		<footer>
			<p>&copy;Granata, Nosotti </p>
		</footer>
    </body>
</html>