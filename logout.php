<?php
	session_start();
	session_destroy();
	header("Location: ../Square/index.php");
?>