<?PHP
	include '../conexao_bd/conexao.php';
    session_start();
	$nome = $_SESSION["usuario"];

	if(isset($_GET["iduser"])){
		$id = $_GET["iduser"];
	}

	$sql = "DELETE FROM usuario WHERE ID = $id";
	$result = $conn->query($sql);
	header("location: ../home.php?user=$nome&status=apagado");
?>