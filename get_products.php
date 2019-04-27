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


$query = "SELECT * FROM products ";

if( isset($_POST['cid']) ) {
	$query.= " where id = ".$_POST['cid'];
}
$resArray = [];
if ($result = $mysqli->query($query)) {
    while ($obj = $result->fetch_object()) {
        $resArray[] = $obj;
    }
    $result->close();
    echo json_encode($resArray);
}

