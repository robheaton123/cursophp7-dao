<?php
//classe sql agora tem tudo da classe PDO (publico)
class Sql extends PDO {
	
	private $conn; //atributo para conexao
	
	public function __construct(){ //metodo construtor //instanciar a conexao ao inicia-la
		
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
		
	}
	
	private function setParams($statement, $parameters = array()){
//percorrendo $parameters, arrays que foram passados		
		foreach($parameters as $key => $value){
			
			$this->setParam($key,$value);
			
		}
		
	}
	
	private function setParam($statement,$key,$value){
		
		$statement->bindParam($key,$value);
		
	}
	
//recebendo uma $QueryBruta para depois ser tratada
	public function query($rawQuery,$params = array()){
		
		$stmt = $this->conn->prepare($rawQuery);
		
		$this->setParams($stmt,$params);
		
		$stmt->execute();
		
		return $stmt;
		
	}
	
	//metodo para o select
//retornando :array,
	public function select($rawQuery,$params = array()):array{ //retornar um array,fazendo um cast
		
		$stmt = $this->query($rawQuery,$params);
		
		//retornando fetch_assoc array somente com key e dados
		return $stmt->fetchALL(PDO::FETCH_ASSOC);
	}
	
}



















?>