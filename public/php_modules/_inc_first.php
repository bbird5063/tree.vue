<?php

session_start();

define('BBR_TRACE', true);

require 'debug.php';

define('BBR_KEY', true);

require 'config.php';



/**
 * Information conclusion
 * Вывод информации        
 */
function getInfo($info, $sep = '<br>')
{
	if (count($info))
		//return $sep . implode($sep, $info);
		return implode($sep, $info);
	else
		return '&nbsp;';
}


// require 'default.php';

require 'variables.php';

//require 'view.php';

$http_host = $_SERVER['HTTP_HOST'];
$req_url = $_SERVER['QUERY_STRING'];
$req_url = mb_substr($req_url, 1);
if (mb_substr_count($req_url, '/') > 1) {
	$pos1 = mb_strpos($req_url, '/'); // 9
	$req_url = mb_substr($req_url, 0, $pos1); // /1/1433
	$url_act = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $req_url . '/';
} else {
	$url_act = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
}
