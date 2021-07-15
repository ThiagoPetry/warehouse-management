<?PHP	
	include '../conexao_bd/conexao.php';
    session_start();
    $nome =  $_SESSION["usuario"];

	if(isset($_POST["novoUser"]) && isset($_POST["novoPwd"])){
		$newNome = $_POST["novoUser"];
		$newSenha = $_POST["novoPwd"];
	}
	
	$sql = "INSERT INTO usuario VALUES (null, '$newNome', '$newSenha', 'Comum')";
	$result = $conn->query($sql);

    header("location: ../home.php?user=$nome&status=cadastrado");
	$conn->close();
?>