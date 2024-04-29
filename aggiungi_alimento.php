<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Aggiungi Alimenti</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="back-button">
    <button onclick="window.location.href = 'gestione.php';">INDIETRO</button>
</div>

<div class="form-container">
<h1>AGGIUNGI ALIMENTO</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br>
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria" required>
            <option value="" selected disabled>Seleziona...</option>
            <?php
            // Connessione al database
            include 'config.php';

            // Query per ottenere le categorie di cibo
            $sql = "SELECT id, nome FROM categorie_alimenti";
            $result = $conn->query($sql);

            // Popolamento della combobox con le categorie di cibo
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                }
            } else {
                echo "<option value=''>Nessuna categoria trovata</option>";
            }

            $conn->close();
            ?>
        </select><br>
        <label for="calorie">Calorie (kcal/100g):</label>
        <input type="number" name="calorie" id="calorie" required><br>
        <label for="proteine">Proteine (g/100g):</label>
        <input type="number" name="proteine" id="proteine" required><br>
        <label for="carboidrati">Carboidrati (g/100g):</label>
        <input type="number" name="carboidrati" id="carboidrati" required><br>
        <label for="grassi">Grassi (g/100g):</label>
        <input type="number" name="grassi" id="grassi" required><br>
        <input type="submit" name="submit" value="Aggiungi Alimento">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $calorie = $_POST['calorie'];
    $proteine = $_POST['proteine'];
    $carboidrati = $_POST['carboidrati'];
    $grassi = $_POST['grassi'];
    $categoria_id = $_POST['categoria'];

    // Connessione al database
    include 'config.php';

    // Inserimento dell'alimento nella tabella alimenti
    $sql_insert_alimento = "INSERT INTO alimenti (nome, calorie, proteine, carboidrati, grassi, id_categoria) VALUES ('$nome', '$calorie', '$proteine', '$carboidrati', '$grassi', '$categoria_id')";

    if ($conn->query($sql_insert_alimento) === FALSE) {
        echo "Errore: " . $sql_insert_alimento . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

</body>
</html>
