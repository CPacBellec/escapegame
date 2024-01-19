<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $reponse_attendue = $_POST["reponse_attendue"];
    $message_succes = $_POST["message_succes"];
    $message_mauvaise_reponse = $_POST["message_mauvaise_reponse"];

    // Utilisation de requêtes préparées pour éviter les problèmes de sécurité
    $sql = "INSERT INTO questions (question, reponse_attendue, message_succes, message_mauvaise_reponse) VALUES (?, ?, ?, ?)";
    
    // Préparation de la requête
    $stmt = $conn->prepare($sql);

    // Liaison des paramètres
    $stmt->bind_param("ssss", $question, $reponse_attendue, $message_succes, $message_mauvaise_reponse);

    // Exécution de la requête
    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
        $lien_question = "answer_question.php?id=" . $last_id;
        echo "Question ajoutée avec succès ! Lien pour répondre : <a href='$lien_question'>$lien_question</a>";
    } else {
        echo "Erreur lors de l'ajout de la question : " . $stmt->error;
    }

    // Fermeture du statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une question</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <a class="text-blue-500 hover:text-black" href="index.php">Retour</a>
    <h1 class="text-4xl mb-8 text-center">Ajouter une question</h1>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
        <label for="question" class="block text-gray-700 font-bold mb-2">Question :</label>
        <textarea name="question" required class="w-full px-3 py-2 border rounded mb-3"></textarea>

        <label for="reponse_attendue" class="block text-gray-700 font-bold mb-2">Réponse attendue :</label>
        <input type="text" name="reponse_attendue" required class="w-full px-3 py-2 border rounded mb-3">

        <label for="message_succes" class="block text-gray-700 font-bold mb-2">Message de succès :</label>
        <textarea name="message_succes" required class="w-full px-3 py-2 border rounded mb-3"></textarea>

        <label for="message_mauvaise_reponse" class="block text-gray-700 font-bold mb-2">Message de mauvaise réponse :</label>
        <textarea name="message_mauvaise_reponse" required class="w-full px-3 py-2 border rounded mb-3"></textarea>

        <input type="submit" value="Ajouter" class="bg-blue-500 text-white px-4 py-2 rounded">
    </form>
</body>
</html>
