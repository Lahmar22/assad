<?php
require "../controller/connexion.php";

$id = $_POST["id"];


$sql = "DELETE FROM animaux WHERE id = $id";



if($conn->query($sql)=== true){
        header("location: ../admin/dashboard.php");
        
    } else {
        echo "Erreur : " . $conn->error;
}


?>