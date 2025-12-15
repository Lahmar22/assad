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
        aria-label="Toggle navigation menu"
        aria-expanded="false"
        aria-controls="sidebar">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg flex flex-col z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300"
        role="navigation"
        aria-label="Main navigation">
        <div class="p-6 border-b">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-emerald-700 rounded-lg flex items-center justify-center shadow-md">

                </div>
                <div>
                    <h1 class="text-xl font-bold text-gray-800">ASSAD</h1>

                </div>
            </div>
        </div>



    </aside>


    <!-- Main Content -->
    <main class="pt-24 lg:ml-64 p-4 lg:p-8" role="main">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Zoo Encyclopédie</h2>


        <div id="filter">

            <!-- Filter by Name -->
            <form action="index.php" method="POST" class="flex flex-col lg:flex-row gap-3 mb-6 bg-white p-4 rounded-lg shadow-md">
                <div class="flex-1">
                    <label for="filter-name" class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Filter by Alimentaire
                    </label>
                    <select
                        name="filterAlimentaire"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition appearance-none bg-white cursor-pointer">
                        <option value="">All Alimentaire</option>
                        <option value="carnivore">🥩 Carnivore</option>
                        <option value="herbivore">🥦 Herbivore</option>
                        <option value="omnivore">🥘 Omnivore</option>
                    </select>
                </div>

                <!-- Filter by Habitat -->
                <div class="flex-1">
                    <label for="filter-habitat" class="block text-sm font-medium text-gray-700 mb-2">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Filter by Habitat
                    </label>
                    <select
                        id="filter-habitat"
                        name="filter_habitat"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition appearance-none bg-white cursor-pointer"
                        aria-label="Filter animals by habitat">
                        <option value="">All Habitats</option>
                        <option value="1">🪶 Savane</option>
                        <option value="2">🌳 Jungle</option>
                        <option value="3">🏜️ Désert</option>
                        <option value="4">🌊 Océan</option>
                    </select>
                </div>

                <!-- Reset Filter Button -->
                <div class="flex items-end">
                    <button
                        type="submit"
                        id="reset-filters"
                        class="w-full lg:w-auto px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition focus:outline-none focus:ring-2 focus:ring-gray-400 flex items-center justify-center gap-2"
                        aria-label="Reset all filters">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span class="hidden sm:inline">Reset</span>
                    </button>
                </div>
            </form>

        </div>

        <div class="min-h-screen bg-gray-100 p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                My guided tours
            </h2>

            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">

                <!-- Card -->
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-6">

                    <div class="flex justify-between items-start">
                        <h3 class="text-xl font-semibold text-gray-800">
                            Visite de la médina
                        </h3>
                        
                    </div>

                    <p class="text-gray-500 text-sm mt-2">
                        🕒 90 minutes
                    </p>

                    <p class="text-gray-700 mt-3">
                        💰 <span class="font-semibold">120 MAD</span>
                    </p>

                    <p class="text-gray-500 text-sm mt-1">
                        📅 20/12/2025 • 18:00
                    </p>

                    <div class="flex justify-between items-center mt-6">
                        <button
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition">
                            Modifier
                        </button>

                        <button
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                            Annuler
                        </button>
                    </div>
                </div>

            </div>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">



            <!-- Animal Card Example 1 -->
            <?php
            if ($result2 && $result2->num_rows > 0) {
                while ($row1 = $result2->fetch_assoc()) {  ?>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <img src="<?= $row1["image"] ?>" alt="<?= $row1["nom"] ?>" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2"><?= $row1["nom"] ?></h3>
                            <p class="text-gray-600 mb-4">Type : <?= $row1["type_alimentaire"] ?></p>
                            <p class="text-gray-600 mb-4">Habitat : <?= $row1["nomHab"] ?></p>


                            <div class="flex gap-3 justify-center items-center">
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="id_animal" value="<?= $row1["id_animal"] ?>">
                                    <button class="block w-full bg-red-600 text-white font-semibold py-3 px-4 rounded-lg text-center" type="submit">DELETE</button>
                                </form>
                                <button class="block w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg text-center" type="button" onclick="openUpdateModal(this)"
                                    data-id-animal="<?= $row1['id_animal'] ?>"
                                    data-nom="<?= $row1['nom'] ?>"
                                    data-image="<?= $row1['image'] ?>"
                                    data-type-alimentaire="<?= $row1['type_alimentaire'] ?>"
                                    data-id-habitat="<?= $row1['id_habitat'] ?>">
                                    UPDATE
                                </button>
                            </div>

                        </div>

                    </div>
                <?php } ?>
            <?php } else { ?>
                <?php while ($row = $result->fetch_assoc()) { ?>

                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                        <img src="<?= $row["image"] ?>" alt="<?= $row["nom"] ?>" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2"><?= $row["nom"] ?></h3>
                            <p class="text-gray-600 mb-4">Type : <?= $row["type_alimentaire"] ?></p>
                            <p class="text-gray-600 mb-4">Habitat : <?= $row["nomHab"] ?></p>


                            <div class="flex gap-3 justify-center items-center">
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="id_animal" value="<?= $row["id_animal"] ?>">
                                    <button class="block w-full bg-red-600 text-white font-semibold py-3 px-4 rounded-lg text-center" type="submit">DELETE</button>
                                </form>
                                <button class="block w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg text-center" type="button" onclick="openUpdateModal(this)"
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
                <?php } ?>
            <?php } ?>





        </div>
    </main>


</body>

</html>