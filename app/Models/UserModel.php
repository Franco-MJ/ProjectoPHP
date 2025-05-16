<?php
namespace Models;

use PDO;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserModel {

    public static function create(string $name, string $surename, string $email, string $password): bool|string {
        global $pdo;

        try{
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(16));

            $stmt = $pdo->prepare("CALL createUser(?, ?, ?, ?, ?)");
            $stmt->execute([$name, $surename, $email, $hashedPassword, $token]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (isset($result['AGREGADO'])) {
                self::sendConfirmationEmail($email, $token);
                return true;
            } 
            elseif (isset($result['ERROR1'])) {
                return 'ERROR: El mail ya está registrado.';
            } 
            elseif (isset($result['ERROR2'])) {
                return 'ERROR SQL. Operación cancelada.';
            }
        } 
        catch (PDOException $e) {
            return false;
        }
    }

    public static function sendConfirmationEmail(string $email, string $token): bool {
        $mail = new PHPMailer(true);
        try {
            // Servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '669d95cf4cdb2a';    // tu Username de Mailtrap
            $mail->Password = 'a56ce2f4f1450c';          // tu Password de Mailtrap
            $mail->SMTPSecure = 'tls';               // puedes probar también 'ssl'
            $mail->Port = 2525;                // 25, 465, 587 o 2525

            $mail->setFrom('no-reply@tusitio.com', 'Mi App');
            $mail->addAddress($email);

            $mail->isHTML(false);
            $mail->Subject = 'Confirma tu cuenta';
            $link = "http://localhost:8080/confirm?token=$token";
            $mail->Body = "Gracias por registrarte. Hacé clic en el siguiente enlace para confirmar tu cuenta:\n\n$link";

            $mail->send();
            return true;
        } 
        catch (Exception $e) {
            error_log("Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }

    public static function confirmByToken(string $token): bool {
        global $pdo;

        try {
            $stmt = $pdo->prepare("CALL confirmUser(?)"); 
            $stmt->execute([$token]);
            
            $result = $stmt->fetch(); 
            
            if ($result && isset($result['VALIDADO'])) {
                return true;
            }
            else {
                return false;
            }
        } 
        catch (PDOException $e) {
            return false;
        }
    }

    public static function findByEmail(string $email): ?array {
        global $pdo;

        $stmt = $pdo->prepare("CALL checkEmail(?)");
        $stmt->execute([$email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return $user ?: null;
    }
}