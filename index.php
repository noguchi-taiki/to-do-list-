<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- ブートスラップ（グリッドシステムのみ）の取り込み -->
    <link rel="stylesheet" href="bootstrap-grid.css">
    <title></title>
</head>
<?php
// エラーを出力する
ini_set('display_errors', "On");
?>
<body>
    <header>
        <h1 class="logo">.todolist</h1>
    </header>
    <main>
        <?php if($_POST) {?>
            <ul class="form">
            <form action="./index2.php" method="post">
                <li class="tsk">
                    タスク：<input type="text" name="tskname" id="tskname" class="tskname" value="<?php echo $_POST["tskname"] ?>">
                </li>
                
                <li class="priority-radio">     
                        <?php
                        if(isset($_POST['priority'])) {
                            echo '優先度：' .  $_POST['priority'] ;
                        } else {
                            echo '優先度が選択されていません。<br>';
                        }
                        ?>
                </li>

                <li class="alert-date">
                    <label for="alert">お知らせ時間：<input type="datetime-local" id="alert" value="<?php echo $_POST["alert"]?>"></label>
                </li>

                <div class="resetsubmit">
                    <div class="submit">
                        <input type="submit" value="確定">
                    </div>
                    <div class="reset">
                        <input type="reset" value="戻る">
                    </div>
                </div>
            </form>


            </ul>
        
        <?php } else { ?>













        <ul class="form">
            <form action="./index.php" method="post">
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
                    <label for="alert">お知らせ時間：<input type="datetime-local" id="alert" name="alert"></label>
                </li>

                <div class="resetsubmit">
                    <div class="submit">
                        <input type="submit" value="リストに保存する">
                    </div>
                    <div class="reset">
                        <input type="reset" value="リセット">
                    </div>
                </div>
            </form>
        </ul>

        <?php } ?>
    </main>

        
        
    
    <footer>

    </footer>
    <script src="script.js"></script>
</body>
</html>