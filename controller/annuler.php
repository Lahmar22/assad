<?php
require "../controller/connexion.php";

$id = $_POST["id"];
$idvisite = $_POST["idvisite"];
$nbrPersonne = $_POST["nbrPersonne"];


$sql = "DELETE FROM reservations WHERE id = $id";

$updatecapasiteVisite = "UPDATE visitesguidees SET capacite_max = capacite_max + $nbrPersonne WHERE id = $idvisite";


if ($conn->query($sql) === true) {
    $conn->query($updatecapasiteVisite);
    header("location: ../visiteur/home.php");
} else {
    echo "Erreur : " . $conn->error;
}
