<?php
include("config.php");

// Vérifiez si le formulaire a été soumis
if (isset($_POST["export"])) {
    // Commande pour exporter la base de données avec mysqldump
    $command = "mysqldump -u $username -p$password $dbname > escape_game.sql";
    
    // Exécutez la commande
    system($command);

    // Force le téléchargement du fichier exporté
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="escape_game.sql"');
    readfile('escape_game.sql');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Export de la base de données</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1>Export de la base de données</h1>
    
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="submit" name="export" value="Exporter la base de données">
    </form>
</body>
</html>
