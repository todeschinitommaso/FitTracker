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
            echo "<p style='color: #e9e495; text-align: center;'>Credenziali errate. Riprova.</p>";
        }
    } else {
        echo "<p style='color: #e9e495; text-align: center;'>Credenziali errate. Riprova.</p>";
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
    background-image: url('img/sfondi/sfondobasic-small.png');
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    color: #e9e495;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    }

    @media only screen and (max-width: 600px) {
            body {
                background-image: url('img/sfondi/sfondobasic-small.png');
            }
        }

        /* Media query per schermi di dimensioni medie */
        @media only screen and (min-width: 601px) and (max-width: 1024px) {
            body {
                background-image: url('img/sfondi/sfondobasic-medium.png');
            }
        }

        /* Media query per schermi di grandi dimensioni */
        @media only screen and (min-width: 1025px) {
            body {
                background-image: url('img/sfondi/sfondobasic-large.png');
            }
        }
    .login-container {
        width: 100%;
        max-width: 400px; /* Limitiamo la larghezza massima del box */
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
        text-align: center;
        color: #56b98f;
    }

    .login-container label {
        display: block;
        margin-bottom: 10px;
        color: #56b98f;
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

    .login-container input[type="submit"] {
        border: none;
        background-color: #69c071;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s;
        font-size: 16px;
    }

    .login-container input[type="submit"]:hover {
        background-color: #56b98f;
    }

    .login-container a {
        display: block;
        text-align: center;
        text-decoration: none;
        color: #69c071; /* Verde */
        margin-top: 10px;
        margin-bottom: 0px;
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
    <a href="index.html">Torna alla Home</a>
</div>

</body>
</html>
