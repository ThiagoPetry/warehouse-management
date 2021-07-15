<?PHP	
	include '../conexao_bd/conexao.php';
    session_start();
	$nome = $_SESSION["usuario"];

	$sql = "SELECT Status_porta FROM porta";
	$result = $conn->query($sql);
    $sFechada = "fechada";
    $sAberta = "aberta";
	
	if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $statusPorta = $row["Status_porta"];
        }

        $data = date('Ymdhis');

        if($statusPorta == $sAberta) {
            $sql = "UPDATE porta SET Status_porta = 'fechada'";
	        $result = $conn->query($sql);

            $registraLog = "INSERT INTO log_geral VALUES(null, '$nome', 'fechar', $data, 'fechada');";
            $result = $conn->query($registraLog);

            header("location: ../home.php?user=$nome&status=fechada");
        } else if($statusPorta == $sFechada) {
            $sql = "UPDATE porta SET Status_porta = 'aberta'";
	        $result = $conn->query($sql);

            $registraLog = "INSERT INTO log_geral VALUES(null, '$nome', 'abrir', $data, 'aberta');";
            $result = $conn->query($registraLog);

           header("location: ../home.php?user=$nome&status=aberta");
        }
	} else {  
        header("location: ../home.php?user=$nome");
	}
	$conn->close();
?>