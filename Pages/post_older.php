<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8"> <!--use of special and accented character-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--Support Edge new version-->
        <link rel="stylesheet" type="text/css" href="style_normal.css?ts=<?=time()?>&quot">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Font Star -->
        <title>Humor Competition - Post</title>
    </head>
    <body>
		<header>
        <h1 id="title">Post from Older</h1>
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
                            <form method="post">
			<div id="jokes-container">
                    <div class="joke-box">
                    <?php
                        include "conDB.php";
                        $star=0;
                        $pos=0;
                        $result=mysqli_query($dbconn, "SELECT j.id_joke,email , title, text_joke,CAST(AVG(vote)as decimal (10,1)) as avg FROM users u inner join (jokes j left join votes v on j.id_joke=v.id_joke) on u.id_user=j.id_user where shows=true group by email order by created_at limit 6;");
                        while ($row = mysqli_fetch_array($result) ) {
                            echo'<form method="post"  action="vote.php">';
                            if($row['avg']=="")
                                $row['avg']="- ";
                            echo "
                                <table>
                                    <tr>
                                        <th class=\"title_joke\">".$row['title']."</th> 
                                    </tr>
                                    <tr>
                                        <td class=\"author_joke\">".$row['email']."</td>
                                    </tr>
                                    <tr>
                                        <td class=\"joke\">".$row['text_joke']."</td>
                                    </tr>
                                    <tr class=\"last-row\">                                
                                        <td>
                                            <div class=\"star_rating_".$pos."\">
                                                <p id=\"rating_number_".$pos."\" class=\"rating_number_edit\">".$row['avg']."/5</p>";   
                                                $row1=mysqli_fetch_array(mysqli_query($dbconn, "SELECT id_joke from votes WHERE id_joke=\"".$row["id_joke"]."\" AND id_user=\"".$_SESSION["id_user"]."\";"));        
                                                if($row['email']!=$_SESSION["email"] && $_SESSION["email"]!=null && $row1==0 ){
                                                for($button=5;$button>0;$button--){
                                                echo "<input type=\"submit\" name=\"star".$button+$star."\" id=\"star".$button+$star."\">
                                                <label for=\"star".$button+$star."\"></label>";
                                                }
                                                echo "<input type=\"hidden\" name=\"idJ".$pos."\" value=\"".$row["id_joke"]."\">";
                                                }
                                                else
                                                    echo "</br></br>"; 
                                            echo"</div>
                                        </td>
                                    </tr>
                                </table>";
                            echo '</form> ';
                            $star+=10;
                            if(($pos+1)%2==0)
                                echo"</div><br><div class=\"joke-box\">";
                            $button=0;
                            $pos++;
                        }
                        mysqli_close($dbconn);
                        ?>  
                        
                                          
                    </div>                                        
                </div>
                </form>>
            </content>
		</main>
		
		<footer>
			<p>&copy;Granata, Nosotti </p>
		</footer>
		
    </body>
</html>

