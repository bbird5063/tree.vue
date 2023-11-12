<?php

require 'require_ajax.php';
require_once 'mysql.php';

function aboveZero($table, $field, $value)
{
	require_once 'mysql.php';
	$sql = "SELECT COUNT(*) AS count FROM $table WHERE $field = $value;";
	$result = mysqlQuery($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	return $row["count"] > 0 ? 1 : 0;
}

$arrTables = $_GET;
$nameTable = $arrTables['nameTable'];
$idField = $arrTables['idField'];
$nameField = $arrTables['nameField'];
$indexField = $arrTables['indexField'];
$childTable = isset($arrTables['childTable']) ? $arrTables['childTable']['nameTable'] : '';
$childTableID = isset($arrTables['childTable']) ? $arrTables['childTable']['idField'] : '';
$where = isset($arrTables['id']) ? 'WHERE ' . str_replace('-', '=', $arrTables['id']) : '';

$sql = "SELECT * FROM $nameTable $where ORDER BY $indexField;";

$data['sql'] = $sql;

require_once 'mysql.php';

$result = mysqlQuery($sql);
if (!$result) {
	die("Database access failed: " . $_SESSION['db_connect']->error);
	$data['sqlError'] = "Database access failed: " . $_SESSION['db_connect']->error;
} else {
	$rows = $result->num_rows;
	for ($j = 0; $j < $rows; ++$j) {
		$result->data_seek($j);
		$arrFields = $result->fetch_array(MYSQLI_ASSOC);

		$li = [];
		$li['id'] = $idField . '-' . $arrFields[$idField];
		$li['title'] = $arrFields[$nameField];
		$li['isFolder'] = isset($arrTables['childTable']) ? aboveZero($childTable, $idField, $arrFields[$idField]) : 0;

		$data['tree'][] = $li;
	}
}

echo json_encode($data);
