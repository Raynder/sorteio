<?php
// Arquivo update_colaborador.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $celular = $_POST['celular'];
    $cidade = $_POST['cidade'];

    // Conectar ao banco de dados
    require_once 'dbconfig.php';
    $conn = connectDB();

    // Consulta SQL para atualizar os dados do colaborador
    $sql = "UPDATE colaboradores SET nome = ?, email = ?, celular = ?, cidade = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nome, $email, $celular, $cidade, $id);

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
