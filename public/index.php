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
    session_start();
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
    <section class="bg-gray-800 p-4 rounded-lg shadow-lg border-l-4 border-purple-500">
      <h2 class="text-lg font-bold text-purple-400 mb-4">🟣 Ouvert</h2>
      <ul class="space-y-4">
        <!-- Task Item -->
        <li class="bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-xl hover:scale-105 transition-transform">
          <h3 class="font-semibold text-purple-300 text-xl">⚙️ Corriger l'erreur 404</h3>
          <p class="mt-2 text-sm text-gray-400">Les utilisateurs reçoivent une erreur lors de la navigation.</p>
          <span class="block mt-4 text-xs text-gray-500">👤 Assigné à : Jean Dupont</span>
        </li>
      </ul>
    </section>

    <!-- Column: En Cours -->
    <section class="bg-gray-800 p-4 rounded-lg shadow-lg border-l-4 border-green-500">
      <h2 class="text-lg font-bold text-green-400 mb-4">🟢 En Cours</h2>
      <ul class="space-y-4">
        <li class="bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-xl hover:scale-105 transition-transform">
          <h3 class="font-semibold text-green-300 text-xl">📦 Migration des données</h3>
          <p class="mt-2 text-sm text-gray-400">Transférer la base de données vers AWS.</p>
          <span class="block mt-4 text-xs text-gray-500">👤 Assigné à : Alex Brown</span>
        </li>
      </ul>
    </section>

    <!-- Column: Terminé -->
    <section class="bg-gray-800 p-4 rounded-lg shadow-lg border-l-4 border-blue-500">
      <h2 class="text-lg font-bold text-blue-400 mb-4">🔵 Terminé</h2>
      <ul class="space-y-4">
        <li class="bg-gray-700 p-4 rounded-lg shadow-md hover:shadow-xl hover:scale-105 transition-transform">
          <h3 class="font-semibold text-blue-300 text-xl">✅ Implémenter le système d'authentification</h3>
          <p class="mt-2 text-sm text-gray-400">Les utilisateurs peuvent désormais se connecter.</p>
          <span class="block mt-4 text-xs text-gray-500">👤 Assigné à : Marie Curie</span>
        </li>
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

    <form action="add_task.php" method="POST">
      <!-- Titre -->
      <div class="mb-4">
        <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">Titre de la tâche</label>
        <input type="text" id="titre" name="titre" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
      </div>

      <!-- Type de tâche -->
      <div class="mb-4">
        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type de tâche</label>
        <select id="type" name="type" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="simple">simple</option>
          <option value="bug">Bug</option>
          <option value="feature">Feature</option>
        </select>
      </div>

      <!-- Statut -->
      <div class="mb-4">
        <label for="statut" class="block text-sm font-medium mb-2">Statut</label>
        <select id="statut" name="statut" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="Ouvert">Ouvert</option>
          <option value="En cours">En cours</option>
          <option value="Terminé">Terminé</option>
        </select>
      </div>

      <!-- Assigné à -->
      <div class="mb-4">
        <label for="assigne_id" class="block text-sm font-medium text-gray-700 mb-2">Assigné à</label>
        <select id="assigne_id" name="assigne_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">Non Assigné</option>
          <!-- Les options utilisateurs seront ajoutées dynamiquement -->
        </select>
      </div>

      <!-- Attributs spécifiques selon le type de tâche -->
      <div id="additionalFields"></div>

      <!-- Bouton Soumettre -->
      <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
          Ajouter la Tâche
        </button>
      </div>
    </form>
  </div>
</div>

<script src="script.js"></script>
</body>
</html>
