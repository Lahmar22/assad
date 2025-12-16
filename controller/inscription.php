<?php
    require "connexion.php";


    $nom= $_POST["nom"];
    $prenom= $_POST["prenom"];
    $email= $_POST["email"];
    $password= $_POST["password"];
    $role= $_POST["role"];

    $hash = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO utilisateur(nom, prenom, email, password, role) VALUES ('$nom', '$prenom', '$email', '$hash', '$role')";

    if($conn->query($sql)=== true){
        header("location: ../index.php");

    } else {
        echo "Erreur : " . $conn->error;
    }

?>