<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Escape Game</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 p-8">
    <h1 class="text-4xl font-bold text-center mb-8">Escape Game The Legend of Zelda : A Timeless story - Admin</h1>
    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 p-10 rounded drop-shadow-md">
        <div class="grid grid-cols-2 gap-8">
            <div>
                <h2 class="text-2xl mb-4 font-bold">Ajouter une question</h2>
                <a href="add_question.php" class="bg-blue-500 text-white p-2 rounded">Ajouter</a>
            </div>
            <div>
                <h2 class="text-2xl mb-4 font-bold">Liste des questions</h2>
                <a href="list_question.php" class="bg-green-500 text-white p-2 rounded">Liste</a>
            </div>
        </div>
        <div class="mt-8">
            <h2 class="text-2xl mb-4 font-bold">Liste des liens vers les questions</h2>
            <a href="list_link_question.php" class="bg-teal-500 text-white p-2 rounded">Liens</a>
        </div>
        <div class="mt-8">
            <h2 class="text-2xl mb-4 font-bold">Exporter la base de données</h2>
            <a href="export_database.php" class="bg-yellow-500 text-white p-2 rounded">Exporter</a>
        </div>
    </div>
</body>
</html>
