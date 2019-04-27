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

// // echo 1;
if( $_POST['mod'] == 'add' ) {
	$query = <<<SQL
insert into order_tbl
	   (`client`, 
	   	`product`
	   )
	   values(
	   	'{$_POST['client']}',
	   	'{$_POST['product']}'
	   	)
SQL;
	if ($mysqli->query($query) === TRUE) {
		echo 'Успешно добавлен!';
	}
}

if( $_POST['mod'] == 'edit' ) {
	$query = <<<SQL
UPDATE order_tbl 
   SET client  ='{$_POST['client']}',
       product = '{$_POST['product']}'
 WHERE id = {$_POST['id']}
SQL;

	if ($mysqli->query($query) === TRUE) {
		echo 'Успешно обновлен!';
	}

}