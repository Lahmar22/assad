<?php
require "../controller/connexion.php";

$titre = $_POST["titre"];
$dateheure = $_POST["dateheure"];
$langue = $_POST["langue"];
$capacite_max = $_POST["capacite_max"];
$duree = $_POST["duree"];
$prix = $_POST["prix"];


$sql = "INSERT INTO visitesguidees(titre, dateheure, langue, capacite_max, duree, prix) VALUES('$titre', '$dateheure', '$langue', '$capacite_max', '$duree', '$prix')";

if($conn->query($sql)=== true){
    header("location: ../guid/home.php");

} else {
    echo "Erreur : " . $conn->error;
}
?>