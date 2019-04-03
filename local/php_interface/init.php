<?php

define("DEFAULT_TEMPLATE_PATH", "/local/templates/.default");

function get_users2($date = null) {
	global $DB;
	
	$q = $DB->Query("SELECT *FROM `b_user`");
	
	$users = [];

	$index = 0;

	while($rows = $q->Fetch()) {
		foreach ($rows as $key => $row) {
			if ($key == 'DATE_REGISTER') {
				$row = date('d.m.Y', strtotime($row));
			}
			$users[$index][$key] = $row;
		}
		$index++;
	}
	
	return $users;
}



//debug(get_users());
function debug($data) {
	echo '<pre style="color: #000">' . print_r($data, 1) . '</pre>';
}

