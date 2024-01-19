<?php include("config.php"); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une question</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <h1 class="text-4xl mb-8">Ajouter une question</h1>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $question = $_POST["question"];
        $reponse_attendue = $_POST["reponse_attendue"];
        $message_succes = $_POST["message_succes"];
        $message_mauvaise_reponse = $_POST["message_mauvaise_reponse"];

        $sql = "INSERT INTO questions (question, reponse_attendue, message_succes, message_mauvaise_reponse) 
                VALUES ('$question', '$reponse_attendue', '$message_succes', '$message_mauvaise_reponse')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $lien_question = "answer_question.php?id=" . $last_id;
            echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>
                    <strong class='font-bold'>Question ajoutée avec succès!</strong>
                    <span class='block sm:inline'>Lien pour répondre : <a href='$lien_question'>$lien_question</a></span>
                  </div>";
        } else {
            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
                    <strong class='font-bold'>Erreur lors de l'ajout de la question!</strong>
                    <span class='block sm:inline'>" . $conn->error . "</span>
                  </div>";
        }
    }
    ?>

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
