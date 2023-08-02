<?php
// Arquivo editar_colaborador.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $sorteio1 = $_POST['sorteio1'] == 'true' ? 1 : 0;
    $sorteio2 = $_POST['sorteio2'] == 'true' ? 1 : 0;
    $sorteio3 = $_POST['sorteio3'] == 'true' ? 1 : 0;

    if(isset($_FILES['arquivo'])){
        $arquivo = $_FILES['arquivo'];
        $nomeArquivo = $nome . '.png';
        if (file_exists('../imgs/' . $nomeArquivo)) {
            unlink('../imgs/' . $nomeArquivo);
        }
        $caminhoArquivo = '../imgs/' . $nomeArquivo;
        move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo);
    }

    // Conectar ao banco de dados
    require_once 'dbconfig.php';
    $conn = connectDB();

    // Consulta SQL para atualizar os dados do colaborador
    $sql = "UPDATE colaboradores SET nome = ?, email = ?, sorteio1 = ?, sorteio2 = ?, sorteio3 = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiii", $nome, $email, $sorteio1, $sorteio2, $sorteio3, $id);

    if ($stmt->execute()) {
        // Caso a atualização seja bem-sucedida
        $response = ['status' => 'success', 'message' => 'Colaborador atualizado com sucesso'];
        echo json_encode($response);
    } else {
        // Caso ocorra um erro na atualização
        http_response_code(500); // Internal Server Error
        $response = ['error' => 'Erro ao atualizar colaborador'];
        echo json_encode($response);
    }

    // Fechar a conexão e liberar os recursos
    $stmt->close();
    $conn->close();
} else {
    http_response_code(400); // Bad Request
    $response = ['error' => 'Requisição inválida'];
    echo json_encode($response);
}
?>
