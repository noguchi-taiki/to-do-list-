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
    <form action="index.php" method="POST" class="form">
        <div class="user">
            <label for="username">user名：</label>
            <input type="text" id="username" name="username">
        </div>
        <div class="pas">
            <label for="pas">パスワード：</label>
            <input type="password" id="number" name="number" style="ime-mode:disabled;">
        </div>
        <div class="sub">
            <input type="submit" value="認証" class="submit">
        </div>
    </form>
</body>
</html>