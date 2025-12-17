<?php
session_start();
require "connexion.php";

if (!isset($_POST["email"], $_POST["password"])) {
    header("Location: ../login.php?error=Please fill in all fields");
    exit();
}

$email = trim($_POST["email"]);
$password = $_POST["password"];

$stmtAdmin = $conn->prepare("SELECT id_admin,nom, prenom, email, password FROM admin WHERE email = ?");
$stmtAdmin->bind_param("s", $email);
$stmtAdmin->execute();
$resAdmin = $stmtAdmin->get_result();

if ($resAdmin->num_rows === 1) {
    $admin = $resAdmin->fetch_assoc();

    if (password_verify($password, $admin['password'])) {
        $_SESSION['id_admin'] = $admin['id_admin'];
        $_SESSION['email'] = $admin['email'];
        $_SESSION['nom'] = $admin['nom'];
        $_SESSION['prenom'] = $admin['prenom'];
        $_SESSION['role'] = 'admin';

        header("Location: ../admin/dashboard.php");
        exit();
    }
}

$stmtAdmin->close();

$stmtUser = $conn->prepare("SELECT id_user, nom, prenom, email, password, role, statuse FROM utilisateur WHERE email = ?");
$stmtUser->bind_param("s", $email);
$stmtUser->execute();
$resUser = $stmtUser->get_result();

if ($resUser->num_rows === 1) {
    $user = $resUser->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'visiteur') {
            if($user['statuse'] === 'Désactiver'){
                header("Location: ../pageAttente.php ");
            }else{
                header("Location: ../visiteur/home.php ");
            }
        } elseif ($user['role'] === 'guid') {
            if($user['statuse'] === 'Désactiver'){
                header("Location: ../pageAttente.php ");
            }else{
                header("Location: ../guid/home.php ");
            }
        } else {
            header("Location: ../login.php?error=Unknown role");
        }
        exit();
    }
}

$stmtUser->close();


header("Location: ../login.php?error=Invalid email or password");
exit();
