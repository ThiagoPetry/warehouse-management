<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styleHome.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/vnd.microsoft.icon" />
    <script src="js/jsBtn.js"></script>
    <title>SENAI | Almoxarifado</title>
    <?php
        include 'conexao_bd/conexao.php';
        session_start();
        if($_SESSION['usuario'] == ""){
    		header("location: login.php?msg=negado");
    	}

        $sql = "SELECT Status_porta FROM porta";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $btnNome = $row["Status_porta"];
                $btnStatus = $row["Status_porta"];
            }
        }

        if($btnNome == "aberta") {
            $btnNome = "FECHAR";
            $btnStatus = "ABERTA";
        } else if($btnNome == "fechada") {
            $btnNome = "ABRIR";
            $btnStatus = "FECHADA";
        }

        $nome = "";
        if(isset($_GET['user'])) {
            $nome = $_GET['user'];
            if($nome == 'adm') {
                echo "<style type='text/css'>.btnMenu {display: block;}</style>
                      <style type='text/css'>.btnMenuAll {display: none;}</style>";
            } else {
                echo "<style type='text/css'>.btnMenu {display: none;}</style>
                <style type='text/css'>.btnMenuAll {display: block;}</style>";
            }
        }

        if(isset($_GET['status'])) {
			if($_GET['status'] == 'fechada') {
				echo "<style type='text/css'>#error {display: block;}</style>";
			}
			if($_GET['status'] == 'aberta') {
				echo "<style type='text/css'>#success {display: block;}</style>";
			}
            if($_GET['status'] == 'cadastrado') {
				echo "<style type='text/css'>#cadastrado {display: block;}</style>";
			}
            if($_GET['status'] == 'atualizado') {
				echo "<style type='text/css'>#atualizado {display: block;}</style>";
			}
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
                <a><input type="button" onclick="admin('cad')" value="CADASTRAR"></a>
                <a><input type="button" onclick="admin('atu')" value="ATUALIZAR"></a>
                <a><input type="button" onclick="admin('log')" value="LOG"></a>
                <a class="btnSair" href="index.html"><input type="button" value="SAIR" class="exit"></a>
            </div>
            <div class="btnMenuAll">
                <a class="btnSair" href="index.html"><input type="button" value="SAIR" class="exit"></a>
            </div>
        </div>
    </header>
    <div class="container-controle">
		<div class="info-controle">
			<p>STATUS DA PORTA</p>
            <button><?php echo $btnStatus; ?></button>
		</div>
        <div class="divisor"></div>
		<div class="area-controle">
            <form method="post" name="login" action="verifica/verificaPorta.php">
                <div class="confirmar">
                    <button><?php echo $btnNome; ?></button>
                </div>
            </form>
		</div>
	</div>
    <div id="cad" class="container-adm">
        <div class="container-info">
            <p>CADASTRAR USUÁRIO</p>
        </div>
        <div class="cadastro">
            <form method="post" name="cadastro" action="verifica/verificaCadastro.php">
                <div class="area-cad">
                    <label for="novoUser">USUÁRIO:</label>
                        <input type="user" placeholder="Nome do usuário" name="novoUser">
                    <label for="novoPwd">SENHA:</label>
                        <input type="password" placeholder="Senha do usuário" name="novoPwd">
                    <div class="confirmar-cad">
                        <button>CADASTRAR</button>
                        <input type="button" value="CANCELAR" onclick="fechaTela('cad')" class="btnCancelar">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="atu" class="container-adm">
        <div class="container-info">
            <p>ATUALIZAR USUÁRIO</p>
        </div>
        <div class="atualizar">
            <div class="table-atu">
                <table class="tb">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Senha</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Atualizar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $atu = "SELECT * FROM usuario ORDER BY ID ASC";
                            $result = $conn->query($atu);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr><th scope='row'>".$row["ID"].
                                    "</th><td>".$row["Nome"].
                                    "</td><td><input type='password' value='".$row["Senha"].
                                    "' disabled></td><td>".$row["Tipo"].
                                    "</td><td><a href='update.php?iduser=".$row["ID"]."'>
                                    <button class='btn-atu'><h3>EDITAR</h3><img src='img/engrenagem.svg'></button></a>
                                    </td><td><a href='verifica/verificaDelete.php?iduser=".$row["ID"]."'>
                                    <button class='btn-exc'><h3>DELETAR</h3><img src='img/delete.svg'></button></a>
                                    </td></tr>";
                                }
                            }                 
                        ?>
                    </tbody>
                </table>
            </div>  
            <div class="atu-voltar">
                <input type="button" value="VOLTAR" onclick="fechaTela('atu')">         
            </div>  
        </div>
    </div>
    <div id="log" class="container-adm">
        <div class="container-info">
            <p>LOG</p>
        </div>
        <div class="table-log">
            <table class="tb">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User</th>
                    <th scope="col">Ação</th>
                    <th scope="col">Data/Hora</th>
                    <th scope="col">Status_Porta</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $log = "SELECT * FROM log_geral ORDER BY ID ASC";
                        $result = $conn->query($log);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                            echo "<tr><th scope='row'>".$row["ID"].
                            "</th><td>".$row["Usuario"].
                            "</td><td>".$row["Acao"].
                            "</td><td>".$row["Data_e_Hora"].
                            "</td><td>".$row["Status_porta"]."</tr>";
                            }
                        } 
                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="log-voltar">
            <input type="button" value="VOLTAR" onclick="fechaTela('log')">         
        </div>
    </div>
    <div id="error" class="msg-status">
        <p>VOCÊ FECHOU A PORTA!</p>
    </div>
    <div id="success" class="msg-status">
        <p>VOCÊ ABRIU A PORTA!</p>
    </div>
    <div id="cadastrado" class="msg-status">
        <p>USUÁRIO CADASTRADO!</p>
    </div>
    <div id="atualizado" class="msg-status">
        <p>USUÁRIO ATUALIZADO!</p>
    </div>
    <?php 
        if($nome == 'adm') {
            $cad = "admin('cad')";
            $atu = "admin('atu')";
            $log = "admin('log')";
            echo "
            <style>#dropdownAdm {display: block; margin-top: 85vh; margin-left: 75vw; position: absolute;}</style>
            <div id='dropdownAdm' class='dropdown'>
                <button onclick='myFunction()' class='dropbtn'></button>
                <div id='myDropdown' class='dropdown-content'>
                    <a href='#' onclick=".$cad." value='CADASTRAR'>Cadastrar</a>
                    <a href='#' onclick=".$atu.">Atualizar</a>
                    <a href='#' onclick=".$log." value='LOG'>Log</a>
                    <a href='index.html' class='exit' onclick='<?php session_destroy();?>'>Sair</a>
                </div>
            </div>";
        } else {
            echo "
            <style>#dropdownUser {display: block; margin-top: 85vh; margin-left: 75vw; position: absolute;}
            .dropdown-content {margin-top: -45px}</style>
            <div id='dropdownUser' class='dropdown'>
                <button onclick='myFunction()' class='dropbtn'></button>
                <div id='myDropdown' class='dropdown-content'>
                    <a href='index.html' class='exit'>Sair</a>
                </div>
            </div>";
        }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
        setTimeout(function() {
            $('#error').fadeOut('fast');
            $('#success').fadeOut('fast');
            $('#cadastrado').fadeOut('fast');
            $('#atualizado').fadeOut('fast');
        }, 3000);
    </script>
</body>
</html>