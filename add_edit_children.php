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


if( $_POST['mod'] == 'add' ) {
	$query = <<<SQL
insert into children
	   (name,
	   	age, 
	   	tall, 
	   	gender,
	   	last_update,
	   	parent
	   )
	   values(
	   	'{$_POST['name']}',
	   	'{$_POST['age']}',
	   	'{$_POST['tall']}',
	   	'{$_POST['gender']}',
	   	NOW(),
	   	'{$_POST['parent']}'
	   	)
SQL;
	echo $query;
	if ($mysqli->query($query) === TRUE) {
		echo 'Успешно добавлен!';
	}
}

if( $_POST['mod'] == 'edit' ) {
	$query = <<<SQL
UPDATE children 
   SET name    ='{$_POST['name']}',
       age = '{$_POST['age']}',
       tall = '{$_POST['tall']}',
       gender = '{$_POST['gender']}',
       last_update  = 	NOW(),
       parent = '{$_POST['parent']}'
 WHERE id = {$_POST['id']}
SQL;

	if ($mysqli->query($query) === TRUE) {
		echo 'Успешно обновлен!';
	}

}