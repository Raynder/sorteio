<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    require_once 'dbconfig.php';
    $conn = connectDB();

    $sql = "SELECT * FROM colaboradores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $colaborador = $result->fetch_assoc();

        header('Content-Type: application/json');
        echo json_encode($colaborador);
    } else {
        http_response_code(404); // Not Found
        $response = ['error' => 'Colaborador não encontrado'];
        echo json_encode($response);
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(400);
    $response = ['error' => 'Requisição inválida'];
    echo json_encode($response);
}
?>
