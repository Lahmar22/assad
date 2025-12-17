<?php
require "../controller/connexion.php";

$id = $_POST["id_user"];

$status = $_POST["statuse"];


$sql = "UPDATE utilisateur SET statuse = '$status' WHERE id_user = $id";



if($conn->query($sql)=== true){
        header("location: ../admin/dashboard.php");
        
    } else {
        echo "Erreur : " . $conn->error;
}


?>