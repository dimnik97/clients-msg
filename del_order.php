<?php
ini_set('display_errors', 1);
$host = 'localhost';
$db_name = 'arina_db';
$db_user = 'root';
$db_pass = 'root';
$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query = <<<SQL
delete from order_tbl
	  where id = {$_POST['id']}
SQL;
echo $query;
if ($mysqli->query($query) === TRUE) {
	echo 'Успешно удалено!';
}