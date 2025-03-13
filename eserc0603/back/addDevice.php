<?php
require_once "../back/connection.php";
require_once "../back/queries.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $tipo = $_POST['tipo'] ?? '';
    $ip = $_POST['ip'] ?? '';
    $posizione = $_POST['posizione'] ?? '';
    $data_installazione = $_POST['data_installazione'] ?? '';
    $bio = $_POST['bio'] ?? null;

    $stmt = $conn->prepare($q2);
    $stmt->bind_param("ssssss", $nome, $tipo, $ip, $posizione, $data_installazione, $bio);

    if ($stmt->execute()) {
        header("Location: ../front/dashboard.php");
        exit;
    } else {
        echo "<script>alert('Errore durante l\'aggiunta del dispositivo: " . $conn->error . "');</script>";
        header("Location: ../front/dashboard.php");
        exit;
    }

    $stmt->close();
}
$conn->close();
?>
