<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_FILES['arquivo'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $sorteio1 = $_POST['sorteio1'] == 'true' ? 1 : 0;
        $sorteio2 = $_POST['sorteio2'] == 'true' ? 1 : 0;
        $sorteio3 = $_POST['sorteio3'] == 'true' ? 1 : 0;
        $arquivo = $_FILES['arquivo'];
    
        $nomeArquivo = $nome . '.png';
        if (file_exists('../imgs/' . $nomeArquivo)) {
            unlink('../imgs/' . $nomeArquivo);
        }
        $caminhoArquivo = '../imgs/' . $nomeArquivo;
        move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo);
       
        require_once 'dbconfig.php';
        $conn = connectDB();
       
        $sql = "INSERT INTO colaboradores (nome, email, sorteio1, sorteio2, sorteio3) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiii", $nome, $email, $sorteio1, $sorteio2, $sorteio3);
       
        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Colaborador cadastrado com sucesso!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Erro ao cadastrar colaborador: ' . $stmt->error];
        }
       
        $stmt->close();
        $conn->close();
       
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    else{
        http_response_code(400);
        $response = ['error' => 'Arquivo não enviado'];
        echo json_encode($response);
    }
} else {
    http_response_code(405);
    $response = ['error' => 'Método não permitido'];
    echo json_encode($response);
}
?>