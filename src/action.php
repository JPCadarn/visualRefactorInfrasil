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
			break;
		case 'formularioAgendamento':
			$Controller = new AgendamentosController();
			echo json_encode($Controller->gerarFormularioCadastroAgendamento($_POST));
			break;
		case 'formularioUsuario':
			$Controller = new UsuariosController();
			echo json_encode($Controller->gerarFormularioCadastroUsuario($_POST));
			break;
		case 'alterarUsuario':
			$Controller = new UsuariosController();
			echo json_encode($Controller->gerarFormularioEdicaoUsuario($_POST));
			break;
		case 'formularioCliente':
			$Controller = new ClientesController();
			echo json_encode($Controller->gerarFormularioCadastroCliente($_POST));
			break;
		case 'alterarCliente':
			$Controller = new ClientesController();
			echo json_encode($Controller->gerarFormularioEdicaoCliente($_POST));
			break;
		case 'adicionarOAE':
			$Controller = new PontesController();
			echo json_encode($Controller->adicionarOae($_POST));
			break;
		case 'avaliarInspecao':
			$Controller = new InspecoesController();
			echo json_encode($Controller->avaliarInspecao($_POST));
			break;
		case 'formularioAvaliacaoInspecao':
			$Controller = new InspecoesController();
			echo json_encode($Controller->formularioAvaliacaoInspecao($_POST));
			break;
		case 'detalhesAgendamento':
			$Controller = new AgendamentosController();
			echo json_encode($Controller->detalhesAgendamento($_POST));
			break;
		case 'detalhesCliente':
			$Controller = new ClientesController();
			echo json_encode($Controller->detalhesCliente($_POST));
			break;
		case 'detalhesInspecao':
			$Controller = new InspecoesController();
			echo json_encode($Controller->detalhesInspecao($_POST));
			break;
		case 'detalhesPonte':
			$Controller = new PontesController();
			echo json_encode($Controller->detalhesPonte($_POST));
			break;
		case 'detalhesUsuario':
			$Controller = new UsuariosController();
			echo json_encode($Controller->detalhesUsuario($_POST));
			break;
		case 'editarInspecao':
			$Controller = new InspecoesController();
			echo json_encode($Controller->editarInspecao($_POST));
			break;
		case 'editarUsuario':
			$Controller = new InspecoesController();
			echo json_encode($Controller->editarUsuario($_POST));
			break;
		case 'listarConta':
			$Controller = new UsuariosController();
			echo json_encode($Controller->listarConta($_POST));
			break;
		case 'adicionarAgendamento':
			$Controller = new AgendamentosController();
			echo json_encode($Controller->adicionarAgendamento($_POST));
			break;
		case 'adicionarInspecao':
			$Controller = new InspecoesController();
			echo json_encode($Controller->adicionarInspecao($_POST));
			break;
		case 'adicionarUsuario':
			$Controller = new UsuariosController();
			echo json_encode($Controller->adicionarUsuario($_POST));
			break;
		case 'adicionarCliente':
			$Controller = new ClientesController();
			echo json_encode($Controller->adicionarCliente($_POST));
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