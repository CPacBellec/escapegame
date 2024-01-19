<?php
include("config.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérifiez si le formulaire a été soumis pour changer l'ordre de tri
if (isset($_GET["tri"])) {
    $tri = $_GET["tri"];
    $sql = "SELECT *, IF(total_reponses > 0, (reponses_correctes / total_reponses) * 100, 0) as pourcentage_reussite FROM questions ORDER BY ";
    
    switch ($tri) {
        case "asc":
            $sql .= "pourcentage_reussite ASC";
            break;
        case "desc":
            $sql .= "pourcentage_reussite DESC";
            break;
        default:
            $sql .= "pourcentage_reussite ASC";
    }

    $result = $conn->query($sql);
} else {
    // Si aucune option de tri n'est spécifiée, triez par défaut en ordre ascendant
    $sql = "SELECT *, IF(total_reponses > 0, (reponses_correctes / total_reponses) * 100, 0) as pourcentage_reussite FROM questions ORDER BY pourcentage_reussite ASC";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des questions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <a class="text-blue-500 hover:text-black" href="index.php">Retour</a>
    <h1 class="text-4xl mb-8">Liste des questions</h1>

    <form method="get" class="mb-4">
        <label for="tri" class="mr-2">Trier par :</label>
        <select name="tri" onchange="this.form.submit()" class="px-2 py-1 border rounded">
            <option value="asc" <?php if (isset($_GET["tri"]) && $_GET["tri"] == "asc") echo "selected"; ?>>Croissant</option>
            <option value="desc" <?php if (isset($_GET["tri"]) && $_GET["tri"] == "desc") echo "selected"; ?>>Décroissant</option>
        </select>
    </form>

    <table class="border-collapse border" border="1">
        <thead>
            <tr>
                <th class="p-2">Question</th>
                <th class="p-2">Pourcentage de réussite</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td class="p-2"><?php echo $row["question"]; ?></td>
                    <td class="p-2"><?php echo number_format($row["pourcentage_reussite"], 2); ?>%</td>
                    <td class="p-2"><a href="delete_question.php?id=<?php echo $row["id"]; ?>" class="text-red-500">Supprimer</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
