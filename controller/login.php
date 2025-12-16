<?php
    session_start(); 

    require "connexion.php";

    if(isset($_POST["email"]) && isset($_POST["password"])){
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        
        $stmt = $conn->prepare("SELECT id_user, email, password FROM utilisateur WHERE email = ?");
        
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if ($password == $user['password']) {
                    
                    
                    $_SESSION['user_id'] = $user['id_user'];
                    $_SESSION['email'] = $user['email'];
                    
                    header("Location: ../visiteur/home.php");
                    exit(); 
                    
                }else {
                    
                    header("Location: ../login.php?error=Invalid password");
                    exit();
                }

            } else {
                
                header("Location: ../login.php?error=User not found");
                exit();
            }
            $stmt->close();
        } else {
            
            echo "Error preparing statement: " . $conn->error;
        }

    } else {
        header("Location: ../login.php");
        exit();
    }
?>