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
    <a class="text-blue-500 hover:text-black" href="index.php">Retour</a>

    <h1 class="text-4xl mb-8">Liste des questions</h1>

    <table class="border-collapse border" border="1">
        <thead>
            <tr>
                <th class="p-2">Question</th>
                <th class="p-2">Pourcentage de réussite</th>
                <th class="p-2">Actions</th>
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
                    <td class="p-2">
                        <a href="answer_question.php?id=<?php echo $row["id"]; ?>" class="text-blue-500">Répondre</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</body>
</html>
