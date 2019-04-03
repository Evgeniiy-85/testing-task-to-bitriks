<?php
require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

if ($_POST) {
	$data = [];
	
	if ($_POST['type'] == 'get_users') {
		$data = get_users($_POST['date'], $_POST['date_type']);
	} elseif($_POST['type'] == 'get_users_dates') {
		$data = get_users_dates();
	}
	
	echo json_encode($data, true);
}

function get_users_dates() {
	global $DB;
	
	$q = $DB->Query("SELECT UNIX_TIMESTAMP(DATE_REGISTER) as DATE_REGISTER FROM `b_user`");
	
	$dates = [];
	
	while($row = $q->Fetch()) {
		$dates[] = date('d.m.Y', $row['DATE_REGISTER']);
	}
	
	return $dates;
}

function get_users($date, $date_type) {
	global $DB;
	
	$start_date = !empty($date) ? strtotime($date) : strtotime(date('Y-m-1 00:00:00'));
	$end_date = $start_date + ($date_type == 'd' ?  86400 : date('t', $start_date) * 86400);
	
    $condition = "HAVING `DATE_REGISTER` >= '$start_date' AND `DATE_REGISTER` < '$end_date'";
	
	$q = $DB->Query("SELECT `NAME`, `LAST_NAME`, `EMAIL`, UNIX_TIMESTAMP(DATE_REGISTER) as `DATE_REGISTER` FROM `b_user` $condition");
	
	$users = [];

	$index = 0;

	while($rows = $q->Fetch()) {
		foreach ($rows as $key => $row) {
			if ($key == 'DATE_REGISTER') {
				$row = date('d.m.Y', $row);
			}
			$users[$index][$key] = $row;
		}
		$index++;
	}
	
	return $users;
}