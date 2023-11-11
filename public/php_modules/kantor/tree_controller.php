<?php

if (!empty($_POST))
	require_once 'require_ajax.php';

/* Заменяем $ok т.к. в variables.php: $ok = !empty($_POST['ok'])?true:false; , 
	а в Ajax и "<button name="ok"...":	$_POST['ok'] не передается */
$ok = !empty($_POST) ? true : false;

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

$strTree = '';

for ($credit = 1; $credit >= 0; --$credit) {


	$sql = "
	SELECT TypePayment.Credit, TypePayment.ID_TypePayment, TypePayment.NameTypePayment, TypePayment.UserIndex 
	FROM TypePayment
	WHERE TypePayment.Credit=$credit AND TypePayment.IsCount=1 
	ORDER BY TypePayment.UserIndex;
	";

	$result = mysqlQuery($sql);
	if (!$result) {
		die("Database access failed: " . $conn->error);
		$data['sqlError' . $credit] = $conn->error;
	} else {

		if ($credit == 0) {
			$strTree .= '<li class="Node ExpandClosed IsLast">';
		} else {
			$strTree .= '<li class="Node ExpandClosed">';
		}
		$strTree .= '<div class="Expand"></div>';
		$isCredit = $credit == 1 ? 'ПРИХОД' : 'расход';
		$strTree .= '<div class="Content" role="tree' . $credit . '" for="DiaryBookPayment.Credit=' . $credit . '" style="cursor:pointer">' . $isCredit . '</div>';
		$strTree .= '<ul class="Container">';

		$rows = $result->num_rows;

		for ($j = 0; $j < $rows; ++$j) {
			$result->data_seek($j);
			$arrFields = $result->fetch_array(MYSQLI_ASSOC);

			if ($j == $rows - 1) {
				$strTree .= '<li class="Node ExpandLeaf IsLast">';
			} else {
				$strTree .= '<li class="Node ExpandLeaf">';
			}


			//$strTree .= '<li class="Node ExpandLeaf">';
			$strTree .= '<div class="Expand"></div>';
			$strTree .= '<div class="Content" role="tree' . $credit . '" for="DiaryBookPayment.ID_TypePayment=' . $arrFields['ID_TypePayment'] . '" style="cursor:pointer">' . $arrFields['NameTypePayment']  . '</div>';
			$strTree .= '</li>';
		} //
	}
	$strTree .= '</ul>';
	$strTree .= '</li>';
} // credit

$strTree .= '</ul>';
$strTree .= '</li>';

$data['strTree'] = $strTree;

$_SESSION['db_connect']->close();


echo json_encode($data);
