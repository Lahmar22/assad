<?php
require "../controller/connexion.php";

$id = $_POST["id"];
$nomhabitat = $_POST["nomhabitat"];
$typeclimat = $_POST["typeclimat"];
$description = $_POST["description"];
$zonezoo = $_POST["zonezoo"];



$sql = "UPDATE habitats SET nomHabitat = '$nomhabitat', typeclimat = '$typeclimat', description = '$description', zonezoo = '$zonezoo' WHERE id_habitat = $id";

if($conn->query($sql)=== true){
    header("location: ../admin/dashboard.php");

} else {
    echo "Erreur : " . $conn->error;
}
?>