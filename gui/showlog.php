<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アクセスログ</title>
    <style>
        a.sb{
            background-color:skyblue;
            color:black;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2>アクセスログ</h2>
    <a class="sb" href="showlog.php">全て</a>
    <a class="sb" href="showlog.php?q=toji">今時間</a>
    <a class="sb" href="showlog.php?q=today">今日</a>
    <a class="sb" href="showlog.php?q=tomon">今月</a>
    <a class="sb" href="showlog.php?q=toyear">今年</a>
    <a class="sb" href="showlog.php?q=yestji">昨時間</a>
    <a class="sb" href="showlog.php?q=yestday">昨日</a>
    <a class="sb" href="showlog.php?q=yestmon">昨月</a>
    <a class="sb" href="showlog.php?q=yestyear">昨年</a>
    <?php
    require "../libs/accesssql.php";
    $res = accesssql("SELECT * FROM log");
    if($res == null){
        echo("<p>データベースにアクセスできませーん</p>");
        echo("<p>データベースの設定とか確認してね～(w)</p>");
        exit;
    }
    echo "<p>今は: " . date("Y/m/d/H/i/s");
    //Generate table
    echo("<table border=\"1\">");
    echo("<tr><th>ユーザー</th><th>日時(年/月/日/時/分/秒)</th><th>URL</th></tr>");
    //$row[0]:User $row[1]:url $row[2]:day
    $len = 0;
    $_now = explode("/",date("Y/m/d/H/i/s"));
    while($row = $res->fetch_array(MYSQLI_NUM)){
        $len += 1;
        if(isset($_GET["q"])){
            $_spl = explode("/",$row[2]);
            //0:year 1:month 2:day 3:time/ZI 4:time/Fun 5:time/Byou
            switch($_GET["q"]){
                case "toji":
                    if($_now[0] == $_spl[0]){
                        if($_now[1] == $_spl[1]){
                            if($_now[2] == $_spl[2]){
                                if($_now[3] == $_spl[3]){
                                    goto nxt;
                                }
                            }
                        }
                    }
                    break;
                case "today":
                    if($_now[0] == $_spl[0]){
                        if($_now[1] == $_spl[1]){
                            if($_now[2] == $_spl[2]){
                                goto nxt;
                            }
                        }
                    }
                    break;
                case "tomon":
                    if($_now[0] == $_spl[0]){
                        if($_now[1] == $_spl[1]){
                            goto nxt;
                        }
                    }
                    break;
                case "toyear":
                    if($_now[0] == $_spl[0]){
                        goto nxt;
                    }
                    break;


                    
                case "yestji":
                    if($_now[0] == $_spl[0]){
                        if($_now[1] == $_spl[1]){
                            if($_now[2] == $_spl[2]){
                                if($_now[3] == $_spl[3] + 1){
                                    goto nxt;
                                }
                            }
                        }
                    }
                    break;
                case "yestday":
                    if($_now[0] == $_spl[0]){
                        if($_now[1] == $_spl[1]){
                            if($_now[2] == $_spl[2] + 1){
                                goto nxt;
                            }
                        }
                    }
                    break;
                case "yestmon":
                    if($_now[0] == $_spl[0]){
                        if($_now[1] == $_spl[1] + 1){
                            goto nxt;
                        }
                    }
                    break;
                case "yestyear":
                    if($_now[0] == $_spl[0] + 1){
                        goto nxt;
                    }
                    break;
            }
            continue;
        }
        nxt:
        echo("<tr>");
        echo("<td>" . $row[0] . "</td>");
        echo("<td>" . $row[2] . "</td>");
        echo("<td><a target=\"_blank\" href=\"" . $row[1] . "\">" . $row[1] . "</a></td>");
        echo("</tr>");
    }
    echo("</table>");
    echo "<p>全てのアクセスログは" . $len . "つ";
    ?>
    <form action="/edit/alldel.php" method="post">
        <?php
        $org1 = rand(2,10); //√4~100
        $org2 = rand(0,10); //0~10^2
        echo "<input type=\"hidden\" name=\"oo\" value=\"" . $org1 . "\">";
        echo "<input type=\"hidden\" name=\"ot\" value=\"" . $org2 . "\">";

        echo "√" . ((String)($org1 * $org1)) . "は<input type=\"number\" name=\"ao\"><br>";

        echo ((String)$org2) . "^2は<input type=\"number\" name=\"at\">";
        ?>
        <br><input type="submit" value="全て削除">
    </form>
</body>
</html>
