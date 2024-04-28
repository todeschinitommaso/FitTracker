<?php
include 'config.php';

$error_message = "";

// Variabili per mantenere i valori inseriti dall'utente
$username_val = "";
$email_val = "";
$nome_val = "";
$cognome_val = "";
$data_nascita_val = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $data_nascita = $_POST['data_nascita'];

    // Manteniamo i valori inseriti dall'utente
    $username_val = $username;
    $email_val = $email;
    $nome_val = $nome;
    $cognome_val = $cognome;
    $data_nascita_val = $data_nascita;

    // Controllo se l'email è valida
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Email non valida";
    } elseif ($password !== $confirm_password) { // Controllo se le password coincidono
        $error_message = "Le password non coincidono";
    } else {
        // Hash della password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Inserimento dei dati nel database
        $sql = "INSERT INTO utenti (username, email, password, nome, cognome, data_nascita, admin) VALUES (?, ?, ?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $username, $email, $hashed_password, $nome, $cognome, $data_nascita);

        if ($stmt->execute()) {
            // Svuotiamo solo le variabili relative alle password
            unset($password);
            unset($confirm_password);

            header("Location: login.php");
            exit();
        } else {
            $error_message = "Si è verificato un errore durante la registrazione";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrazione</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 20px;
}

.registration-container {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.registration-container h2 {
    text-align: center;
}

.registration-container label {
    display: block;
    margin-bottom: 10px;
}

.registration-container input[type="text"],
.registration-container input[type="email"],
.registration-container input[type="password"],
.registration-container input[type="date"],
.registration-container input[type="submit"] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    box-sizing: border-box;
}

.registration-container input[type="text"],
.registration-container input[type="email"],
.registration-container input[type="password"],
.registration-container input[type="date"] {
    border: 1px solid #ccc;
}

.registration-container input[type="submit"] {
    border: none;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 16px;
}

.registration-container input[type="submit"]:hover {
    background-color: #45a049;
}

.error-message {
    color: red;
    text-align: center;
}
</style>
</head>
<body>

<div class="registration-container">
    <h2>Registrazione</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $username_val; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email_val; ?>" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <label for="confirm_password">Conferma Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $nome_val; ?>" required><br>
        <label for="cognome">Cognome:</label>
        <input type="text" name="cognome" id="cognome" value="<?php echo $cognome_val; ?>" required><br>
        <label for="data_nascita">Data di Nascita:</label>
        <input type="date" name="data_nascita" id="data_nascita" value="<?php echo $data_nascita_val; ?>" required><br>
        <input type="submit" value="Registrati">
    </form>
    <p class="error-message"><?php echo $error_message; ?></p>
</div>

</body>
</html>
