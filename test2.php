<link rel="stylesheet" href="style.css">
<?php
	try {
		$db = new PDO('mysql:dbname=sample;host=127.0.0.1;charset=utf8mb4', 'root', '');
		print '<h1>DB接続成功</h1>';
        $records = $db->query('select * from profile');
		echo "<table class='border'>";
        while($record = $records->fetch()) {
           echo "<tr><td>".$record['id'] .'</td>'.'<td>'.$record['name'].'</td>'.'<td>'.$record['age'] .'</tr></td>';
        }
		echo "</table>";
	} catch(PDOException $e) {
		print 'DB接続エラー：' . $e->getMessage();
	}
?>
