<?php 

	require_once("config.php");

	//carrega um usuario
	//$user1 = new Usuario();
	//$user1->loadById(1);

	//echo $user1;

	//Carrega uma lista de usuarios
	//$lista = Usuario::getList();

	//echo json_encode($lista); 

	//carrega uma lista de usuarios buscando pelo login
	//$search = Usuario::search("th");

	//echo json_encode($search);

	//carrrega um usuario usando o login e a senha
	//$usuario = new Usuario();
	//$usuario->login("tharcio2", "noixenoix");

	//echo $usuario;

	/*
	//Criando um novo usuario
	$aluno = new Usuario("aluno", "@lun0");

	$aluno->insert();

	echo $aluno;
	*/

	$usuario = new Usuario();

	$usuario->loadById(8);

	$usuario->update("professorMaster", "!@#$%¨&A");

	echo $usuario;

 ?>