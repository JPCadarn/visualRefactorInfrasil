<?php

if(!empty($_GET)){
	switch($_GET['rota']){
		default:
			echo json_encode([
				'status' => 404,
				'message' => 'Rota não encontrada.'
			]);
			break;			
	}
}elseif(!empty($_POST)){
	switch($_POST['rota']){
		case 'testeId':
			echo json_encode([
				'status' => 200,
				'message' => 'deu boa ID'.$_POST['id']
			])
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