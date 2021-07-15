<?PHP	
	include '../conexao_bd/conexao.php';
    session_start();

	if(isset($_POST["user"]) && isset($_POST["pwd"])){
		$nome = $_POST["user"];
		$senha = $_POST["pwd"];
	}
	
	$sql = "SELECT Nome, Senha FROM usuario WHERE Nome = '$nome' AND Senha = '$senha'";
	$result = $conn->query($sql);
	
	if($result->num_rows > 0) {
        $_SESSION["usuario"] = $nome;
      header("location: ../home.php?user=$nome");
	} else {
	  header("location: ../login.php?user=$nome&msg=erro");
	}
	$conn->close();
?>