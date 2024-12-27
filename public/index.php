<?php
    session_start();
    include_once 'user.php';
    include_once 'task.php';
    include_once 'bug.php';
    include_once 'feature.php';

    // --------------------------------------------

    if (isset($_POST['add_task']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
          $titre = $_POST['titre'];
          $description = $_POST['description'];
          $type = $_POST['type'];
          $statut = $_POST['statut'];
          if (!empty($_POST['assigne_id'])) {
            $assignee_id = $_POST['assigne_id']; 
        } else {
            echo "<script>alert('Aucun utilisateur assigne.')</script>";
        }
        

            if ($type === 'simple') {
               $task =new Task();
               $task->AddTask($titre,$description,$statut,$assignee_id, $type);
              } elseif ($type === 'feature') {
                $functionality = $_POST['functionality'];
              
                $task = new Feature();

                $task->AddFeatureWithTask($titre, $description, $statut, $assignee_id, $type, $functionality);
            } elseif ($type === 'bug') {
                $severity = $_POST['urgence'];
                 $task = new Bug();
                $task->AddBugWithTask($titre,$description,$statut,$assignee_id, $type,$severity);
        
            }

            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
    }
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $taskId = $_POST['task_id'];
        $newStatus = $_POST['new_status'];
    
        if (!empty($taskId) && !empty($newStatus)) {
            $task = new Task();
            $isUpdated = $task->updateTaskStatus($taskId, $newStatus);
    
            if ($isUpdated) {
                header('Location: index.php'); 
                exit;
            } else {
                echo 'Erreur lors de la mise à jour du statut.';
            }
        } else {
            echo 'invalid data.';
        }
    }
  
    

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskFlow - Design Unique</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Pacifico&display=swap');
    body {
      font-family: 'Nunito', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 min-h-screen text-gray-300">
  <nav class="bg-gradient-to-r from-purple-800 to-purple-600 p-6 shadow-lg flex items-center justify-between">
  <h1 class="text-3xl font-pacifico text-white capitalize font-bold"> Welcome 
  <?php 
    echo $_SESSION['username'];
    echo $_SESSION['user_id'];
    ?></h1>
    <div class="flex gap-4 items-center">
      <input
        type="text"
        placeholder="🔍 Rechercher..."
        class="px-4 py-2 w-80 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 outline-none"
      />
      <button id="open-modal" class="px-6 py-2 bg-purple-700 text-white rounded-lg hover:bg-purple-800 transition">
        + Ajouter une Tâche
      </button>
    </div>
  </nav>

  <main class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Open Tasks -->
    <section class="bg-gray-800 p-4 rounded-lg shadow-lg border-l-4 border-purple-500">
    <h2 class="text-lg font-bold text-purple-400 mb-4">🟣 Ouvert</h2>
    
    <ul class="space-y-4">
        <?php
        $task = new Task();
        $openTasks = $task->getTasksByStatus('Ouvert');
        foreach ($openTasks as $taskItem) {
          echo '<li class="bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-xl hover:scale-105 transition-transform">';
          echo '<h3 class="font-semibold text-purple-300 text-xl">' . htmlspecialchars($taskItem['title']) . '</h3>';
          echo '<span class="text-sm text-gray-500">status : ' . htmlspecialchars($taskItem['status']) . '</span><br>';
            echo '<p class="text-gray-400 mt-2">' . htmlspecialchars($taskItem['description']) . '</p>';
            echo '<div class="mt-4 flex justify-between items-center">';
            echo '<span class="text-sm text-gray-500">Assigné à: ' . htmlspecialchars($taskItem['assignee_name']) . '</span><br>';
            

            // if (($taskItem['type']) == 'simple') {
            //     echo '<span class="text-sm text-green-500">Type: Simple</span>';
            // } elseif (($taskItem['type']) == 'feature') {
            //     echo '<span class="text-sm text-blue-500">Type: Feature</span>';
            // } elseif (($taskItem['type']) == 'bug') {
            //     echo '<span class="text-sm text-red-500">Type: Bug</span>';
            // }

            echo '<form method="GET" action="update_status.php" class="mt-4">';
            echo '<input type="hidden" name="task_id" value="' . htmlspecialchars($taskItem['id']) . '">';
            echo '<select name="new_status" class="text-gray-700 p-1 rounded-lg">';
            echo '<option value="En cours">🟠 En cours</option>';
            echo '<option value="Terminé">🟢 Terminé</option>';
            echo '</select>';
            echo '<button type="submit" name="modifier_task" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Modifier</button>';
            echo '</form>';

            echo '</div>';
            echo '</li>';
        }
        ?>
    </ul>
</section>


    <!-- In Progress Tasks -->
    <section class="bg-gray-800 p-4 rounded-lg shadow-lg border-l-4 border-blue-500">
        <h2 class="text-lg font-bold text-blue-400 mb-4">🔵 En cours</h2>
        <ul class="space-y-4">
            <?php
            $task = new Task();
            $inProgressTasks = $task->getTasksByStatus('En cours');
            foreach ($inProgressTasks as $taskprogress) {
              echo '<li class="bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-xl hover:scale-105 transition-transform">';
              echo '<h3 class="font-semibold text-purple-300 text-xl">'. htmlspecialchars($taskprogress['title']) .'</h3>';
              echo '<p class="text-gray-400 mt-2">'. htmlspecialchars($taskprogress['description']) .'</p>';
              echo '<div class="mt-4 flex justify-between items-center">';
              echo '<span class="text-sm text-gray-500">Assigné à: '. htmlspecialchars($taskprogress['assignee_name']) .'</span>';

            //   if(($taskItem['type'])=='simple'){
            //     echo '<span class="text-sm text-green-500">Type: Simple</span>';
            // }elseif(($taskItem['type'])=='feature'){
            //     echo '<span class="text-sm text-blue-500">Type: Feature</span>';
            // }elseif(($taskItem['type'])=='bug'){
            //     echo '<span class="text-sm text-red-500">Type: Bug</span>';
            // }

            echo '<form method="GET" action="update_status.php" class="mt-4">';
            echo '<input type="hidden" name="task_id" value="' . htmlspecialchars($taskItem['id']) . '">';
            echo '<select name="new_status" class="text-gray-700 p-1 rounded-lg">';
            echo '<option value="En cours">🟠 En cours</option>';
            echo '<option value="Terminé">🟢 Terminé</option>';
            echo '</select>';
            echo '<button type="submit" name="modifier_task" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Modifier</button>';
            echo '</form>';


              echo '</div>';
              echo '</li>';
          }
            ?>
        </ul>
    </section>

    <!-- Completed Tasks -->
    <section class="bg-gray-800 p-4 rounded-lg shadow-lg border-l-4 border-green-500">
        <h2 class="text-lg font-bold text-green-400 mb-4">🟢 Terminé</h2>
        <ul class="space-y-4">
            <?php
            $task = new Task();
            $completedTasks = $task->getTasksByStatus('Terminé');
            foreach ($completedTasks as $taskprogress) {
              echo '<li class="bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-xl hover:scale-105 transition-transform">';
              echo '<h3 class="font-semibold text-purple-300 text-xl">'. htmlspecialchars($taskprogress['title']) .'</h3>';
              echo '<p class="text-gray-400 mt-2">'. htmlspecialchars($taskprogress['description']) .'</p>';
              echo '<div class="mt-4 flex justify-between items-center">';
              echo '<span class="text-sm text-gray-500">Assigné à: '. htmlspecialchars($taskprogress['assignee_name']) .'</span>';

            //   if(($taskItem['type'])=='simple'){
            //     echo '<span class="text-sm text-green-500">Type: Simple</span>';
            // }elseif(($taskItem['type'])=='feature'){
            //     echo '<span class="text-sm text-blue-500">Type: Feature</span>';
            // }elseif(($taskItem['type'])=='bug'){
            //     echo '<span class="text-sm text-red-500">Type: Bug</span>';
            // }
            

            echo '<form method="GET" action="update_status.php" class="mt-4">';
            echo '<input type="hidden" name="task_id" value="' . htmlspecialchars($taskItem['id']) . '">';
            echo '<select name="new_status" class="text-gray-700 p-1 rounded-lg">';
            echo '<option value="En cours">🟠 En cours</option>';
            echo '<option value="Terminé">🟢 Terminé</option>';
            echo '</select>';
            echo '<button type="submit" name="modifier_task" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Modifier</button>';
            echo '</form>';



            
              echo '</div>';
              echo '</li>';
          }
            ?>
        </ul>
    </section>
</main>


 <!-- Modal -->
<div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-bold text-gray-800">Ajouter une Nouvelle Tâche</h2>
      <button id="close-modal" class="text-gray-500 hover:text-gray-800 text-xl">&times;</button>
    </div>

    <form action="" method="POST">
      <!-- Titre -->
      <div class="mb-4">
        <label for="titre" class="block text-sm font-medium  text-black  mb-2">Titre de la tâche</label>
        <input type="text" id="titre" name="titre" class=" text-black  w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label for="description" class="block text-sm font-medium  text-black  mb-2">Description</label>
        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border rounded-lg  text-black  focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
      </div>

      <!-- Type de tâche -->
      <div class="mb-4">
        <label for="type" class="block text-sm font-medium text-black  mb-2">Type de tâche</label>
        <select id="type" name="type" class="w-full px-4 py-2 border  text-black  rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="simple">simple</option>
          <option value="bug">Bug</option>
          <option value="feature">Feature</option>
        </select>
      </div>

      <!-- Statut -->
      <div class="mb-4">
        <label for="statut" class="block text-sm font-medium mb-2  text-black ">Statut</label>
        <select id="statut" name="statut" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500  text-black ">
          <option value="Ouvert">Ouvert</option>
          <option value="En cours">En cours</option>
          <option value="Terminé">Terminé</option>
        </select>
      </div>

      <div class="mb-4">
        <label for="assigne_id" class="block text-sm font-medium text-gray-700 mb-2">Assigné à</label>
        <select id="assigne_id" name="assigne_id" class="w-full text-black px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Non Assigné</option>
          <?php
            $user=new User();
           $Allusers= $user->ShowAllUsers();
           foreach($Allusers as $user){
            echo "<option value='" . $user['id'] . "'>" . $user['name'] . "</option>";
          }
          ?>
        </select>
      </div>

     

      <!-- Attributs spécifiques selon le type de tâche -->
      <div id="additionalFields">


      </div>

      <!-- Bouton Soumettre -->
      <div class="flex justify-end">
        <button type="submit" name="add_task" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
          Ajouter la Tâche
        </button>
      </div>
    </form>
  </div>
</div>

<script src="script.js"></script>
</body>
</html>
