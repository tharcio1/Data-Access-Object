<?php 
	
	class Usuario {

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario(){
			return $this->idusuario;
		}//fim metodo getIdusuario

		public function getDeslogin(){
			return $this->deslogin;
		}//fim metodo getDeslogin

		public function getDessenha(){
			return $this->dessenha;
		}//fim metodo getDessenha

		public function getDtcadastro(){
			return $this->dtcadastro;
		} //fim metodo getDtcadastro


		public function setIdusuario($value){
			$this->idusuario = $value;
		}//fim metodo setIdusuario

		public function setDeslogin($value){
			$this->deslogin = $value;
		}//fim metodo setDeslogin

		public function setDessenha($value){
			$this->dessenha = $value;
		}//fim metodo setDessenha

		public function setDtcadastro($value){
			$this->dtcadastro = $value;
		}//fim metodo setDtcadastro

		public function loadById($id){

			$Sql = new Sql();

			$results = $Sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id
			));

			if(count($results) > 0){

				$this->setData($results[0]);

			}//fim if

		}//fim metodo loadById

		public static function getList(){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
		}//fim function getList

		public static function search($login){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
				":SEARCH"=>"%".$login."%"
			));

		}// fim function search

		public static function searchExactly($login){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :SEARCH ORDER BY deslogin", array(
				":SEARCH"=>$login
			));
		}// fim function searchExactly

		public function login($login, $password){

			$Sql = new Sql();

			$results = $Sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
				":LOGIN"=>$login,
				":PASSWORD"=>$password
			));

			if(count($results) > 0){

				$this->setData($results[0]);

			}else{

				throw new Exception("Login e/ou senha inválidos.");
				

			}//fim else

		}//fim function login


		public function setData($data){

			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro($data['dtcadastro']);

		}//fim metodo setData

		public function insert(){
			$sql = new Sql();

			if($this->verifyLogin($this->getDeslogin())) {
				throw new Exception("Usuário já existente!");
			}else{
				$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
					':LOGIN'=>$this->getDeslogin(),
					':PASSWORD'=>$this->getDessenha()
				));//sp = storage procedure

				if(count($results) > 0) {
					$this->setData($results[0]);
				}//fim if
			}//fim else

		}//fim metodo insert

		public function update($login, $password){

			if($this->verifyLogin($login) and $login != $this->getDeslogin()) {
				throw new Exception("Usuário já existente!");
			}else{
				$this->setDeslogin($login);
				$this->setDessenha($password);

				$sql = new Sql();

				$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
					':LOGIN'=>$this->getDeslogin(),
					':PASSWORD'=>$this->getDessenha(),
					':ID'=>$this->getIdusuario()
				));
			}//fim else

		}//fim function update

		public function verifyLogin($login){
			$sql = new Sql();

			$userExists = $this->searchExactly($login);

			if(count($userExists) > 0) {
				return true;
			}//fim if
		}//fim function verifyLogin

		public function __construct($login = "", $password = ""){

			$this->setDeslogin($login);
			$this->setDessenha($password);

		}//fim function __construct

		public function __toString(){
			return json_encode(array(
				"idusuario" => $this->getIdusuario(),
				"deslogin" => $this->getDeslogin(),
				"dessenha" => $this->getDessenha(),
				"dtcadastro" => $this->getDtcadastro(),
			));
		}//fim function __toString

	}// fim classe Usuario

 ?>