<?php
namespace Controllers;

use Models\UserModel;


class RegisterController {

    public function showRegister() {
        require __DIR__ . '/../Views/register.php';
    }

    public function tryRegister() {
        $name = $_POST['name'] ?? '';
        $surename = $_POST['surename'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $success = UserModel::create($name, $surename, $email, $password);

        if ($success) {
            header("Location: /login?registered=1");
            exit;
        } 
        else {
            $error = "No se pudo completar el registro.";
            include __DIR__ . '/../views/register.php'; 
        }
    }

    public function confirmEmail() {
        $token = $_GET['token'] ?? '';

        if (!$token) {
            echo "Token no proporcionado.";
            return;
        }

        $resultado = UserModel::confirmByToken($token);

        if ($resultado) {
            header("Location: /login?confirmed=1");
            exit;
        } 
        else {
            echo "Token inválido o ya usado.";
        }
    }
}