<?php
  session_start();
  $mode = 'input';
  if(isset($POST["back"]) && $_POST['back']){

  } else if( isset($_POST['confirm']) && $_POST['confirm'] ){

    $_SESSION["tskname"] = $_POST["tskname"];
    $_SESSION["priority"] = $_POST["priority"];
    $_SESSION["alert"] = $_POST["alert"];
    $mode = 'confirm';
  } else if( isset($_POST['send']) && $_POST['send'] ){
    $mode = 'send';
  }
$dsn = "mysql:host=localhost; dbname=todolist; charset=utf8"; 
$user = "root";
$pass ="root";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <!-- ブートスラップ（グリッドシステムのみ）の取り込み -->
    <link rel="stylesheet" href="bootstrap-grid.css">
    <title></title>
</head>
<body>
    <header>
        <h1 class="logo">.todolist</h1>
    </header>
    <?php if( $mode == 'input') { ?>
        <ul class="form">
            <form action="./index.php" method="post">
            <?php 
                    $dbh = new PDO($dsn,$user,$pass);
                    $sql = "select tsk,priority,time from tskname oreder by case priority when '緊急' then 1 when '普通' then 2 when '不急' then 3 end";
                    $stmt = $dbh -> prepare($sql);
                    $stmt -> execute();
                    $sbh  = null;
                        while ($task = $stmt -> fetch(PDO::FETCH_ASSOC)) {
                            var_dump($task);
                        };
                    ?>
                <li class="tsk">
                    <label for="tskname" class="tskname">タスク：<input type="text" name="tskname" id="tskname" class="tskname"></label>
                </li>
                <li class="priority-radio">                    
                        優先度：
                        <div class="radiobtn-group">
                            <input id="priority1" type="radio" name="priority" value="緊急"><label class="radiobtn" for="priority1">緊急</label>
                            <input id="priority2" type="radio" name="priority" value="通常"><label class="radiobtn" for="priority2">通常</label>
                            <input id="priority3" type="radio" name="priority" value="不急"><label class="radiobtn" for="priority3">不急</label>
                        </div>
                </li>

                <li class="alert-date">
                    <label for="alert" >お知らせ時間：<input type="datetime-local" id="alert" name="alert"></label>
                </li>

                <div class="resetsubmit">
                    <div class="submit">
                        <input type="submit" value="リストに保存する" name="confirm">
                    </div>
                    <div class="reset">
                        <input type="reset" value="リセット">
                    </div>
                </div>
            </form>
        </ul>
    <?php } else if($mode == 'confirm'){ ?>
        <ul class="form">
            <form action="./index.php" method="post">
            
                <li class="tsk">
                    <span class="tskname">タスク：</span><input type="text" name="tskname" id="tskname" class="tskname" value="<?php echo $_SESSION["tskname"] ?>">
                </li>
                
                <li class="priority-radio">                    
                        優先度：
                        <?php
                        echo $_SESSION["priority"];
                        ?>
                </li>

                <li class="alert-date">
                    <label for="alert">お知らせ時間：<input type="datetime-local" id="alert" value="<?php echo $_SESSION["alert"]?>"></label>
                </li>

                <div class="resetsubmit">
                    <div class="submit">
                        <input type="submit" value="確定" name="send">
                    </div>
                    <div class="reset">
                        <input type="submit" value="戻る" name="back">
                    </div>
                </div>
            </form>

            </ul>
    <?php } else { ?>
        <ul class="form">
            <form action="./index.php" method="post">
            <input type="submit" value="完了！"　name="back" class="donebtn">
            <?php
            try{
            $dbh = new PDO($dsn,$user,$pass,);
            $sql = "insert into tskname values (:tskname,:priority,:alert)";
            $res = $dbh->prepare($sql);
            $res -> bindParam(":tskname",$_SESSION["tskname"]);
            $res -> bindParam(":priority",$_SESSION["priority"]);
            $res -> bindParam(":alert",$_SESSION["alert"]);
            $res -> execute();
            $dbh = null;
            $sql = null;
            } catch(PDOException $e) {
                echo"接続失敗".$e->getMessage();
                exit();
            }
            ?>
            </form>
        </ul>
    <?php } ?>
    <script src="script.js"></script>
</body>
</html>