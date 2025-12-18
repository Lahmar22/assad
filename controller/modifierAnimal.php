<?php
require "../controller/connexion.php";

$nom = $_POST["nom"];
$espece = $_POST["espece"];
$alimentation = $_POST["alimentation"];
$image = $_POST["image"];
$paysorigine = $_POST["paysorigine"];
$descriptioncourte = $_POST["descriptioncourte"];
$habitat = $_POST["habitat"];


$sql = "UPDATE animaux SET nom = '$nom', espèce = '$espece', alimentation = '$alimentation', image = '$image', paysorigine = '$paysorigine', descriptioncourte = '$descriptioncourte', id_habitat = '$habitat' WHERE id = ";

if($conn->query($sql)=== true){
    header("location: ../admin/dashboard.php");

} else {
    echo "Erreur : " . $conn->error;
}
?>