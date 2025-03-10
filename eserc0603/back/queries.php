<?php
    require_once "connection.php";

    $q1 = "SELECT * FROM dispositivi";
    $q2 = "INSERT INTO dispositivi (nome, tipo, IP, posizione, data_installazione, bio)
            VALUES (?,?,?,?,?,?)";
    $q3 = "SELECT * FROM eventi WHERE dispositivo = ?";
    $q4 = "INSERT INTO eventi (data, tipo, messaggio, severità, utente, dispositivo)
            VALUES (?, ?, ?, ?, ?, ?)";




?>