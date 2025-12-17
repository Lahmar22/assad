<?php
require "../controller/connexion.php";

$id = $_POST["id"];


$sql = "DELETE FROM utilisateur WHERE id_user = $id";



if($conn->query($sql)=== true){
        header("location: ../admin/dashboard.php");
        
    } else {
        echo "Erreur : " . $conn->error;
}


?>