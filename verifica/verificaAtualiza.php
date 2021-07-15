<?PHP
	include '../conexao_bd/conexao.php';
    session_start();
    $nome =  $_SESSION["usuario"];

    if(isset($_POST["IdUser"]) && isset($_POST["NomeUser"]) && isset($_POST["SenhaUser"])){
        $pegaId = $_POST['IdUser'];
        $pegaNome = $_POST["NomeUser"];
        $pegaSenha = $_POST["SenhaUser"];
    }
    
	$sql = "UPDATE usuario SET Nome = '$pegaNome', Senha = '$pegaSenha' WHERE ID = $pegaId;";
	$result = $conn->query($sql);
	header("location: ../home.php?user=$nome&status=atualizado");
?>


