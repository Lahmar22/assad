<?php
session_start();

if (!isset($_SESSION['user_idVisiteur'])) {
    header("Location: ../index.php");
    exit();
}

if (isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
}

$id = $_SESSION['user_idVisiteur'];

require "../controller/connexion.php";

$sqlAnimal = "SELECT animaux.id, animaux.nomAnimal, animaux.espèce, animaux.alimentation, animaux.image, animaux.paysorigine, animaux.descriptioncourte, habitats.nomHabitat FROM animaux INNER JOIN habitats ON animaux.id_habitat = habitats.id_habitat ";

$resultAnimal = $conn->query($sqlAnimal);

$sqlVisiteGuid = "SELECT id, titre, DATE(dateheure) AS date_seulement, TIME(dateheure) AS time_seulement, langue, capacite_max, statut, duree, prix FROM visitesguidees WHERE statut = 'Active'";

$resultVisiteGuid = $conn->query($sqlVisiteGuid);

$sqlMesReservation = "SELECT r.id, r.idvisite, r.idutilisateur, r.nbpersonnes, r.datereservation, v.id AS visite_id, v.titre, DATE(v.dateheure) AS dateVG, TIME(v.dateheure) AS timeVG, v.statut, v.duree, v.prix, u.id_user, u.nom, u.prenom FROM reservations r INNER JOIN visitesguidees v ON r.idvisite = v.id INNER JOIN utilisateur u ON r.idutilisateur = u.id_user WHERE r.idutilisateur = $id ";

