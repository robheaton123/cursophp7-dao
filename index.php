<?php

require_once("config.php"); //require do config para registrar as classes

$sql = new Sql();//instanciando vai buscar no spl_autoload em config.php a classe para registrar

$usuarios = $sql->select("SELECT*FROM tb_usuarios");

echo json_encode($usuarios);
//echo print_r($usuarios);

?>