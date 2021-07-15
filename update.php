<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styleUpdate.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
    <title>SENAI | Almoxarifado</title>
    <?php
        include 'conexao_bd/conexao.php';
        session_start();
        if($_SESSION['usuario'] == ""){
    		header("location: login.php?msg=negado");
    	}
        if(isset($_GET['iduser'])) {
            $pegaId = $_GET['iduser'];
        }
    ?>
</head>
<body>
    <header>
        <div class="navheader">
            <div class="info-name">
                <div class="logo">SENAI</div>
                <div class="msg">Bem vindo, <?php echo $_SESSION['usuario']; ?></div>
            </div>
            <div class="btnMenu">
                <a href="home.php?user=<?php echo $_SESSION['usuario']?>"><input type="button" class='cancel' value="CANCELAR"></a>
            </div>
        </div>
    </header>
    <div class="container-atu">
		<div class="info-atu">
			<p>FINALIZAR ATUALIZAÇÃO</p>
		</div>
		<div class="area-atu">
            <form method="post" name="atualizar" action="verifica/verificaAtualiza.php">
            <?php
                $seleciona = "SELECT * FROM usuario WHERE ID = $pegaId;";
                $result = $conn->query($seleciona);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <label class='laID' for='IdUser'>ID:</label>
                        <input type='user' class='inID' name='IdUser' value='".$row["ID"]."'>
                        <label for='NomeUser'>TROCAR USUÁRIO:</label>
                        <input type='user' name='NomeUser' placeholder='Digite seu nome' value='".$row["Nome"]."'>
                        <label for='SenhaUser'>TROCAR SENHA:</label>
                        <input type='password' name='SenhaUser' placeholder='Digite sua senha' value='".$row["Senha"]."'>
                        <div class='confirmar'>
                            <button>SALVAR</button>
                        </div>
                        ";
                    }
                }    
                $conn->close();
            ?>
            </form>
		</div>
	</div>
</body>
</html>