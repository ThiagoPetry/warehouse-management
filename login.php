<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styleLogin.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
    <title>SENAI | Almoxarifado</title>
    <style>
        #msgErro {
            display: none;
        }
    </style>
    <?php
        $nome = "";
        if(isset($_GET['user'])) {
            $nome = $_GET['user'];
        }
        if(isset($_GET['msg'])) {
            if($_GET['msg'] == 'erro') {
                echo "<style type='text/css'>#msgErro {display: block;}</style>";
            }
        }
    ?>
</head>
<body>
    <header>
        <div class="navheader">
            <div class="info-name">
                <div class="logo">SENAI</div>
            </div>
        </div>
    </header>
    <div class="container-login">
		<div class="info-login">
			<p>FAÇA LOGIN PARA CONTINUAR</p>
		</div>
		<div class="area-login">
            <form method="post" name="login" action="verifica/verificaLogin.php">
                <label for="user">USUÁRIO:</label>
                <input type="user" name="user" placeholder="Digite seu nome" value="<?php echo $nome; ?>">
                <label for="pwd">SENHA:</label>
                <input type="password" name="pwd" placeholder="Digite sua senha">
                <div class="confirmar">
                    <button>ENTRAR</button>
                    <div id="msgErro">Usuário/Senha inválida!</div>
                </div>
            </form>
		</div>
	</div>
</body>
</html>