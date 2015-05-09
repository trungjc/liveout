<?php

//$site_url = $_REQUEST['site_url'];
require_once('../../../../../wp-config.php');
require_once('../config.php');
require_once('../ContestBurner.php');

$cb = new ContestBurner();
// echo 'test';
SWITCH ($_REQUEST['action']) {
	case 'display_selected_categories':
		$cb->ajax_display_selected_categories();
		break;
		
}

exit;
?>