<?php
require "../controller/connexion.php";

$nom = $_POST["nom"];
$espece = $_POST["espece"];
$alimentation = $_POST["alimentation"];
$image = $_POST["image"];
$paysorigine = $_POST["paysorigine"];
$descriptioncourte = $_POST["descriptioncourte"];
$habitat = $_POST["habitat"];


$sql = "INSERT INTO animaux(nom, espèce, alimentation, image, paysorigine, descriptioncourte, id_habitat) VALUES('$nom', '$espece', '$alimentation', '$image', '$paysorigine', '$descriptioncourte', '$habitat')";

if($conn->query($sql)=== true){
    header("location: ../admin/dashboard.php");

} else {
    echo "Erreur : " . $conn->error;
}
?>