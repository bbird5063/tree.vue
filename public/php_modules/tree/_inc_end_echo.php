<?php
	if (isset($_GET))
	$data['get'] = $_GET;

	if (isset($test))
	$data['test'] = $test;


	
	echo json_encode($data);
