<?php
require_once "../back/connection.php";
require_once "../back/queries.php";

$result = $conn->query($q1);

if ($result) {
    $list = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error: " . $conn->error;
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dispositivi</title>
</head>
<body>
    <h1>Elenco Dispositivi</h1>
    <a href="add_device.html">Aggiungi Dispositivo</a>
    <table border="1">
        <tr>
            <th>Codice</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>IP</th>
            <th>Posizione</th>
            <th>Data Installazione</th>
            <th>Bio</th>
            <th>Eventi</th>
        </tr>
        <?php foreach ($list as $device): ?>
            <tr>
                <td><?php echo htmlspecialchars($device['codice']); ?></td>
                <td><?php echo htmlspecialchars($device['nome']); ?></td>
                <td><?php echo htmlspecialchars($device['tipo']); ?></td>
                <td><?php echo htmlspecialchars($device['IP']); ?></td>
                <td><?php echo htmlspecialchars($device['posizione']); ?></td>
                <td><?php echo htmlspecialchars($device['data_installazione']); ?></td>
                <td><?php echo htmlspecialchars($device['bio']); ?></td>
                <td><a href="view_events.php?codice=<?php echo $device['codice']; ?>">Vedi Eventi</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