$resultMesReservation = $conn->query($sqlMesReservation);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visiteur | Animal Platform</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.4s ease-out;
        }
    </style>
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
            <button type="button" onclick="openModalMesReserver()" class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition text-center">
                Mes réservations
            </button>

            <button type="button" onclick="openModalAssadAtlass()" class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition text-center">
                Asaad – Lion des Atlas
            </button>


        </nav>

        <div class="p-4 border-t border-gray-700">
            <a href="../controller/logout.php"
                class="flex items-center gap-3 px-4 py-3 rounded-lg bg-red-600 hover:bg-red-700 transition">
                🚪 <span>Déconnexion</span>
            </a>
        </div>
    </aside>


    <main class="pt-24 lg:ml-64 p-4 lg:p-8">
        <div class="bg-white shadow-md rounded-lg p-6 mb-6 flex items-center gap-4">
            <!-- Avatar -->
            <div class="w-12 h-12 rounded-full bg-green-600 text-white flex items-center justify-center text-xl font-bold">
                <?= strtoupper(substr($_SESSION['nomVisiteur'], 0, 1)) . strtoupper(substr($_SESSION['prenomVisiteur'], 0, 1))  ?>
            </div>

            <!-- Texte -->
            <div>
                <h1 class="text-xl font-semibold text-gray-800">
                    Bonjour, Mr
                    <span class="text-green-600">
                        <?= $_SESSION['nomVisiteur'] ?> <?= $_SESSION['prenomVisiteur'] ?>
                    </span>
                </h1>
                <p class="text-sm text-gray-500">
                    Bienvenue sur votre espace ASSAD
                </p>
            </div>
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <?php while ($row = $resultVisiteGuid->fetch_assoc()) { ?>
                    <div class="max-w-md rounded-2xl overflow-hidden shadow-lg bg-white hover:shadow-xl transition">

                        <!-- Header -->
                        <div class="bg-gradient-to-r from-blue-600 to-green-300 p-4 text-white">
                            <h3 class="text-xl font-bold"><?= $row['titre'] ?></h3>
                            <p class="text-sm opacity-90">Une expérience unique</p>
                        </div>

                        <!-- Body -->
                        <div class="p-5 space-y-2 text-gray-700">

                            <div class="flex justify-between">
                                <span>📅 Date</span>
                                <span class="font-semibold"><?= $row['date_seulement'] ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span>⏰ Début</span>
                                <span class="font-semibold"><?= $row['time_seulement'] ?></span>
                            </div>

                            <div class="flex justify-between">
                                <span>⏳ Durée</span>
                                <span class="font-semibold"><?= $row['duree'] ?></span>
                            </div>

                            <div class="flex justify-between">
                                <span>🌍 Langue</span>
                                <span class="font-semibold"><?= $row['langue'] ?></span>
                            </div>

                            <div class="flex justify-between">
                                <span>👥 Places restantes</span>
                                <span class="font-semibold text-green-600"><?= $row['capacite_max'] ?></span>
                            </div>

                            <hr>

                            <!-- Prix -->
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-green-600"><?= $row['prix'] ?></span>
                                <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                    Disponible
                                </span>
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="p-4">
                            <button type="button"
                                onclick="openModalReserver(this)"
                                data-id="<?= $row['id'] ?>"
                                class="w-full bg-green-600 text-white py-2 rounded-xl hover:bg-green-700 transition">
                                Réserver maintenant
                            </button>
                        </div>

                    </div>

                <?php } ?>
            </div>


        </section>

        <?php if (!empty($msg)) : ?>
            <div id="msg" class="fixed top-6 right-6 z-50">
                <div class="flex items-center gap-3 bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-xl shadow-lg animate-fade-in">
                    <!-- Icon -->
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 13l4 4L19 7" />
                    </svg>

                    <!-- Message -->
                    <span class="font-semibold">
                        <?= htmlspecialchars($msg) ?>
                    </span>
                </div>
            </div>
        <?php endif; ?>

        <section>
            <h1 class="text-3xl font-bold mb-6">Les Animaux</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

                <?php while ($row = $resultAnimal->fetch_assoc()) { ?>
                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition">
                        <img src="<?= $row['image'] ?>" class="w-full h-48 object-cover rounded-lg">
                        <div class="p-6">
                            <h3 class="text-xl font-bold"><?= $row['nomAnimal'] ?></h3>
                            <p class="text-gray-600">Espèce : <?= $row['espèce'] ?></p>
                            <p class="text-gray-600">Habitat : <?= $row['nomHabitat'] ?></p>


                        </div>
                    </div>
                <?php } ?>

            </div>
        </section>

    </main>

    <div id="reservationModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">


        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">


            <button onclick="closeModalReserver()"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl">
                &times;
            </button>

            <h2 class="text-2xl font-bold mb-4 text-center">Réserver une visite</h2>

            <form method="post" action="../controller/reserver.php">
                <input id="id_visiteGuid" type="hidden" name="id_visiteGuid">
                <input type="hidden" name="id_user" value="<?= $_SESSION['user_idVisiteur'] ?>">

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Nombre de personnes</label>
                    <input type="number"
                        name="nbpersonnes"
                        min="1"
                        required
                        class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                    Confirmer
                </button>

            </form>
        </div>
    </div>

    <div id="mesReservation"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl mx-4 relative animate-fade-in">

            <!-- Close Button -->
            <button onclick="closeModalMesReserver()"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl">
                &times;
            </button>

            <!-- Header -->
            <div class="border-b px-6 py-4">
                <h2 class="text-2xl font-bold text-gray-800 text-center">
                    📋 Mes réservations
                </h2>
            </div>

            <!-- Content -->
            <div class="p-6 overflow-x-auto max-h-[70vh]">

                <table class="min-w-full text-sm border border-gray-200 rounded-xl overflow-hidden">
                    <thead class="bg-gray-100 sticky top-0 z-10">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Titre</th>
                            <th class="px-4 py-3 text-left font-semibold">Utilisateur</th>
                            <th class="px-4 py-3 text-center font-semibold">Personnes</th>
                            <th class="px-4 py-3 text-center font-semibold">Réservé le</th>
                            <th class="px-4 py-3 text-center font-semibold">Date visite</th>
                            <th class="px-4 py-3 text-center font-semibold">Heure</th>
                            <th class="px-4 py-3 text-center font-semibold">Statut</th>
                            <th class="px-4 py-3 text-center font-semibold">Durée</th>
                            <th class="px-4 py-3 text-center font-semibold">Total</th>
                            <th class="px-4 py-3 text-center font-semibold">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php if ($resultMesReservation->num_rows > 0) {
                            while ($row = $resultMesReservation->fetch_assoc()) { ?>
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-4 py-3 font-medium">
                                        <?= htmlspecialchars($row["titre"]) ?>
                                    </td>

                                    <td class="px-4 py-3">
                                        <?= htmlspecialchars($row["nom"] . ' ' . $row["prenom"]) ?>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <?= $row["nbpersonnes"] ?>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <?= $row["datereservation"] ?>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <?= $row["dateVG"] ?>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <?= $row["timeVG"] ?>
                                    </td>

                                    <!-- Status Badge -->
                                    <td class="px-4 py-3 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    <?= $row["statut"] === 'active'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-yellow-100 text-yellow-700' ?>">
                                            <?= ucfirst($row["statut"]) ?>
                                        </span>
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <?= $row["duree"] ?>
                                    </td>

                                    <td class="px-4 py-3 text-center font-semibold text-green-600">
                                        <?= $row["prix"] * $row["nbpersonnes"] ?> MAD
                                    </td>

                                    <!-- Action -->
                                    <td class="px-4 py-3 text-center">
                                        <form action="../controller/annuler.php" method="POST"
                                            onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?');">
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                                            <button
                                                type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-xs font-semibold transition">
                                                ❌ Annuler
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            <?php }
                        } else { ?>
                            <td colspan="10" class=" text-xl px-4 py-3 text-center">🚫 Aucune réservation trouvée</td>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div id="assadAtlass" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 hidden">

        <div class="absolute inset-0 bg-gray-900 bg-opacity-80 backdrop-blur-sm transition-opacity" onclick="closeModalAssadAtlass()"></div>

        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-4xl overflow-hidden flex flex-col md:flex-row transform transition-all scale-100">

            <button onclick="closeModalAssadAtlass()" class="absolute top-4 right-4 z-10 p-2 bg-white/80 hover:bg-white text-gray-800 rounded-full transition-colors shadow-sm backdrop-blur-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="w-full md:w-1/2 h-64 md:h-auto relative">
                <img src="https://images.unsplash.com/photo-1614027164847-1b28cfe1df60?q=80&w=800&auto=format&fit=crop"
                    alt="Lion de l'Atlas"   
                    class="absolute inset-0 w-full h-full object-cover">

                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent md:hidden"></div>
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-10 flex flex-col justify-center">

                <div class="flex items-center space-x-2 mb-3">
                    <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        Asaad
                    </span>
                    <span class="text-gray-400 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" />
                        </svg>
                        Afrique du Nord
                    </span>
                </div>

                <h2 class="text-3xl font-extrabold text-gray-900 mb-4 font-serif">
                    Lion de l'Atlas
                </h2>

                <p class="text-gray-600 mb-8 leading-relaxed text-justify text-sm md:text-base">
                    Emblème majestueux du Royaume, le Lion de l’Atlas est le trésor vivant des montagnes marocaines. Reconnaissable à sa crinière sombre et imposante unique au monde, ce prédateur légendaire incarne depuis des siècles la force, la noblesse et l'identité souveraine du Maroc.
                </p>

                <div class="grid grid-cols-2 gap-4">

                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Espèce</p>
                        <div class="flex items-center mt-1">
                            <span class="text-lg mr-2">🐾</span>
                            <span class="text-gray-800 font-semibold text-sm">Lion de l’Atlas</span>
                        </div>
                    </div>

                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Origine</p>
                        <div class="flex items-center mt-1">
                            <span class="text-lg mr-2">🌍</span>
                            <span class="text-gray-800 font-semibold text-sm">Afrique du Nord (maroc)</span>
                        </div>
                    </div>

                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Alimentation</p>
                        <div class="flex items-center mt-1">
                            <span class="text-lg mr-2">🥩</span>
                            <span class="text-gray-800 font-semibold text-sm">Carnivore</span>
                        </div>
                    </div>

                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wide">Habitat</p>
                        <div class="flex items-center mt-1">
                            <span class="text-lg mr-2">🏜️</span>
                            <span class="text-gray-800 font-semibold text-sm">Savanes</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        function openModalReserver(button) {

            document.getElementById("id_visiteGuid").value = button.dataset.id;


            document.getElementById("reservationModal").classList.remove("hidden");
            document.getElementById("reservationModal").classList.add("block");
        }

        function closeModalReserver() {
            document.getElementById("reservationModal").classList.remove("block");
            document.getElementById("reservationModal").classList.add("hidden");
        }

        function openModalMesReserver() {

            document.getElementById("mesReservation").classList.remove("hidden");
            document.getElementById("mesReservation").classList.add("block");
        }

        function closeModalMesReserver() {
            document.getElementById("mesReservation").classList.remove("block");
            document.getElementById("mesReservation").classList.add("hidden");
        }

        function openModalAssadAtlass() {

            document.getElementById("assadAtlass").classList.remove("hidden");
            document.getElementById("assadAtlass").classList.add("block");
        }

        function closeModalAssadAtlass() {
            document.getElementById("assadAtlass").classList.remove("block");
            document.getElementById("assadAtlass").classList.add("hidden");
        }

        setTimeout(() => {
            const alert = document.querySelector('#msg');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s';
                setTimeout(() => alert.remove(), 500);
            }
        }, 2000);
    </script>
</body>

</html>