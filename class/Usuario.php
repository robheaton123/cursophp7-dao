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
	
	public function __toString(){//metodo magico retornando json melhor formatado para mostrar na tela
		
		return json_encode(array(//retornado um array com os dados da classe
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")//objeto formatando o datetime do atributo
		)); 
		
	}
	
	
	
}

?>