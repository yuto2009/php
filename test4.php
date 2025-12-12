<?php
error_reporting(-1);

define('DB_DNS' , 'mysql:host=localhost; dbname=cri_sortable; charset=utf8');
define('DB_USER', 'root');
define('DB_PASSWORD' , 'root');


try {
$db = new PDO('mysql:dbname=sample;host=127.0.0.1;charset=utf8mb4', 'root', '');
    print '<h1>DB接続成功</h1>';
    $records = $db->query('select * from todolist');
    echo "<table class='border'>";
} catch(PDOException $e) {
    print 'DB接続エラー：' . $e->getMessage();
}

// 登録処理
if(!empty($_POST['details']) && !empty($_POST['inputperiod'])) {
    try{
        $sql = 'INSERT INTO todolist(work_details,working_period) VALUES(:ONAMAE,:NENREI)';
        $stmt = $db->prepare($sql);

        $stmt->bindValue('ONAMAE' , $_POST['details'],PDO::PARAM_STR);
        $stmt->bindValue('NENREI', $_POST['inputperiod'] ,PDO::PARAM_STR);
        $stmt->execute();

        header('Location: test4.php');
        exit();
    } catch (PDOException $e) {
        echo 'データベースにアクセスできません!'. $e->getMessage();
    }
}


// 削除処理
if (!empty($_POST['details']) && !empty($_POST['input'])) {
    try{
        $sql = ;
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
     <form action="test4.php" method="POST">
            <input type="text" name="details" placeholder="作業内容">
            <p><input type="datetime-local" name="inputperiod" placeholder="作業期限"></p>
            <input type="submit" value="登録" >
            </form>
            <?php
                $sql = 'SELECT * FROM todolist';
                $stmt = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($stmt as $result): ?>
                <ul>
                    <li><?= $result["work_details"] ?></li>
                    <li><?= $result["working_period"] ?></li>
                    <li>
                    <form action="test4.php" method="POST">
                        <input type="hidden" name="id" value=<?= $record["TODO_ID"] ?>>
                        <button type="submit">削除</button></li>
                    </form>
            </ul>
            <?php endforeach; ?>
    </div>
</body>
</html>