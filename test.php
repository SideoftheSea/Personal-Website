<?php

date_default_timezone_set('Asia/Taipei');

if(date('g:i a') == '5:55 pm') {
	print '1';
} else {
	print date('g:i a');
}

?>