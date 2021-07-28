<?php

$mode = "certification";
if(isset($_POST["certification"]) && $_POST["certification"]){
    $mode = "certification";
} elseif (isset($_POST["new"]) && $_POST["new"]){
    $mode = "new";
} else{
    $mdoe = "before";
}
 session_start();
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
                <input type="text" name="user" id="username" class="username" placeholder="someone">         
            </li>
            <li class="email">
                <label for="mail" class="mail">アドレス　：</label>
                <input type="text" name="mail" id="mail" class="mail" placeholder="info@example.com">
            </li>
            <li class="pas">
                <label for="pasname" class="pasname">パスワード：</label>
                <input type="text" name="pas" id="pasname" class="pasname"  style="ime-mode:disabled;" placeholder="※半角英数字">
            </li>       
<?php
if(isset($_POST["certification"]) && $_POST["certification"]){
    try{
        $dbh = new PDO($dbn,$dbu,$dbp);
        /*
        オプチャで教えてもらったやつ。
        var_dump($dbh->errorCode());
        var_dump($dbh->errorInfo());
        */
        $sql = ("select * from user where username=:user && mail=:mail ");
        $stmt = $dbh -> prepare($sql);
        $stmt -> bindParam(":user",$_POST["user"]);
        $stmt -> bindParam(":mail",$_POST["mail"]);
        $stmt -> execute();
        if($dbrows = $stmt -> fetch()){
            if($dbrows["pasword"] == $_POST["pas"]){
                echo($dbrow);
                header("Location: index.php") ;
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
            <li class="btns">
                <div class="submit">
                    <input type="submit" value="認証" name="certification">
                </div>
                <div class="submit">
                    <input type="submit" value="新規登録" name="new">
                </div>
            </li>
        </form>
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
                <input type="text" name="user" id="username" class="username" placeholder="someone">
            </li>
            <li class="email">
                <label for="mail" class="mail">アドレス　：</label>
                <input type="text" name="mail" id="mail" class="mail" placeholder="info@example.com">
            </li>
            <li class="pas">
                <label for="pasname" class="pasname">パスワード：</label>
                <input type="password" name="pas" id="pasname" class="pasname" placeholder="※半角英数字">
            </li>       
            <li class="btns">
                <div class="submit">
                    <input type="submit" value="作成" name="new">
                </div>
                <div class="reset">
                    <input type="reset" value="リセット">
                </div>
            </li>
        </form>
    </ul>

<?php } ?>

</html>