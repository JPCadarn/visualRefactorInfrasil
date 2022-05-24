<?php

spl_autoload_register(function($class){
    require_once $class.'.php';
});

use Controllers\AgendamentosController;
use Controllers\ClientesController;
use Controllers\InspecoesController;
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
		case 'listarInspecoes':
			$Controller = new InspecoesController();
			echo json_encode($Controller->listarInspecoes($_POST));
			break;
		case 'listarUsuarios':
			$Controller = new UsuariosController();
			echo json_encode($Controller->listarUsuarios($_POST));
			break;
		case 'listarClientes':
			$Controller = new ClientesController();
			echo json_encode($Controller->listarClientes($_POST));
			break;
        case 'login':
            $Controller = new UsuariosController();
            echo json_encode($Controller->fazerLogin($_POST));
            break;
		case 'formularioPonte':
			$Controller = new PontesController();
			echo json_encode($Controller->gerarFormularioCadastroPonte($_POST));
			exit;
		case 'adicionarOAE':
			$Controller = new PontesController();
			echo json_encode($Controller->adicionarOae($_POST));
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