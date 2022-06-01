<?php

spl_autoload_register(function($class){
	require_once $class.'.php';
});

$conexao = Conexao::conectar();
try{
	$conexao->beginTransaction();
	foreach($_FILES as $image){
		$nomeImagem = str_replace(['.', ',', '/', '\\'], '_', password_hash($image['name'], PASSWORD_BCRYPT)).'.'.explode('/', $image['type'])[1];
		$imagens[] = $nomeImagem;
		$destino = '../assets/fotos/'.$nomeImagem;
		if(rename($image['tmp_name'], $destino)){
			chmod($destino, 604);
			$sql = '
				INSERT INTO imagens_pontes
				(ponte_id, imagem, id_usuario)
				VALUES
				(:idPonte, :nomeImagem, :idUsuario)
			';
		}else{
			throw new Exception('Erro ao inserir imagens.');
		}
		$idPonte = $_POST['idOAE'];
		$idUsuario = \Services\SessionService::getIdUsuarioLogado();

		$stmt = $conexao->prepare($sql);
		$stmt->bindParam(':idPonte', $idPonte, PDO::PARAM_INT);
		$stmt->bindParam(':nomeImagem', $nomeImagem, PDO::PARAM_STR);
		$stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
		$stmt->execute();
		$pontes = $stmt->fetchAll();
		$conexao->commit();
	}
	return [
		'status' => 200,
		'type' => 'success',
		'message' => 'Imagens inseridas com sucesso para a OAE ID: '.$_POST['idOAE']
	];
}catch(Exception $e){
	$conexao->rollBack();
	return [
		'status' => 403,
		'type' => 'error',
		'message' => 'Erro ao inserir imagens para a OAE ID: '.$_POST['idOAE']
	];
}
