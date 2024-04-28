<?php
session_start();
include 'config.php';

// Verifica del login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Controllo se l'input è una email o un username
    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $sql = "SELECT id, username, password, admin FROM utenti WHERE email = ?";
    } else {
        $sql = "SELECT id, username, password, admin FROM utenti WHERE username = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Login riuscito, impostazione della sessione
            $_SESSION['user_id'] = $user['id'];
            if ($user['admin'] == 1) {
                $_SESSION['role'] = 'admin';
            } else {
                $_SESSION['role'] = 'user';
            }
            header("Location: allenamento.php");
            exit();
        } else {
            echo "<p style='color: red; text-align: center;'>Credenziali errate. Riprova.</p>";
        }
    } else {
        echo "<p style='color: red; text-align: center;'>Credenziali errate. Riprova.</p>";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 20px;
}

.login-container {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-container h2 {
    text-align: center;
}

.login-container label {
    display: block;
    margin-bottom: 10px;
}

.login-container input[type="text"],
.login-container input[type="password"],
.login-container input[type="submit"],
.login-container a {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    box-sizing: border-box;
}

.login-container input[type="text"],
.login-container input[type="password"] {
    border: 1px solid #ccc;
}

.login-container input[type="submit"],
.login-container a {
    border: none;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
}

.login-container input[type="submit"]:hover,
.login-container a:hover {
    background-color: #e0e0e0;
}

.login-container input[type="submit"] {
    font-size: 16px;
}

.login-container a {
    font-size: 16px;
    text-decoration: none;
    background-color: #f2f2f2;
    text-align: center;
    color: #4CAF50;
    border: 1px solid #4CAF50;
    display: inline-block; /* Per far sì che il bottone si adatti alla larghezza del testo */
     /* 21px è la somma dei padding */
}
</style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form method="post">
        <label for="username">Username o Email:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" name="login" value="Accedi">
    </form>
    <a href="registra.php">Non hai un account? Registrati qui</a>
</div>

</body>
</html>
