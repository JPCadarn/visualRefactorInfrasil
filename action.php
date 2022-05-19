<?php

spl_autoload_register(function($class){
    require_once 'src\\'.$class.'.php';
});

use Controllers\PontesController;

if(!empty($_GET)){
	switch($_GET['action']){
		default:
			echo json_encode([
				'status' => 404,
				'message' => 'Rota não encontrada.'
			]);
			break;			
	}
}elseif(!empty($_POST)){
	switch($_POST['action']){
		case 'listarPontes':
			$Controller = new PontesController();
            echo json_encode($Controller->listarPontes($_POST));
            break;
		default:
			echo json_encode([
				'status' => 404,
				'message' => 'Rota não encontrada.'
			]);
			break;			
	}
}else{
	echo json_encode([
		'status' => 404,
		'message' => 'Rota não encontrada.'
	]);
}

?>