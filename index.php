<?php
  session_start();
  if(isset($_SESSION["user"])){
    $_POST["user"] = $_SESSION["user"];
    $_POST["mail"] = $_SESSION["mail"];
  } else {
      header("location: sighn-in.php");
>>>>>>> origin/master
  }
  $mode = 'input';
  if(isset($POST["back"]) && $_POST['back']){

  } else if(isset($_POST['confirm']) && $_POST['confirm']){
    $_SESSION["tskname"] = $_POST["tskname"];
    $_SESSION["priority"] = $_POST["priority"];
    $_SESSION["alert"] = $_POST["alert"];
    $mode = 'confirm';
  } else if( isset($_POST['send']) && $_POST['send'] ){
    $mode = 'send';
  }

$dsn  ="mysql:host=localhost; dbname=todolist; charset=utf8"; 
$user ="root";
$pass ="root";

if(isset($_POST["tsk"])){
    $dbh = new PDO($dsn,$user,$pass);
    $sql = "delete from $_SESSION[user] where tsk = :tskdate";
    $stmt = $dbh -> prepare($sql);
    $stmt -> bindParam(":tskdate",$_POST["tsk"]);
    $stmt -> execute();
    $sql = null;
    $dbh = null; 
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>main</title>
</head>
<body>
    <header>
        <h1 class="logo"><?php echo($_SESSION["user"]); ?>.todolist</h1>
    </header>
    <?php if( $mode == 'input') { ;?>
        <ul class="form">
            <?php
                    $dbh = new PDO($dsn,$user,$pass);
                    $sql = "select * from $_SESSION[user]";
                    $stmt = $dbh -> prepare($sql);
                    $stmt -> execute();
                    $sql = null;
                    $dbh = null;
                    ?>
                    <li class="tskstmtbox">
                        <?php while ($task = $stmt -> fetch(PDO::FETCH_ASSOC)) {?>
                            <br><div class="box">
                            <div class="tskstmt"><?php echo $task["tsk"];?></div>
                            <div class="timestmt"><?php echo $task["time"];?></div>
                            <div class="prioritystmt"><?php echo $task["priority"];?></div>
                            <div class="btnstmt">
                            <?php echo "
                            <form method='POST' action='index.php' autocomplete='off'>
                                <input type='hidden' value='delete' name='method' required>
                                <input type='hidden' value='".$task["tsk"]."' name='tsk' required>
                                <button type='submit'>?????????</button><br>
                            </form>
                            ";                            
                            ?>
                            
                            </div><br>
                        <?php } ?>
                    </li>


            <form action="./index.php" method="post" autocomplete="off">
                <li class="tsk">
                    <label for="tskname" class="tskname">????????????<input type="text" name="tskname" id="tskname" class="tskname" autocomplete="off" required></label>
                </li>
                <li class="priority-radio">                   
                        ????????????
                        <div class="radiobtn-group">
                            <input id="priority1" type="radio" name="priority" value="??????"><label class="radiobtn" for="priority1">??????</label>
                            <input id="priority2" type="radio" name="priority" value="??????"><label class="radiobtn" for="priority2">??????</label>
                            <input id="priority3" type="radio" name="priority" value="??????"><label class="radiobtn" for="priority3">??????</label>
                        </div>
                </li>

                <li class="alert-date">
                    <label for="alert" >?????????????????????<input type="datetime-local" id="alert" name="alert" required></label>
                </li>

                <li class="btns">
                    <div class="submit">
                        <input type="submit" value="????????????????????????" name="confirm">
                    </div>
                    <div class="reset">
                        <input type="reset" value="????????????">
                    </div>
                </li>
            </form>
        </ul>
    <?php } else if($mode == 'confirm'){ ?>
        
        <ul class="form">
            <form action="./index.php" method="post" autocomplete="off">
            
                <li class="tsk">
                    <span class="tskname">????????????</span><input type="text" name="tskname" id="tskname" class="tskname" value="<?php echo $_SESSION["tskname"] ?>" required>
                </li>
                
                <li class="priority-radio">                    
                        ????????????
                        <?php
                        echo $_SESSION["priority"];
                        ?>
                </li>

                <li class="alert-date">
                    <label for="alert">?????????????????????<input type="datetime-local" id="alert" value="<?php echo $_SESSION["alert"]?>" required></label>
                </li>

                <div class="btns">
                    <div class="submit">
                        <input type="submit" value="??????" name="send">
                    </div>
                    <div class="reset">
                        <input type="submit" value="??????" name="back">
                    </div>
                    
                </div>
            </form>

            </ul>
    <?php } else { ?>
        <ul class="form">
            <form action="./index.php" method="post" autocomplete="off">
            <input type="submit" value="?????????" name="back" class="donebtn">
            <?php
            try{
            $dbh = new PDO($dsn,$user,$pass,);
            $sql = "insert into $_SESSION[user] values (:tskname,:priority,:alert)";
            $stmt = $dbh -> prepare($sql);
            $stmt -> bindParam(":tskname",$_SESSION["tskname"]);
            $stmt -> bindParam(":priority",$_SESSION["priority"]);
            $stmt -> bindParam(":alert",$_SESSION["alert"]);
            $stmt -> execute();
            $dbh = null;
            $sql = null;
            } catch(PDOException $e) {
                echo"????????????".$e->getMessage();
                exit();
            }
            ?>
            </form>
        </ul>
    <?php } ?>
</body>
</html>