<?php
session_start(); // Avvio della sessione

// Verifica se l'utente è autenticato come amministratore
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Se l'utente non è loggato o non ha il ruolo di admin, reindirizzalo alla pagina di accesso
    header("Location: login.php");
    exit; // Assicura che lo script termini dopo il reindirizzamento
}

include 'config.php'; // Include il file di configurazione del database

// Se è stata inviata una richiesta POST per l'aggiornamento dello stato admin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Se è stata inviata una richiesta per l'aggiornamento dello stato admin
    if (isset($_POST['action']) && $_POST['action'] === 'update_admin' && isset($_POST['user_id']) && isset($_POST['current_admin'])) {
        // Ottieni i dati dalla richiesta POST
        $user_id = $_POST['user_id'];
        $current_admin = $_POST['current_admin'];

        // Inverti lo stato admin
        $new_admin = ($current_admin == 1) ? 0 : 1;

        // Prepara e esegui l'istruzione SQL per aggiornare lo stato admin dell'utente nel database
        $sql_update = "UPDATE utenti SET admin = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $new_admin, $user_id);
        $stmt_update->execute();

        // Controlla se l'aggiornamento è avvenuto con successo
        if ($stmt_update->affected_rows > 0) {
            // Redirect per evitare il refresh del modulo POST
            header("Location: utenti.php");
            exit();
        } else {
            echo "<p>Errore durante l'aggiornamento dello stato admin dell'utente.</p>";
        }

        $stmt_update->close();
    }
    // Se è stata inviata una richiesta per l'eliminazione dell'account
    elseif (isset($_POST['action']) && $_POST['action'] === 'delete_account' && isset($_POST['user_id'])) {
        // Ottieni l'ID dell'utente da eliminare
        $user_id = $_POST['user_id'];

        // Prepara e esegui l'istruzione SQL per eliminare l'account dell'utente dal database
        $sql_delete = "DELETE FROM utenti WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $user_id);
        $stmt_delete->execute();

        // Controlla se l'eliminazione è avvenuta con successo
        if ($stmt_delete->affected_rows > 0) {
            // Redirect per evitare il refresh del modulo POST
            header("Location: utenti.php");
            exit();
        } else {
            echo "<p>Errore durante l'eliminazione dell'account dell'utente.</p>";
        }

        $stmt_delete->close();
    }
}

// Query per ottenere tutti i dati degli utenti
$sql_select = "SELECT id, username, email, nome, cognome, data_nascita, admin FROM utenti";
$result = $conn->query($sql_select);

$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Elenco Utenti</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
    body {
        padding-top: 50px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    button[type="submit"]{
        width: 70px;
        margin: 5px;
    }
    .action-buttons form {
        display: inline; /* Formattazione orizzontale */
        margin-right: 5px; /* Spazio tra i pulsanti */
    }
</style>
</head>
<body>

<div class="back-button">
    <button onclick="window.location.href = 'gestione.php';">INDIETRO</button>
</div>

<h1>Elenco degli Utenti Registrati</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Data di Nascita</th>
            <th>Admin</th>
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Verifica se ci sono risultati dalla query
        if ($result->num_rows > 0) {
            // Iterazione sui risultati
            while($row = $result->fetch_assoc()) {
                // Stampa dei dati dell'utente in una riga della tabella
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["username"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["nome"]."</td>";
                echo "<td>".$row["cognome"]."</td>";
                echo "<td>".$row["data_nascita"]."</td>";
                echo "<td>".($row["admin"] ? 'Sì' : 'No')."</td>";
                echo "<td class='action-buttons'>";
                // Form per l'aggiornamento dello stato admin
                echo "<form method='post'>";
                echo "<input type='hidden' name='user_id' value='".$row["id"]."'>";
                echo "<input type='hidden' name='current_admin' value='".$row["admin"]."'>";
                echo "<input type='hidden' name='action' value='update_admin'>";
                echo "<button type='submit'>Admin</button>";
                echo "</form>";
                // Form per l'eliminazione dell'account
                echo "<form method='post' onsubmit='return confirm(\"Sei sicuro di voler eliminare questo account?\")'>";
                echo "<input type='hidden' name='user_id' value='".$row["id"]."'>";
                echo "<input type='hidden' name='action' value='delete_account'>";
                echo "<button type='submit' style='background-color: red;'>Elimina</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            // Nessun utente trovato
            echo "<tr><td colspan='8'>Nessun utente trovato</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>