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


$query = "SELECT ot.*,
				 cl.id as cl_id,
				 cl.name as cl_name,
				 cl.surname as cl_surname,
				 pr.id as pr_id,
				 pr.name 
		    FROM order_tbl as ot 
			left join clients as cl on cl.id = ot.client 
			left join products as pr on pr.id = ot.product ";

if( isset($_POST['cid']) ) {
	$query.= " where ot.id = ".$_POST['cid'];
}
$resArray = [];
if ($result = $mysqli->query($query)) {
    while ($obj = $result->fetch_object()) {
        $resArray[] = $obj;
    }
    $result->close();
    echo json_encode($resArray);
}

