<?php
include("config.php");

if (isset($_GET["id"])) {
    $question_id = $_GET["id"];

    // Récupérer les informations de la question
    $sql = "SELECT * FROM questions WHERE id = $question_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $question = $row["question"];
        $pourcentage_reussite = ($row["total_reponses"] > 0) ? ($row["reponses_correctes"] / $row["total_reponses"]) * 100 : 0;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $reponse_utilisateur = $_POST["reponse_utilisateur"];
            $message = ($reponse_utilisateur === $row["reponse_attendue"]) ? $row["message_succes"] : $row["message_mauvaise_reponse"];

            // Mettre à jour les statistiques de la question
            $sql_update = "UPDATE questions SET total_reponses = total_reponses + 1";
            if ($reponse_utilisateur === $row["reponse_attendue"]) {
                $sql_update .= ", reponses_correctes = reponses_correctes + 1";
            }
            $sql_update .= " WHERE id = $question_id";

            $conn->query($sql_update);
        }
    } else {
        echo "Question non trouvée.";
        exit();
    }
} else {
    echo "ID de question non spécifié.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Répondre à la question</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1><?php echo $question; ?></h1>
    
    <p>Pourcentage de réussite : <?php echo number_format($pourcentage_reussite, 2); ?>%</p>

    <?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
    ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $question_id; ?>">
            <label for="reponse_utilisateur">Votre réponse :</label>
            <input type="text" name="reponse_utilisateur" required>
            <input type="submit" value="Valider">
        </form>
    <?php
    } else {
        echo "<p>$message</p>";
    }
    ?>
</body>
</html>
