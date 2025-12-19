<?php
require "../controller/connexion.php";

$id = $_POST["id"];


$sql = "DELETE FROM visitesguidees WHERE id = $id";



if($conn->query($sql)=== true){
        header("location: ../guid/home.php");
        
    } else {
        echo "Erreur : " . $conn->error;
}


?>