<?php
class Usuario{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

public function getIdusuario(){
	return $this->idusuario;
}

public function setIdusuario($value){
	$this->idusuario = $value;
}

public function getDeslogin(){
	return $this->deslogin;
}

public function setDeslogin($value){
	$this->deslogin = $value;
}

public function getDessenha(){
	return $this->dessenha;
}

public function setDessenha($value){
	$this->dessenha = $value;
}

public function getDtcadastro(){
	return $this->dtcadastro;
}

public function setDtcadastro($value){
	$this->dtcadastro = $value;
}

public function loadById($id){


	$sql = new Sql();

	$result = $sql->select("SELECT * FROM td_usuarios WHERE idusuario = :ID", array(
		":ID"=>$id
	));
	if(count($result)>0){

		$data = $result[0];

		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}
}

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM td_usuarios ORDER BY deslogin;");

	}


	public static function search($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM td_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
			":SEARCH"=>"%".$login."%"

		));
	}

	public function login($login, $senha){


	$sql = new Sql();

	$result = $sql->select("SELECT * FROM td_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
		":LOGIN"=>$login,
		":SENHA"=>$senha
	));
	if(count($result)>0){

		$data = $result[0];

		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}else{

		throw new Exception("Login e/ou senha inválidos.");
	}

	}

	public function setData($data){
		$this->setIdusuario($data['idusuario']);
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime ($data['dtcadastro']));


	}

	public function Insert(){

		$sql = new Sql();

		$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
			':LOGIN'=>$this->getDeslogin(),
			':SENHA'=>$this->getDessenha()

			));

			if(count($result)>0){
				$this->setData($result[0]);
			}


	}

	public function __construct($login = "", $senha = ""){
		$this->setDeslogin($login);
		$this->setDessenha($senha);
	}

	public function update($login, $senha){
		$this->setDeslogin($login);
		$this->setDessenha($senha);

		$sql = new Sql();

		$sql->query("UPDATE td_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID",array(
			':LOGIN'=>$this->getDeslogin(),
			':SENHA'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()


		));
	}

	public function delete(){
		$sql = new Sql();

		$sql->query("DELETE FROM td_usuarios WHERE idusuario = :ID", array(
			':ID'=>$this->getIdusuario()
		));

		$this->setIdusuario(0);
		$this->setDeslogin("");
		$this->setDessenha("");
		$this->setDtcadastro(new DateTime());
	}

	public function __toString(){

		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")


		));
	}

}

?>