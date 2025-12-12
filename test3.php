<?php
error_reporting(-1);

define('DB_DNS' , 'mysql:host=localhost; dbname=cri_sortable; charset=utf8');
define('DB_USER', 'root');
define('DB_PASSWORD' , 'root');

try {
    $db = new PDO('mysql:dbname=sample;host=127.0.0.1;charset=utf8mb4', 'root', '');
		print '<h1>DB接続成功</h1>';
        $records = $db->query('select * from profile');
		echo "<table class='border'>";
	} catch(PDOException $e) {
		print 'DB接続エラー：' . $e->getMessage();
	}


if(!empty($_POST['inputName']) && !empty($_POST['inputAge'])){
    try{
        $sql = 'INSERT INTO profile(name,age) VALUES(:ONAMAE,:NENREI)';
        $stmt = $db->prepare($sql);

        $stmt->bindValue('ONAMAE' , $_POST['inputName'],PDO::PARAM_STR);
        $stmt->bindValue('NENREI', $_POST['inputAge'] ,PDO::PARAM_INT);
        $stmt->execute();

        header('Location: test3.php');
        exit();
    } catch (PDOException $e) {
        echo 'データベースにアクセスできません!'. $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 2px solid;
            padding: 5px;
            text-align: left;
            padding-right: 50px;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="input_form">
            <form action="" method="POST">
                <input type="text" name="inputAge" placeholder="年齢">
                <input type="text" name="inputName" placeholder="名前">
                <input type="submit" value="登録" >
            </form>
        </div>
        <div id="drag-area">
            <?php
            $sql = 'SELECT * FROM profile';
            $stmt = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <table>
            <?php foreach ($stmt as $result): ?>
                <tr>
                    <td><?= $result["id"] ?></td>
                    <td><?= $result["age"] ?></td>
                    <td><?= $result["name"] ?></td>
                </tr>
            <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>