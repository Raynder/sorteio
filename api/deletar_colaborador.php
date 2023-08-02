<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    require_once 'dbconfig.php';
    $conn = connectDB();

    $sql = "DELETE FROM colaboradores WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $response = ['status' => 'success', 'message' => 'Colaborador excluído com sucesso'];
        echo json_encode($response);
    } else {
        http_response_code(500); 
        $response = ['error' => 'Erro ao excluir colaborador'];
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
