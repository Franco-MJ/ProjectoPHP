<?php
namespace Controllers;

//require_once __DIR__ . '/../../config.php';

class LoginController {

    public function showLogin() {
        require __DIR__ . '/../Views/login.php';
    }

    public function tryLogin() {
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($email === 'admin@example.com' && $password === '1234') {
            echo "¡Bienvenido $email!";
        } 
        else {
            echo "Credenciales incorrectas.";
        }

    }
}
