<?php

require_once 'dbconfig.php';
$conn = connectDB();

$sql = "SELECT * FROM colaboradores";
if(isset($_GET['sorteio']) && $_GET['sorteio'] == 1){
    $sql = "SELECT * FROM colaboradores WHERE sorteio1 = 1";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $colaboradores = array();

    while ($row = $result->fetch_assoc()) {
        $colaboradores[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($colaboradores);
} else {
    $colaboradores = array();
    header('Content-Type: application/json');
    echo json_encode($colaboradores);
}

$conn->close();
?>
