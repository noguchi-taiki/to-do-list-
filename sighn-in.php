<?php
echo($_POST["user"])

// if(isset($_POST["認証"])&&)

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
                <input type="password" name="" id="pasname" class="pasname"  style="ime-mode:disabled;">
            </li>
            <li class="btns">
                <div class="submit">
                    <input type="submit" value="認証">
                </div>
                <div class="submit">
                    <input type="submit" value="新規登録">
                </div>
            </li>
        </form>
    </ul>
</body>
</html>