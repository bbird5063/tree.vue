<?php

if (!empty($_GET))
	require_once 'require_ajax.php';

/* Заменяем $ok т.к. в variables.php: $ok = !empty($_POST['ok'])?true:false; , 
	а в Ajax и "<button name="ok"...":	$_POST['ok'] не передается */
$ok = !empty($_GET) ? true : false;

////////////////////////////////////////////////////////////////////


/** 
 * Controller
 * Контроллер 
 * @author IT studio IRBIS-team 
 * @copyright © 2009 IRBIS-team 
 */
/////////////////////////////////////////////////////////

/**
 * Generation of page of an error at access out of system
 * Генерация страницы ошибки при доступе вне системы
 */
if (!defined('BBR_KEY')) {
	header("HTTP/1.1 404 Not Found");
	exit(file_get_contents('../../404.html'));
}
//////////////////////////////////////////////////////////


require_once 'mysql.php';
$data['get'] = $_GET;

//$_SESSION['db_connect']->close();


echo json_encode($data);
