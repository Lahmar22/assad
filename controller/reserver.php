<?php 
session_start();
require "../controller/connexion.php";

$id_visiteGuid = $_POST['id_visiteGuid'];
$id_user = $_POST['id_user'];
$nbpersonnes = $_POST['nbpersonnes'];
$datereservation = date("Y/m/d");

$sqlReservation = "INSERT INTO reservations (idvisite, idutilisateur, nbpersonnes, datereservation) VALUES ('$id_visiteGuid', '$id_user ', '$nbpersonnes', '$datereservation')";

if($conn->query($sqlReservation)=== true){
    header("location: ../visiteur/home.php");
    $_SESSION['message'] = "Visite guidée bien réservée";

} else {
    echo "Erreur : " . $conn->error;
}

?>