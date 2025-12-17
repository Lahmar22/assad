<?php

require "../controller/connexion.php";

$sql = "SELECT id_user, nom, prenom, email, role, statuse FROM utilisateur ";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Management Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <button type="button" onclick="openModal()" class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition text-center">
                Ajouter Animal
            </button>
            <button data-modal-target="addHbitat" data-modal-toggle="addHbitat" class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition text-center" type="button">
                Ajout Habitat
            </button>


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
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Les Utilisateurs</h2>

            <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
                <table class="min-w-full border border-gray-200">
                    <!-- Table Head -->
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Id</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nom</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Prenom</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="divide-y divide-gray-200">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-700"><?= $row["id_user"] ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?= $row["nom"] ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?= $row["prenom"] ?></td>
                                <td class="px-6 py-4 text-sm text-gray-700"><?= $row["email"] ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium 
                                <?= $row["role"] === 'admin' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' ?>">
                                        <?= $row["role"] ?>
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <form action="../controller/update_status.php" method="POST">
                                        <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">

                                        <select name="statuse"
                                            onchange="this.form.submit()"
                                            class="px-3 py-1 rounded-md text-sm font-medium <?= $row['statuse'] === 'Activer'? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">

                                            <option value="Activer" <?= $row['statuse'] === 'Activer' ? 'selected' : '' ?>>
                                                Activer
                                            </option>
                                            <option value="Désactiver" <?= $row['statuse'] === 'Désactiver' ? 'selected' : '' ?>>
                                                Désactiver
                                            </option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="../controller/delete.php" method="POST"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
                                        <input type="hidden" name="id" value="<?= $row["id_user"] ?>">
                                        <button
                                            type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>



    </main>

    <div id="addAnimal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white border border-default rounded-base shadow-sm p-4 md:p-6">
                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <button type="button" onclick="closeModal()" class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="addAnimal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="ajouter.php" method="POST">
                    <div class="space-y-4">
                        <div class="col-span-2">
                            <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Name</label>
                            <input type="text" name="name" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" required="">
                        </div>
                        <div>
                            <label for="type_alimentaire" class="block text-sm font-medium text-gray-700 mb-2">Type Alimentaire</label>
                            <select
                                name="type_alimentaire"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Select type alimentaire</option>
                                <option value="carnivore">🥩 Carnivore</option>
                                <option value="herbivore">🥦 Herbivore</option>
                                <option value="omnivore">🥘 Omnivore</option>
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="image" class="block mb-2.5 text-sm font-medium text-heading">Image</label>
                            <input
                                type="text"
                                name="image"
                                class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" required="">
                        </div>
                        <div>
                            <label for="habitat" class="block text-sm font-medium text-gray-700 mb-2">Habitat</label>
                            <select
                                name="habitat"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Select a habitat</option>
                                <option value="1">🪾 Savane</option>
                                <option value="2">🌳 Jungle</option>
                                <option value="3">🏜️ Désert</option>
                                <option value="4">🌊 Océan</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6">
                        <button type="submit" class="inline-flex items-center  text-white bg-green-600  box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                            <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                            </svg>
                            Add new Animal
                        </button>
                        <button data-modal-hide="addAnimal" type="button" onclick="closeModal()" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById("addAnimal").classList.remove("hidden");
            document.getElementById("addAnimal").classList.add("block");
        }

        function closeModal() {
            document.getElementById("addAnimal").classList.remove("block");
            document.getElementById("addAnimal").classList.add("hidden");
        }
    </script>
</body>

</html>