<?php
session_start();
include 'user.php'; 

if (isset($_POST['add']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];

    $user = new User();

    if ($user->existUser($username)) {
        $_SESSION['username'] = $username;

        $sql = "SELECT id FROM users WHERE name = ?";
        $stmt = $user->getConnection()->prepare($sql);
        $stmt->execute([$_SESSION['username']]);
        $result = $stmt->fetch();
        $_SESSION['user_id'] = $result['id'];


        header('Location: index.php'); 
        exit();
    } else {
        $user->addUser($username);
        $_SESSION['username'] = $username;

        $sql = "SELECT id FROM users WHERE name = ?";
        $stmt = $user->getConnection()->prepare($sql);
        $stmt->execute([$_SESSION['username']]);
        $result = $stmt->fetch();
        $_SESSION['user_id'] = $result['id'];

        header('Location: index.php'); 
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex justify-center items-center min-h-screen">
        <form action="" method="POST" class="p-6 bg-white rounded-lg shadow-md w-1/3">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Entrer Votre Nom : </label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="flex justify-end">
                <button type="submit" name="add" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Entrer
                </button>
            </div>
        </form>
    </div>
</body>
</html>
