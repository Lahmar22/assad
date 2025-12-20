<?php 
require "../controller/connexion.php";

if(isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    $sqlParcour = "SELECT titreetape, descriptionetape, ordreetape 
                   FROM etapesvisite 
                   WHERE id_visite = $id 
                   ORDER BY ordreetape ASC";

    $resultParcour = $conn->query($sqlParcour);

    if ($resultParcour->num_rows > 0) {
        while ($row = $resultParcour->fetch_assoc()) { ?>
            <li class="bg-green-50 p-4 rounded-xl shadow-md border-l-4 border-green-500 mb-4 transition-all duration-300">
                <div class="flex items-center mb-2">
                    <span class="bg-green-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold mr-3">
                        <?= $row['ordreetape'] ?>
                    </span>
                    <h3 class="text-xl font-semibold text-green-800"><?= htmlspecialchars($row['titreetape']) ?></h3>
                </div>
                <p class="text-gray-700 pl-9"><?= htmlspecialchars($row['descriptionetape']) ?></p>
            </li>
        <?php }
    } else {
        echo "<p class='text-center text-gray-500 py-4'>Aucune étape pour ce parcours.</p>";
    }
}
?>