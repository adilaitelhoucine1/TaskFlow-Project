<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskFlow - Gestion de Tâches</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex">

  <!-- Sidebar -->
  <aside class="w-64 bg-gradient-to-b from-blue-900 to-blue-700 text-white flex flex-col">
    <div class="p-6 text-2xl font-bold border-b border-blue-600">
      TaskFlow
    </div>
    <nav class="flex-grow mt-6">
      <ul>
        <li class="px-6 py-3 hover:bg-blue-600 transition-all cursor-pointer">
          <a href="#" class="flex items-center gap-2">
            <span class="material-icons">dashboard</span> Tableau de Bord
          </a>
        </li>
        <li class="px-6 py-3 hover:bg-blue-600 transition-all cursor-pointer">
          <a href="#">Mes Tâches</a>
        </li>
        <li class="px-6 py-3 hover:bg-blue-600 transition-all cursor-pointer">
          <a href="#">Tâches Assignées</a>
        </li>
        <li class="px-6 py-3 hover:bg-blue-600 transition-all cursor-pointer">
          <a href="#">Créer une Tâche</a>
        </li>
      </ul>
    </nav>
    <div class="p-6 border-t border-blue-600 text-sm">
      <a href="#" class="hover:underline">Déconnexion</a>
    </div>
  </aside>

  <!-- Main Content -->
  <div class="flex-1 flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-md p-6 flex justify-between items-center">
      <h1 class="text-2xl font-semibold text-gray-800">Tableau de Tâches</h1>
      <div>
        <input
          type="text"
          placeholder="Rechercher..."
          class="px-4 py-2 w-72 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none transition"
        />
      </div>
    </header>

    <!-- Task Board -->
    <main class="p-6 flex gap-6 overflow-x-auto">
      <!-- Column: Ouvert -->
      <div class="w-1/3 bg-blue-50 p-4 rounded-lg shadow-md border-t-4 border-blue-500">
        <h2 class="font-semibold text-lg mb-4 text-blue-700">🟦 Ouvert</h2>
        <div class="space-y-4">
          <!-- Task Card -->
          <div class="bg-white p-4 rounded-lg shadow-md border hover:shadow-lg hover:scale-105 transition-transform">
            <h3 class="font-semibold text-blue-700">Bug: Erreur de connexion</h3>
            <p class="text-sm text-gray-600 mt-2">
              Impossible de se connecter avec certains comptes.
            </p>
            <div class="mt-4 text-xs text-gray-400">Assigné à : Jean Dupont</div>
          </div>
          <div class="bg-white p-4 rounded-lg shadow-md border hover:shadow-lg hover:scale-105 transition-transform">
            <h3 class="font-semibold text-blue-700">Ajouter un tableau de bord</h3>
            <p class="text-sm text-gray-600 mt-2">
              Créer une interface pour le tableau de bord utilisateur.
            </p>
            <div class="mt-4 text-xs text-gray-400">Assigné à : Sarah Doe</div>
          </div>
        </div>
      </div>

      <!-- Column: En Cours -->
      <div class="w-1/3 bg-yellow-50 p-4 rounded-lg shadow-md border-t-4 border-yellow-500">
        <h2 class="font-semibold text-lg mb-4 text-yellow-700">🟨 En Cours</h2>
        <div class="space-y-4">
          <!-- Task Card -->
          <div class="bg-white p-4 rounded-lg shadow-md border hover:shadow-lg hover:scale-105 transition-transform">
            <h3 class="font-semibold text-yellow-700">Nettoyer la base de données</h3>
            <p class="text-sm text-gray-600 mt-2">
              Supprimer les données obsolètes.
            </p>
            <div class="mt-4 text-xs text-gray-400">Assigné à : Alex Brown</div>
          </div>
        </div>
      </div>

      <!-- Column: Terminé -->
      <div class="w-1/3 bg-green-50 p-4 rounded-lg shadow-md border-t-4 border-green-500">
        <h2 class="font-semibold text-lg mb-4 text-green-700">🟩 Terminé</h2>
        <div class="space-y-4">
          <!-- Task Card -->
          <div class="bg-white p-4 rounded-lg shadow-md border hover:shadow-lg hover:scale-105 transition-transform">
            <h3 class="font-semibold text-green-700">Correction du bug d'authentification</h3>
            <p class="text-sm text-gray-600 mt-2">
              Résolution du problème d'accès à certains comptes.
            </p>
            <div class="mt-4 text-xs text-gray-400">Assigné à : Marie Curie</div>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
    