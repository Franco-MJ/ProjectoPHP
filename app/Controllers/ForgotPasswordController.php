<?php
namespace Controllers;


class ForgotPasswordController {

    public function showForgotPassword() {
        require __DIR__ . '/../Views/forgotPassword.php';
    }
}
