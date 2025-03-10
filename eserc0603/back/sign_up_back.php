<?php
 require_once "connection.php";
 // Ricezione dati dal form
$nome_utente = trim($_POST['nome_utente']);

$email = trim($_POST['email']);
$password = $_POST['password'];



// Controllo se l'email esiste già nel database
$check_email = $conn->prepare("SELECT email FROM utenti WHERE email = ?");
$check_email->bind_param("s", $email);
$check_email->execute();
$check_email->store_result();

if ($check_email->num_rows > 0) {

    header("Location: ../front/sign_up.php?error=email_exists");
    $conn->close();
    $check_email->close();
    exit();
}


$check_email->close();
try {
    // Hash della password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepariamo l'SQL per l'inserimento
    $sql = "INSERT INTO utenti (nome_utente, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome_utente, $email, $hashed_password);
    
    $stmt->execute();

    // Se l'operazione è andata a buon fine, reindirizza al login
    header("Location: ../front/log_in.php?success=registered");
    exit();

} catch (mysqli_sql_exception $e) {
    if ($conn->errno == 1062) { // 1062 = ER_DUP_ENTRY (email duplicata)
        header("Location: ../front/sign_up.php?error=email_exists");
    } else {
        header("Location: ../front/sign_up.php?error=db_error");
    
    exit();
}}

// Chiudi connessioni
$stmt->close();
$conn->close();



?>