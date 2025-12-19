<?php
require "../controller/connexion.php";

$id = $_POST["id_visiteGuid"];

$statut = $_POST["statut"];


$sql = "UPDATE visitesguidees SET statut = '$statut' WHERE id = $id";



if($conn->query($sql)=== true){
        header("location: ../guid/home.php");
        
    } else {
        echo "Erreur : " . $conn->error;
}


?>