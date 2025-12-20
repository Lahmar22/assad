<?php
require "../controller/connexion.php";

$id = $_POST["id"];


$sql = "DELETE FROM reservations WHERE id = $id";



if($conn->query($sql)=== true){
        header("location: ../visiteur/home.php");
        
    } else {
        echo "Erreur : " . $conn->error;
}


?>