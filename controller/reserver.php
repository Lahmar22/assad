<?php 
session_start();
require "../controller/connexion.php";

$id_visiteGuid = $_POST['id_visiteGuid'];
$id_user = $_POST['id_user'];
$nbpersonnes = $_POST['nbpersonnes'];
$datereservation = date("Y/m/d");

$sqlReservation = "INSERT INTO reservations (idvisite, idutilisateur, nbpersonnes, datereservation) VALUES ('$id_visiteGuid', '$id_user ', '$nbpersonnes', '$datereservation')";

$updatecapasiteVisite = "UPDATE visitesguidees SET capacite_max = capacite_max - $nbpersonnes WHERE id = $id_visiteGuid";

if($conn->query($sqlReservation)=== true){
    $conn->query($updatecapasiteVisite);
    header("location: ../visiteur/home.php");
    $_SESSION['message'] = "Visite guidée bien réservée";

} else {
    echo "Erreur : " . $conn->error;
}

?>