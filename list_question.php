<?php
include("config.php");

// Récupérer la liste des questions
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des questions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-4xl mb-8">Liste des questions</h1>

    <form method="get" class="mb-4">
        <label for="tri" class="mr-2">Trier par :</label>
        <select name="tri" onchange="this.form.submit()" class="px-2 py-1 border rounded">
            <option value="asc">Croissant</option>
            <option value="desc">Décroissant</option>
        </select>
    </form>

    <?php
    $tri = isset($_GET["tri"]) ? $_GET["tri"] : "asc";
    $sql = "SELECT * FROM questions ORDER BY pourcentage_reussite $tri";
    $result = $conn->query($sql);
    ?>
    
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
                $pourcentage_reussite = ($row["total_reponses"] > 0) ? ($row["reponses_correctes"] / $row["total_reponses"]) * 100 : 0;
            ?>
                <tr>
                    <td class="p-2"><?php echo $row["question"]; ?></td>
                    <td class="p-2"><?php echo number_format($pourcentage_reussite, 2); ?>%</td>
                    <td class="p-2"><a href="delete_question.php?id=<?php echo $row["id"]; ?>" class="text-red-500">Supprimer</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
