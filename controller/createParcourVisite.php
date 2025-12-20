<?php 

require "../controller/connexion.php";

$titreetape = $_POST['titreetape'];
$descriptionetape = $_POST['descriptionetape'];
$ordreetape = $_POST['ordreetape'];
$id_visite = $_POST['id_visite'];

$sqlEtapeVisite = "INSERT INTO etapesvisite (titreetape, descriptionetape, ordreetape, id_visite) VALUES ('$titreetape', '$descriptionetape ', '$ordreetape', '$id_visite')";

if($conn->query($sqlEtapeVisite)=== true){
    header("location: ../guid/home.php");

} else {
    echo "Erreur : " . $conn->error;
}

?>