<?php
setlocale(LC_ALL,"pt_BR", "pt_BR.utf-8", "portuguese");

spl_autoload_register(function($class_name){
//buscando na pasta classs	
	$filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";  /// por estar na mesma pasta ele acha a classe .php

	if(file_exists(($filename))){
		require_once($filename);
		
	}
		


});



?>