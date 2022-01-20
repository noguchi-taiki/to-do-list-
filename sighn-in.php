<?php
session_start();
$_SESSION["newuser"] = $_POST["newuser"];
$_SESSION["user"] = $_POST["user"];
$_SESSION["mail"] = $_POST["mail"];
$_SESSION["pas"] = $_POST["pas"];


$mode = "certification";
if(isset($_POST["certification"]) && $_POST["certification"]){
    $mode = "certification";
} elseif (isset($_POST["new"]) && $_POST["new"]){
    $mode = "new";
} else{
    $mdoe = "before";
}
 $dbn = "mysql:host=localhost; dbname=todolist; charset=utf8";
 $dbu = "root";
 $dbp = "root";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>signpup</title>
</head>
<?php if($mode == "certification"){ ?>
    
    <body>
    <header>
        <h1 class="logo">.todolist</h1>
    </header>
    <ul class="form">
        <form action="sighn-in.php" method="post">
            <li class="user">  
                <label for="username" class="username">ユーザー名：</label>
                <input type="text" name="user" id="username" class="username" autocomplete="off" placeholder="someone">         
            </li>
            <li class="email">
                <label for="mail" class="mail">アドレス　：</label>
                <input type="text" name="mail" id="mail" class="mail" autocomplete="off" placeholder="info@example.com">
            </li>
            <li class="pas">
                <label for="pasname" class="pasname">パスワード：</label>
                <input type="password" name="pas" id="pasname" class="pasname" autocomplete="off" placeholder="目玉で見れるようにする">
            </li>
            <li class="btns">
                <div class="submit">
                    <input type="submit" value="認証" name="certification">
                </div>
                <div class="submit">
                    <input type="submit" value="新規登録" name="new">
                </div>
            </li>
        </form>
        <?php
    if(isset($_POST["newuser"])){
        $dbh = new PDO($dbn,$dbu,$dbp);
        $sql1 = "create table todolist.$_SESSION[newuser] (tsk varchar(10),piriority varchar(2),time datetime)";
        $stmt1 = $dbh -> prepare($sql1);
        $stmt1 -> execute();

        $sql2 = "insert into user values (:user,:pas,:mail)";
        $stmt2 = $dbh -> prepare($sql2);
        $stmt2 -> bindParam(":user",$_POST["newuser"]);
        $stmt2 -> bindParam(":pas",$_POST["newpas"]);
        $stmt2 -> bindParam(":mail",$_POST["newmail"]);
        $stmt2 -> execute();

        exit;
}elseif(isset($_POST["user"])){
    try{
        $dbh = new PDO($dbn,$dbu,$dbp);
        /*
        オプチャで教えてもらったやつ。
        var_dump($dbh->errorCode());
        var_dump($dbh->errorInfo());
        */
        $sql = ("select * from user where username=:user && mail=:mail ");
        echo($_SESSION["user"]);
        $stmt = $dbh -> prepare($sql);
        $stmt -> bindParam(":user",$_SESSION["user"]);
        $stmt -> bindParam(":mail",$_POST["mail"]);
        $stmt -> execute();
        if($dbrows = $stmt -> fetch()){
            if($dbrows["pasword"] == $_POST["pas"]){
                $mail = $_SESSION["mail"];
                $user = $_SESSION["user"];
                header("Location: index.php?user=$user&mail=$mail");
            } else {
                echo("※パスワードが違います。");
            }
        } else {
            echo("※ユーザ名又はアドレスが違います。");
        }
    } catch(PDOException $e) {
        echo"接続失敗".$e->getMessage();
        exit();
    }
}
?>
    </ul>
</body>
<?php } elseif($mode == "new") { ?>
    <header>
        <h1 class="logo">.todolist</h1>
    </header>
    <ul class="form">
        <form action="sighn-in.php" method="post">
            <li class="user">
                <label for="username" class="username">ユーザー名：</label>
                <input type="text" name="newuser" id="username" class="username" placeholder="someone" value=<?php echo $_SESSION["user"] ?> >
            </li>
            <li class="email">
                <label for="mail" class="mail">アドレス　：</label>
                <input type="text" name="newmail" id="mail" class="mail" placeholder="info@example.com" value=<?php echo $_SESSION["mail"] ?>>
            </li>
            <li class="pas">
                <label for="pasname" class="pasname">パスワード：</label>
                <input type="password" name="newpas" id="pasname" class="pasname" placeholder="※半角英数字" value=<?php echo $_SESSION["pas"] ?>>
            </li>       
            <li class="btns">
                <div class="submit">
                    <input type="submit" value="作成" name="certification">
                </div>
                <div class="reset">
                    <input type="reset" value="リセット">
                </div>
            </li>
        </form>
    </ul>

<?php } ?>

</html>