<?php
require_once('./inc/inc.main.php');
session_destroy();
header('location:'.SITE_PATH.'index.php');
?>