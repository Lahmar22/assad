<?php
require "../controller/connexion.php";

$nom = $_POST["nomhabitat"];
$typeclimat = $_POST["typeclimat"];
$description = $_POST["description"];
$zonezoo = $_POST["zonezoo"];

$sql = "INSERT INTO habitats(nomHabitat, typeclimat, description, zonezoo) VALUES('$nom', '$typeclimat', '$description', '$zonezoo')";

if($conn->query($sql)=== true){
    header("location: ../admin/dashboard.php");

} else {
    echo "Erreur : " . $conn->error;
}
?>