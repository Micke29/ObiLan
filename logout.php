<?php
	session_start();
	session_destroy();

	unset($_SESSION['pseudo']);

	header("Location: ./");
	exit();
?>