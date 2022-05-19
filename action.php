<?php

spl_autoload_register(function($class){
    require_once 'src\\'.$class.'.php';
});

use Controllers\AgendamentosController;
use Controllers\PontesController;
use Controllers\UsuariosController;

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
		case 'listarAgendamentos':
			$Controller = new AgendamentosController();
			echo json_encode($Controller->listarAgendamentos($_POST));
			break;
        case 'login':
            $Controller = new UsuariosController();
            echo json_encode($Controller->fazerLogin($_POST));
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