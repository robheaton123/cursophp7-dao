<?php

require_once("config.php"); //require do config para registrar as classes//quando instancia registra
$hora = new DateTime();
echo($hora->format("d/m/Y H:i:s"));

echo "<br><br>";

/* $sql = new Sql();//instanciando vai buscar no spl_autoload em config.php a classe para registrar

$usuarios = $sql->select("SELECT*FROM tb_usuarios"); //retornou um array

echo json_encode($usuarios);
//echo print_r($usuarios);        */

/* echo "<br><br>";/
////////////Load by ID carregando dados na classe Usuario/////////////////////////////////////////////////////////////

$user = new Usuario(); //busca na pasta, spl_autoload registra

$user->loadById(1);
print_r($user); //metodo __toString vai chamar o objeto em string
echo "<br><br>";
echo $user."  formato json encode"; //usando metodo magico __toString

echo "<br><br>";
////////TRAZENDO UMALISTA DOS USUARIOS//////////////////////////////////////////////////////////////////

$lista = Usuario::getList();  //metodo statico

echo json_encode($lista);

echo "<br><br>";////////////////////////BUSCANDO LOGIN COM LIKE % ///////////////////////////////////////

$busLogin = Usuario::search("MA"); //buscando pelo login

echo json_encode($busLogin);

echo "<br><br>";
//////////////////////metodo magico __toString retornando objeto em String ///////////////////////////////////////////////

echo $user; // __toString metodo magico

//echo json_encode($logPas);

echo "<br><br>";
//////////////////////////////////////INSERT///////////////////////////////////////////		*/
/*
$user = new Usuario("BEBE","TESTE");//param = login,senha

$user->insert();    ///insert retornando o id que esta preenchendo a classe Usuario

echo $user; //__toString */
///////////////////////////////////////////UPDATE  /////////////////
/*
$upd = new Usuario();

$upd->loadById(16); //carregou o id 16 na classe Usuario

$upd->update("Professor","student");   //alterou os dois parametros no banco

echo $upd;  //__toString
					*/
//////////////////////////DELETE  ///////////////////////////


?>