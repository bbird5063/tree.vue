<?php
	require '../config.php';
	
	$connect = new mysqli(BBR_DBSERVER, BBR_DBUSER, BBR_DBPASSWORD, BBR_DATABASE);
	$result = $connect->query($_GET['sqlQuery']);
	
	if (!$result) {
		$data['errorDB']="Database access failed: " . $connect->error;
	} 
	else {
	
		$count_rows = $result->num_rows;
		for ($j = 0 ; $j < $count_rows ; ++$j) {
			$result->data_seek($j);
			$arrFields = $result->fetch_array(MYSQLI_ASSOC);
			$data['rowsContent'][] = $arrFields;
			unset($arrFields);
			}
	}
	
	//$data['rowsContent'] = $connect->error;
	$connect->close();
	echo json_encode($data);
?>