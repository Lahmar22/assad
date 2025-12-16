<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Management Platform</title>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">


    <button
        id="mobile-menu-btn"
        class="lg:hidden fixed top-4 left-4 z-50 bg-green-600 text-white p-3 rounded-lg shadow-lg hover:bg-green-700 transition"
        aria-label="Toggle navigation menu">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>


    <aside
        id="sidebar"
        class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg flex flex-col z-40
           transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
        <div class="p-6 border-b">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-emerald-700 rounded-lg"></div>
                <h1 class="text-xl font-bold text-gray-800">ASSAD</h1>
            </div>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
        

            
        </nav>

        <div class="p-4 border-t border-gray-700">
            <a href="logout.php"
                class="flex items-center gap-3 px-4 py-3 rounded-lg bg-red-600 hover:bg-red-700 transition">
                🚪 <span>Déconnexion</span>
            </a>
        </div>
    </aside>


    <main class="pt-24 lg:ml-64 p-4 lg:p-8">
        <div>
            <h1>Bonjour Mr : zaki</h1>
        </div>


        <div id="filter" class="flex flex-col lg:flex-row gap-6 mb-8">

            <!-- Filter Form -->
            <form action="index.php" method="POST"
                class="flex flex-col lg:flex-row gap-4 bg-white p-4 rounded-lg shadow-md w-full">

                <!-- Alimentaire -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Filter by Alimentaire
                    </label>
                    <select name="filterAlimentaire"
                        class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-green-500">
                        <option value="">All</option>
                        <option value="carnivore">🥩 Carnivore</option>
                        <option value="herbivore">🥦 Herbivore</option>
                        <option value="omnivore">🥘 Omnivore</option>
                    </select>
                </div>

                <!-- Habitat -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Filter by Habitat
                    </label>
                    <select name="filter_habitat"
                        class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-green-500">
                        <option value="">All</option>
                        <option value="1">🪶 Savane</option>
                        <option value="2">🌳 Jungle</option>
                        <option value="3">🏜️ Désert</option>
                        <option value="4">🌊 Océan</option>
                    </select>
                </div>

                <!-- Reset -->
                <div class="flex items-end">
                    <button type="submit"
                        class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 rounded-lg">
                        Reset
                    </button>
                </div>
            </form>

            <!-- Search Visit -->
            <form class="bg-white p-6 rounded-xl shadow-lg w-full lg:w-1/3">
                <h2 class="text-xl font-bold text-center mb-4">Rechercher une visite</h2>
                <input type="text"
                    placeholder="Nom de la visite..."
                    class="w-full px-4 py-2 border rounded-lg mb-4">
                <button class="w-full bg-blue-600 text-white py-2 rounded-lg">
                    Rechercher
                </button>
            </form>
        </div>


        <section class="mb-12">
            <h2 class="text-3xl font-bold mb-6">My guided tours</h2>

            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-semibold">Visite de la médina</h3>
                    <p class="text-sm text-gray-500 mt-2">🕒 90 minutes</p>
                    <p class="mt-2">💰 <b>120 MAD</b></p>
                    <p class="text-sm text-gray-500 mt-1">📅 20/12/2025 • 18:00</p>

                    <div class="flex justify-between mt-6">
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded">Modifier</button>
                        <button class="bg-red-600 text-white px-4 py-2 rounded">Annuler</button>
                    </div>
                </div>
            </div>
        </section>


        <section>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

                <?php
                $data = ($result2 && $result2->num_rows > 0) ? $result2 : $result;

                while ($row = $data->fetch_assoc()) :
                ?>
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition">
                        <img src="<?= $row['image'] ?>" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold"><?= $row['nom'] ?></h3>
                            <p class="text-gray-600">Type : <?= $row['type_alimentaire'] ?></p>
                            <p class="text-gray-600">Habitat : <?= $row['nomHab'] ?></p>

                            <div class="flex gap-3 mt-4">
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="id_animal" value="<?= $row['id_animal'] ?>">
                                    <button class="bg-red-600 text-white px-4 py-2 rounded">DELETE</button>
                                </form>

                                <button
                                    class="bg-blue-600 text-white px-4 py-2 rounded"
                                    onclick="openUpdateModal(this)"
                                    data-id-animal="<?= $row['id_animal'] ?>"
                                    data-nom="<?= $row['nom'] ?>"
                                    data-image="<?= $row['image'] ?>"
                                    data-type-alimentaire="<?= $row['type_alimentaire'] ?>"
                                    data-id-habitat="<?= $row['id_habitat'] ?>">
                                    UPDATE
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
        </section>

    </main>

</body>

</html>