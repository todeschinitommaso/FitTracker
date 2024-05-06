<?php
session_start();

include 'config.php';

if (!isset($_SESSION['user_id'])) {
    // Se l'utente non ha effettuato l'accesso, reindirizza alla pagina di accesso
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Seleziona i dati dell'utente dalla tabella "utenti"
$stmt = $conn->prepare("SELECT username, email, nome, cognome, data_nascita FROM utenti WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Dati dell'utente
    $username = $row['username'];
    $email = $row['email'];
    $nome = $row['nome'];
    $cognome = $row['cognome'];
    $data_nascita = $row['data_nascita'];
} else {
    echo "Nessun utente trovato";
}

$stmt->close();

// Se l'utente ha inviato il modulo
if (isset($_POST['submit'])) {
    // Prendi i dati inviati dal modulo
    $nome_mod = $_POST['nome'];
    $cognome_mod = $_POST['cognome'];
    $data_nascita_mod = $_POST['data_nascita'];
    
    // Verifica se entrambi i campi password sono stati compilati
    if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        // Se entrambe le password coincidono
        if ($password1 == $password2) {
            // Aggiorna i dati dell'utente nel database
            $stmt = $conn->prepare("UPDATE utenti SET nome = ?, cognome = ?, data_nascita = ?, password = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $nome_mod, $cognome_mod, $data_nascita_mod, $password1, $user_id);
            $stmt->execute();
            $stmt->close();

            // Aggiorna i dati dell'utente per visualizzarli nei campi del modulo
            $nome = $nome_mod;
            $cognome = $cognome_mod;
            $data_nascita = $data_nascita_mod;
        } else {
            // Password non corrispondenti, mostra un errore
            echo "<script>alert('Le password non corrispondono');</script>";
        }
    } else {
        // Aggiorna i dati dell'utente nel database senza modificare la password
        $stmt = $conn->prepare("UPDATE utenti SET nome = ?, cognome = ?, data_nascita = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nome_mod, $cognome_mod, $data_nascita_mod, $user_id);
        $stmt->execute();
        $stmt->close();

        // Aggiorna i dati dell'utente per visualizzarli nei campi del modulo
        $nome = $nome_mod;
        $cognome = $cognome_mod;
        $data_nascita = $data_nascita_mod;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Il mio account</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="back-button">
    <button onclick="window.location.href = 'index.php';">INDIETRO</button>
</div>

<div class="form-container">
    <h1>IL MIO ACCOUNT</h1>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>"><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>"><br>
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" value="<?php echo $cognome; ?>"><br>
        <label for="data_nascita">Data di nascita:</label>
        <input type="date" id="data_nascita" name="data_nascita" value="<?php echo $data_nascita; ?>"><br>
        <label for="password1">Nuova password:</label>
        <input type="password" id="password1" name="password1"><br>
        <label for="password2">Conferma password:</label>
        <input type="password" id="password2" name="password2"><br>
        <input type="submit" name="submit" value="Salva modifiche">
    </form>
</div>

</body>
</html>
