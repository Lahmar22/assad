<?php
require "connexion.php";


$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$password = $_POST["password"];
$role = $_POST["role"];

$hash = password_hash($password, PASSWORD_DEFAULT);

if ($role === 'guid') {
    $status = 'Désactiver'; 
} else {
    $status = 'Activer';
}


$sql = "INSERT INTO utilisateur(nom, prenom, email, password, role, statuse) VALUES ('$nom', '$prenom', '$email', '$hash', '$role', '$status')";

if ($conn->query($sql) === true) {
    header("location: ../index.php");
} else {
    echo "Erreur : " . $conn->error;
}
