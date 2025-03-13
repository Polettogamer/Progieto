<?php
require_once "../back/connection.php";
require_once "../back/queries.php";

$codice = $_GET['codice'] ?? '';

if (!$codice) {
    echo "Codice dispositivo non fornito.";
    exit;
}

$stmt = $conn->prepare($q3);
$stmt->bind_param("s", $codice);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $events = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Errore nel recupero degli eventi: " . $conn->error;
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eventi Dispositivo</title>
</head>
<body>
    <h1>Eventi del Dispositivo <?php echo htmlspecialchars($codice); ?></h1>

    <a href="dashboard.php">Torna all'elenco dispositivi</a>
    <br>
    <a href="add_device.html">Aggiungi Dispositivo</a>

    <table border="1">
        <tr>
            <th>Data</th>
            <th>Tipo</th>
            <th>Messaggio</th>
            <th>Severità</th>
            <th>Utente</th>
        </tr>
        <?php if (empty($events)): ?>
            <tr>
                <td colspan="5">Nessun evento trovato per questo dispositivo.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($events as $event): ?>
                <tr>
                    <td><?php echo htmlspecialchars($event['data']); ?></td>
                    <td><?php echo htmlspecialchars($event['tipo']); ?></td>
                    <td><?php echo htmlspecialchars($event['messaggio']); ?></td>
                    <td><?php echo htmlspecialchars($event['severità']); ?></td>
                    <td><?php echo htmlspecialchars($event['utente']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    
</body>
</html>
