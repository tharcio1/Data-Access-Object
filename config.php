<?php 

	spl_autoload_register(function($className){

		$directory = "class";

		$fileName = $directory . DIRECTORY_SEPARATOR . $className.".php";

		if(file_exists($fileName)){
			require_once($fileName);
		}

	});

 ?>