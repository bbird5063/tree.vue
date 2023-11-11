<?php
if (!empty($_GET))
	require_once 'require_ajax.php';

/* Заменяем $ok т.к. в variables.php: $ok = !empty($_POST['ok'])?true:false; , 
а в Ajax и "<button name="ok"...":	$_POST['ok'] не передается */
$ok = !empty($_GET) ? true : false;


$data['get'] = $_GET;
//$sourceTree = $_GET;

require_once 'mysql.php';

$strTree = '';

function loadTree($arrTables, $parentID)
{
	require_once 'mysql.php';

	static $strTree = '';

	$strWhere = $parentID ? " WHERE " . $arrTables['idField'] . "=" .  $parentID : "";

	$sql = "
	SELECT " . $arrTables['idField'] . ", " . $arrTables['nameField'] . "
	FROM " . $arrTables['nameTable'] .
		$strWhere . "
	ORDER BY " . $arrTables['indexField'] . ";
	";

	$result = mysqlQuery($sql);
	if (!$result) {
		die("Database access failed: " . $conn->error);
		$data['sqlError'] = "Database access failed: " . $conn->error;
	} else {
	}



	$rows = $result->num_rows;

	if ($parentID) { // не первый
		$strTree .= '<li class="Node IsLast ExpandClosed">';
		$strTree .= '<div class="Expand"></div>';
		$strTree .= '<div class="Content" role="tree" for="all" style="cursor:pointer">Все</div>';
		$strTree .= '<ul class="Container">';
	}


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
		$strTree .= '<div class="Content" role="tree" for="DiaryBookPayment.' . $arrTables['idField'] . '=' . $arrFields[$arrTables['idField']] . '" style="cursor:pointer">' . $arrFields[$arrTables['nameField']]  . '</div>';
		$strTree .= '</li>';
	} //







	if ($parentID) { // не первый
		$strTree .= '</ul>';
	}

	if (isset($arrTables['childTable'])) {
		return $strTree .= loadTree($arrTables['childTable'], $arrTables['idField']);
	} else {
		return $strTree;
	}
}

$data['get'] = loadTree($_GET, 0);
//$data['get'] = 'ПРОБА!';
//$data['get'] = $arrTables;

//$_SESSION['db_connect']->close();


echo json_encode($data);
