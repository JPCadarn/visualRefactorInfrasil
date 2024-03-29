<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function($class){
    $class = str_replace('\\', '/', $class);
    require_once $class.'.php';
});

use Controllers\AgendamentosController;
use Controllers\ClientesController;
use Controllers\InspecoesController;
use Controllers\PontesController;
use Controllers\UsuariosController;
use Services\SessionService;

if(!empty($_GET)){
	switch($_GET['action']){
        case 'getDadosDashboard':
            $Controller = new InspecoesController();
            echo json_encode($Controller->getDadosDashboard($_GET));
            break;
        case 'imprimirPonte':
            $Controller = new PontesController();
            echo json_encode($Controller->imprimirPonte($_GET));
            break;
		default:
			echo json_encode([
				'status' => 404,
				'message' => 'Rota não encontrada.'
			]);
			break;			
	}
}elseif(!empty($_POST)){
	switch($_POST['action']){
		case 'listarAgendamentos':
			$Controller = new AgendamentosController();
			echo json_encode($Controller->listarAgendamentos($_POST));
			break;
		case 'formularioAgendamento':
			$Controller = new AgendamentosController();
			echo json_encode($Controller->gerarFormularioCadastroAgendamento($_POST));
			break;
		case 'adicionarAgendamento':
			$Controller = new AgendamentosController();
			echo json_encode($Controller->adicionarAgendamento($_POST));
			break;
		case 'gerarFormularioEdicaoAgendamento':
			$Controller = new AgendamentosController();
			echo json_encode($Controller->gerarFormularioEdicaoAgendamento($_POST));
			break;
		case 'editarAgendamento':
			$Controller = new AgendamentosController();
			echo json_encode($Controller->editarAgendamento($_POST));
			break;
		case 'listarPontes':
			$Controller = new PontesController();
            echo json_encode($Controller->listarPontes($_POST));
            break;
		case 'formularioPonte':
			$Controller = new PontesController();
			echo json_encode($Controller->gerarFormularioCadastroPonte($_POST));
			break;
		case 'adicionarOAE':
			$Controller = new PontesController();
			echo json_encode($Controller->adicionarOae($_POST));
			break;
		case 'detalhesPonte':
			$Controller = new PontesController();
			echo json_encode($Controller->detalhesPonte($_POST));
			break;
		case 'editarUsuario':
			$Controller = new UsuariosController();
			echo json_encode($Controller->editarUsuario($_POST));
			break;
		case 'listarConta':
			$Controller = new UsuariosController();
			echo json_encode($Controller->listarConta($_POST));
			break;
		case 'adicionarUsuario':
			$Controller = new UsuariosController();
			echo json_encode($Controller->adicionarUsuario($_POST));
			break;
		case 'listarUsuarios':
			$Controller = new UsuariosController();
			echo json_encode($Controller->listarUsuarios($_POST));
			break;
		case 'formularioUsuario':
			$Controller = new UsuariosController();
			echo json_encode($Controller->gerarFormularioCadastroUsuario($_POST));
			break;
		case 'formularioEdicaoUsuario':
			$Controller = new UsuariosController();
			echo json_encode($Controller->gerarFormularioEdicaoUsuario($_POST));
			break;
		case 'login':
			$Controller = new UsuariosController();
			echo json_encode($Controller->fazerLogin($_POST));
			break;
        case 'logout':
            $Controller = new UsuariosController();
            echo json_encode($Controller->fazerLogout());
            break;
		case 'excluirUsuario':
			$Controller = new UsuariosController();
			echo json_encode($Controller->excluirUsuario($_POST));
			break;
		case 'listarClientes':
			$Controller = new ClientesController();
			echo json_encode($Controller->listarClientes($_POST));
			break;
		case 'formularioCliente':
			$Controller = new ClientesController();
			echo json_encode($Controller->gerarFormularioCadastroCliente($_POST));
			break;
		case 'alterarCliente':
			$Controller = new ClientesController();
			echo json_encode($Controller->gerarFormularioEdicaoCliente($_POST));
			break;
		case 'adicionarCliente':
			$Controller = new ClientesController();
			echo json_encode($Controller->adicionarCliente($_POST));
			break;
		case 'editarCliente':
			$Controller = new ClientesController();
			echo json_encode($Controller->editarCliente($_POST));
			break;
		case 'excluirCliente':
			$Controller = new ClientesController();
			echo json_encode($Controller->excluirCliente($_POST));
			break;
		case 'formularioAvaliacaoInspecao':
			$Controller = new InspecoesController();
			echo json_encode($Controller->formularioAvaliacaoInspecao($_POST));
			break;
		case 'avaliarInspecao':
			$Controller = new InspecoesController();
			echo json_encode($Controller->avaliarInspecao($_POST));
			break;
		case 'listarInspecoes':
			$Controller = new InspecoesController();
			echo json_encode($Controller->listarInspecoes($_POST));
			break;
		case 'detalhesInspecao':
			$Controller = new InspecoesController();
			echo json_encode($Controller->detalhesInspecao($_POST));
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
