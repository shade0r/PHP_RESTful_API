<?php 
declare(strict_types=1);
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
ini_set('log_errors', 'On');
ini_set('error_log','logs/php_errors.log');
spl_autoload_register(function($class){
    require __DIR__."/src/$class.php";
});
set_error_handler("ErrorHandler::handleErrors");
set_exception_handler("ErrorHandler::handleException");
$conn = new Database('localhost','API_data','shade0r','phpmyadmin');
header("Content-type:application/json; charset=UTF-8");
$headers = getallheaders();
$authHeader = "Authorization";
if (!array_key_exists($authHeader,$headers)) {
    // Return an error response if the header is missing
    header('HTTP/1.1 401 Unauthorized');
    echo 'Authorization header missing';
	exit;
}
$auth_user = new AuthenticateController($headers[$authHeader],$conn);
$auth_user->validateToken();
$parts = explode('/',$_SERVER['REQUEST_URI']);
if ($parts[1] != 'products'){
    http_response_code(404);
    exit;
}
$id = $parts[2] ?? null;
$gateway = new ProductGateway($conn);
$product = new ProductController($gateway);
$product->processRequest($_SERVER['REQUEST_METHOD'],$id);
