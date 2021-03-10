<?php 

	require_once("config.php");

	$user1 = new Usuario();

	$user1->loadById(1);

	echo $user1;

 ?>