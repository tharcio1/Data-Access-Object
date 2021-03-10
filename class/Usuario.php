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

				$row = $results[0];

				$this->setIdusuario($row['idusuario']);
				$this->setDeslogin($row['deslogin']);
				$this->setDessenha($row['dessenha']);
				$this->setDtcadastro($row['dtcadastro']);

			}//fim if

		}//fim metodo loadById


		public function __toString(){
			return json_encode(array(
				"idusuario" => $this->getIdusuario(),
				"deslogin" => $this->getDeslogin(),
				"dessenha" => $this->getDessenha(),
				"dtcadastro" => $this->getDtcadastro(),
			));
		}//fim metodo toString

	}// fim classe Usuario

 ?>