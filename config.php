<?php
$servername = "localhost";
$username = "ceo"; // Nome utente del database
$password = "1234"; // Password del database
$dbname = "fittrack"; // Nome del database

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Controllo della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>
