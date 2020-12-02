<?php
	include("header.php");
	if (isset($_REQUEST['page'])) {
		$page=$_REQUEST['page'];

		if($page=='classregistration') {
			include("class-registration.php");
		} else if ($page=='classupdate') {
			include("class-update.php");
		} else {
			include("class-list.php");
		}
	} else {
		include("class-list.php");
	}
?>