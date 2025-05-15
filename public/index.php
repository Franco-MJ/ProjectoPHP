<?php
//php -S localhost:8000

// Autoload PSR‑4
spl_autoload_register(function($c){
    $file = __DIR__ . '/../app/' . str_replace('\\','/',$c) . '.php';
    if (file_exists($file)) require $file;
});

$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/favicon.ico') {
    http_response_code(204); 
    exit;
}

if ($uri === '/' && $method === 'GET') {
    header('Location: /login', true, 302);
    exit;
}

if ($uri === '/login' && $method === 'GET') {
    (new Controllers\LoginController)->showLogin();
}
elseif ($uri === '/login' && $method === 'POST') {
    (new Controllers\LoginController)->tryLogin();
}
elseif ($uri === '/register' && $method === 'GET') {
    (new Controllers\RegisterController)->showRegister();
}
elseif ($uri === '/forgot-password' && $method === 'GET') {
    (new Controllers\ForgotPasswordController)->showForgotPassword();
}
else {
    http_response_code(404);
    echo "Página no encontrada";
}