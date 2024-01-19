<?php
include("config.php");

// Fonction pour convertir le tableau en CSV et forcer le téléchargement
function exportToCSV($data, $filename) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    // Écrire les entêtes (noms de colonnes)
    fputcsv($output, array_keys($data[0]));

    // Écrire les données
    foreach ($data as $row) {
        fputcsv($output, $row);
    }

    fclose($output);
}

// Vérifiez si le formulaire a été soumis
if (isset($_POST["export"])) {
    // Commande pour exporter la base de données avec mysqldump
    $command = "mysqldump -u $username -p$password $dbname > escapegame.sql";
    
    // Exécutez la commande
    system($command);

    // Exporter les données vers un tableau
    $sql = "SELECT * FROM questions";
    $result = $conn->query($sql);
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'Question' => $row['question'],
            'Pourcentage de réussite' => ($row['total_reponses'] > 0) ? ($row['reponses_correctes'] / $row['total_reponses']) * 100 : 0,
        ];
    }

    // Exporter vers CSV
    exportToCSV($data, 'escapegame.csv');
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Export de la base de données</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 p-8">
    <a class="text-blue-500 hover:text-black" href="index.php">Retour</a>
        <div class="space-y-5 p-8">
            <h1 class="text-4xl mb-8 ">Export de la base de données</h1>
            
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <button type="submit" name="export" class="bg-blue-500 text-white px-4 py-2 rounded mr-4">
                    Exporter vers SQL
                </button>
            </form>

            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="export_excel" value="1">
                <button type="submit" name="export" class="bg-green-500 text-white px-4 py-2 rounded">
                    Exporter vers Excel
                </button>
            </form>  
        </div>

        

    </body>
</html>
