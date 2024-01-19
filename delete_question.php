<?php
include("config.php");

if (isset($_GET["id"])) {
    $question_id = $_GET["id"];

    // Supprimer la question de la base de données
    $sql = "DELETE FROM questions WHERE id = $question_id";
    $conn->query($sql);

    header("Location: list_question.php");
    exit();
} else {
    echo "ID de question non spécifié.";
    exit();
}
?>
