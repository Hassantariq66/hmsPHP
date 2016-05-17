<?php
// Connection establish for constant parameters
	require_once('inc/inc.main.php');
	
	if(empty($_SESSION['name'])){
		header('location:'.SITE_PATH.'index.php');
	}
?>