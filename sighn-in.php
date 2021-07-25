<?php
session_start();
$dbn = "mysql:host=localhost; dbname=todolist; charset=utf8";
$dbu = "root";
$dbp = "root";


if(isset($_POST["certification"]) && $_POST["certification"]){
    try{
        $dbh = new PDO($dbn,$dbu,$dbp);
        /*
        オプチャで教えてもらったやつ。
        var_dump($dbh->errorCode());
        var_dump($dbh->errorInfo());
        */
        $sql = ("delete from user where username=('太貴')");
        // $stmt -> prepare($sql);
        // $stmt -> bindParam(":user",$_POST["user"]);
        // $stmt -> execute();
        $stmt = $dbh -> query($sql);
        exit();
        // if($dbrows = $stmt->fetch()){
        //     if($dbrows["pas"] == $_POST["pas"]){
        //         echo("ログイン成功");
        //     } else {
        //         echo("ログイン失敗");
        //     }
        // } else {
        //     echo("ログイン失敗");
        // }
    } catch(PDOException $e) {
        echo"接続失敗".$e->getMessage();
        exit();
    }
}

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
<body>
    <header>
        <h1 class="logo">.todolist</h1>
    </header>
    <ul class="form">
        <form action="sighn-in.php" method="post">
            <li class="user">  
                <label for="username" class="username">ユーザー名：</label>
                <input type="text" name="user" id="username" class="username">             
            </li>
            <li class="pas">
                <label for="pasname" class="pasname">パスワード：</label>
                <input type="password" name="pas" id="pasname" class="pasname"  style="ime-mode:disabled;">
            </li>
            <li class="btns">
                <div class="submit">
                    <input type="submit" value="認証" name="certification">
                </div>
                <div class="submit">
                    <input type="submit" value="新規登録">
                </div>
            </li>
        </form>
        <?php
        ?>
    </ul>
</body>
</html>