<?php

class Usuario {
	
	private $idusuario;  ///atributos da classe que vieram do banco
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){			////getter and setters
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

	public function loadById($id){ //funcao carregar pelo Id
		
		$sql = new Sql(); //instanciando a classe sql
		
		$results = $sql->select("SELECT*FROM tb_usuarios WHERE idusuario = :ID",array(
		":ID"=>$id //passando um select para $results, parametro um array(como na classe Sql)
		));
		
		if(count($results) > 0){//count se o resultado for maior que zero
			$row = $results[0];	//linha com o resultado do primeiro index do array (so vai retornar um)
			
			$this->setIdusuario($row['idusuario']);//preenchendo os dados dos atributos da classe usuario
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row{'dtcadastro'})); //instanciando a data
			
		}
			
		
	}
	
	public static function getList(){//traz uma lista todos os logins
		$sql = new Sql();
		
		return $sql->select("SELECT*FROM tb_usuarios ORDER BY deslogin;");
	}
	
	public static function search($login){ //buscando pelo login
		$sql = new Sql();
		
		return $sql->select("SELECT*FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin",array(
		':SEARCH'=>"%".$login."%"
		));
	}
	
	public function login($login,$password){//buscando usuario por login e senha
		
		$sql = new Sql(); //instanciando a classe sql
		
		$results = $sql->select("SELECT*FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD",array(
		":LOGIN"=>$login, 
		":PASSWORD"=>$password	
			//passando um select para $results, parametro um array(como na classe Sql)
		));
		
		if(count($results) > 0){//count se o resultado for maior que zero
			$row = $results[0];	//linha com o resultado do primeiro index do array (so vai retornar um)
			
			$this->setIdusuario($row['idusuario']);//preenchendo os dados dos atributos da classe usuario
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row{'dtcadastro'})); //instanciando a data
			
		}else{
			throw new Exception("Usuario ou senha inválidos !!");
		}//pegando o erro caso nao haja nenum registro
	}
	
	public function setData($data){  
		$this->setIdusuario($data['idusuario']);//preenchendo os dados dos atributos da classe usuario
		$this->setDeslogin($data['deslogin']);
		$this->setDessenha($data['dessenha']);
		$this->setDtcadastro(new DateTime($data{'dtcadastro'})); //instanciando a data
		
		
		/*funcao setData para usar no lugar
		$row = $results[0];	//linha com o resultado do primeiro index do array (so vai retornar um)
			
			$this->setIdusuario($row['idusuario']);//preenchendo os dados dos atributos da classe usuario
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro(new DateTime($row{'dtcadastro'})); //instanciando a data */
			
	}
	
	public function insert(){//INSERT USANDO CALL, CHAMANDO PROCEDURE DO BANCO DE DADOS
		
		$sql = new Sql();
			//usado select pois retornou o last_insert_id da procedure
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)",array(
		":LOGIN"=>$this->getDeslogin(),
		":PASSWORD"=>$this->getDessenha()
		));
		
		if (count($results) > 0) {//retornou o select da procedure
			$this->setData($results[0]);
		}
	}
	
	public function update($login,$password){
		
		$this->setDeslogin($login);
		$this->setDessenha($password);
		
		
		$sql = new Sql();
		
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
		":LOGIN"=>$this->getDeslogin(),
		":PASSWORD"=>$this->getDessenha(),
		":ID"=>$this->getIdusuario()	
		
		));
		
	}
	
	
	//construct inicializar com "" caso nao passar os parametros
	public function __construct($login = "",$password = ""){
		$this->setDeslogin($login);
		$this->setDessenha($password);
	}
	
	public function __toString(){//metodo magico retornando json melhor formatado para mostrar na tela
//__toString somente chamar o objeto ex: echo $objeto;		
		return json_encode(array(//retornado um array com os dados da classe
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")//objeto formatando o datetime do atributo
		)); 
		
	}
	
	
	
}

?>