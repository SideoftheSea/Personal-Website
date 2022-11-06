<?php 

function is_administrator() {
	if((isset($_SESSION['administrator']) && $_SESSION['administrator'] == 1) || (isset($_COOKIE['administrator']) && $_COOKIE['administrator'] == 1)) {
		return true;
	} else {
		return false;
	}
}

function is_staff() {
	if((isset($_SESSION['staff']) && $_SESSION['staff'] == 1) || (isset($_COOKIE['staff']) && $_COOKIE['staff'] == 1)) {
		return true;
	} else {
		return false;
	}
}

function logged_type() {
	if(isset($_SESSION['id'])) {
		return 1;
	} elseif(isset($_COOKIE['id'])) {
		return 2;
	} else {
		return false;
	}
}

function return_logged() {
	$string = '';
	if(logged_type() == 1) {
		$loggedin = $_SESSION['loggedin'];
		$minutes = number_format((time() - $loggedin) / 60);
		$format = 'minutes';
		$s_string = $minutes . ' ' . $format;
		if($minutes > 60) {
			$hours = number_format($minutes / 60);
			$minutes = $minutes % 60;
			$format = 'hours';
			$s_string = $hours . ' hours and ' . $minutes . ' minutes';
		}
		$string = '<p>You have been logged in for ' . $s_string . '</p>';
	} elseif (logged_type() == 2) {
		$loggedin = $_COOKIE['loggedin'];
		$minutes = number_format((time() - $loggedin) / 60);
		$format = 'minutes';
		$s_string = $minutes . ' ' . $format;
		if($minutes > 60) {
			$hours = number_format($minutes/60);
			$minutes = $minutes % 60;
			$format = 'hours';
			$s_string = $hours .' hours and ' . $minutes . ' minutes';
		}
		$string = '<p>You have been logged in for ' . $s_string . '</p>';
	} else {
		$string = 'test';
	}
	return print $string;
}