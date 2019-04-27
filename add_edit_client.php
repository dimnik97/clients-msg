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
insert into clients
	   (`name`, 
	   	`surname`, 
	   	`c_info`
	   )
	   values(
	   	'{$_POST['name']}',
	   	'{$_POST['surname']}',
	   	'{$_POST['c_info']}'
	   	)
SQL;
	if ($mysqli->query($query) === TRUE) {
		echo 'Успешно добавлен!';
	}
}

if( $_POST['mod'] == 'edit' ) {
	$query = <<<SQL
UPDATE clients 
   SET name    ='{$_POST['name']}',
       surname = '{$_POST['surname']}',
       c_info  = '{$_POST['c_info']}'
 WHERE id = {$_POST['id']}
SQL;

	if ($mysqli->query($query) === TRUE) {
		echo 'Успешно обновлен!';
	}

}