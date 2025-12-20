<?php
session_start();

require "../controller/connexion.php";

$id_visite = $_POST["id_visite"];
$id_user = $_POST["id_user"];
$commentaire = $_POST["commentaire"];
$dateCommentaire = date("Y/m/d");



$sql = "INSERT INTO commentaires(idvisitesguides, idutilisateur, texte, date_commentaire) VALUES('$id_visite', '$id_user', '$commentaire', '$dateCommentaire')";

if($conn->query($sql)=== true){
    header("location: ../visiteur/home.php");
    $_SESSION['messageCommentaire'] = "Commentaire envoyé avec succès ";

} else {
    echo "Erreur : " . $conn->error;
}
?>