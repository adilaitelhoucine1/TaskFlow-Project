<?php
session_start();
include_once 'user.php';
include_once 'task.php';
include_once 'bug.php';
include_once 'feature.php';
include_once 'Connect.php';

if (isset($_GET['id'])) {
    $task = new Task();
    $taskId = $_GET['id'];
    $taskDetails = $task->ShowTask($taskId);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Tâche</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans leading-relaxed">

    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="max-w-3xl w-full bg-white shadow-xl rounded-lg overflow-hidden">
            <?php if (!empty($taskDetails)) : ?>
                <div class="p-8">
                    <h1 class="text-3xl font-semibold text-gray-900 mb-6">
                        <?php echo htmlspecialchars($taskDetails[0]['title']); ?>
                    </h1>
                    <p class="text-gray-700 mb-6">
                        <strong>Description :</strong> <?php echo htmlspecialchars($taskDetails['description']); ?>
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                            <p class="text-sm text-gray-600">Assigné à :</p>
                            <p class="text-lg font-semibold text-gray-900"><?php echo htmlspecialchars($taskDetails['name']); ?></p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                            <p class="text-sm text-gray-600">Assigné à :</p>
                            <p class="text-lg font-semibold text-gray-900"><?php echo htmlspecialchars($taskDetails['created_at']); ?></p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                            <p class="text-sm text-gray-600">Statut</p>
                            <p class="text-lg font-semibold <?php echo $taskDetails['status'] === 'terminé' ? 'text-green-600' : 'text-red-600'; ?>">
                                <?php echo htmlspecialchars($taskDetails['status']); ?>
                            </p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                            <p class="text-sm text-gray-600">Type</p>
                            <p class="text-lg font-semibold <?php echo $taskDetails['type']?>">
                                <?php echo htmlspecialchars($taskDetails['type']); ?>
                            </p>
                        </div>
                    </div>
                    <div class="mt-6 text-center">
                        <a href="index.php" class="inline-block px-6 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                            Retour à la liste des tâches
                        </a>
                    </div>
                </div>
            <?php else : ?>
               
                <div class="p-8 text-center">
                    <p class="text-gray-700 text-lg">Aucune tâche trouvée pour cet ID.</p>
                    <a href="index.php" class="inline-block px-6 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200 mt-4">
                        Retour à la liste des tâches
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
