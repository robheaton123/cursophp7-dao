<?php

require_once("config.php"); //require do config para registrar as classes
$hora = new DateTime();
echo($hora->format("d/m/Y H:i:s"));
/* $sql = new Sql();//instanciando vai buscar no spl_autoload em config.php a classe para registrar

$usuarios = $sql->select("SELECT*FROM tb_usuarios");

echo json_encode($usuarios);
//echo print_r($usuarios);        */

echo "<br><br>";

$user = new Usuario(); //busca na pasta, spl_autoload registra

$user->loadById(1);
print_r($user); //metodo __toString vai chamar o objeto em string
echo "<br><br>";
echo $user."  formato json encode";


?>