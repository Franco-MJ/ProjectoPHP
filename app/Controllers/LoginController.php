<?php
namespace Controllers;

use Models\UserModel;

class LoginController {

    public function showLogin() {
        require __DIR__ . '/../Views/login.php';
    }

    public function tryLogin() {
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = UserModel::findByEmail($email);
        

        if ($user && password_verify($password, $user['pass'])) {  
            if (isset($user['isConfirmed']) && $user['isConfirmed'] == 1) {  
                // Usuario validado
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                header('Location: /main');  
                exit;
            } 
            else {
                echo "Por favor confirma tu cuenta antes de iniciar sesión.";
            }
        } 
        else {
            echo "Email o contraseña incorrectos.";
        }
    }
}
