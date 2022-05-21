<?php
    spl_autoload_register(function($class){
        require_once 'src\\'.$class.'.php';
    });

    use Services\SessionService;

    if(!empty(SessionService::getIdUsuarioLogado())){
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Infrasil - O portal da infraestrutura brasileira</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link type="text/css" rel="stylesheet" href="assets/css/index.css"/>
	<link rel="icon" href="assets/Logo/logo_novo_clean.png" type="image/x-icon">
    <meta charset="UTF-8">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

<div class="center">
	<img class="responsive-img imagem-login" src="assets/Logo/logo_novo_corte.png" />
</div>

    <div class="container center">
        <div class="z-depth-1 grey lighten-4 row card-login">
            <form class="col s12" method="POST" id="formLogin" action='action.php'>
                <div class='row'>
                    <div class='input-field col s12'>
                        <input required type='text' name='login' id="usuario" autocomplete="off"/>
                        <label for='email'>Usuário</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12'>
                        <input required type='password' name='senha' id="senha" autocomplete="off"/>
                        <label for='password'>Senha</label>
                    </div>
                </div>
                <div class='row'>
                    <button type='submit' name='btn_login' class='indigo darken-4 col s12 btn btn-large waves-effect'>Login</button>
                </div>
            </form>
        </div>
    </div>

<!--JavaScript at end of body for optimized loading-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="assets/js/index.js"></script>
<script type="text/javascript" src="assets/js/ajax.js"></script>
</body>
</html>
