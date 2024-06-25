<?php
session_start();
require_once '../config/db.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/CurrencyController.php';

$database = new Database();
$db = $database->getConnection();

$authController = new AuthController($db);
$currencyController = new CurrencyController($db);

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'login':
        echo "inside login";
        $username = $_POST['username'];
        $password = $_POST['password'];
        $ip = $_SERVER['REMOTE_ADDR'];
        echo $ip;
        if ($authController->login($username, $password, $ip)) {
            $_SESSION['username'] = $username;
            header("Location: index.php?action=dashboard");
        } else {
            echo "Invalid credentials or unauthorized IP.";
        }
        break;
    
    case 'logout':
        $authController->logout();
        header("Location: index.php");
        break;

    case 'dashboard':
        if (isset($_SESSION['username'])) {
            $currencyController->updateRates();
           // $exchange_rate = $currencyController->getRates();
            include '../views/dashboard.php';
        } else {
            header("Location: index.php");
        }
        break;

    case 'convert':
        if (isset($_SESSION['username'])) {
            $from = $_POST['fromCurrency'];
          //  echo $from;
            $amount = $_POST['amount'];
          //  echo $amount;
            $results = $currencyController->convert($from, $amount);
            //$rates = $currencyController->getRates();
            header('Location: index.php?action=dashboard&results=' . urlencode(json_encode($results)));
            include '../views/dashboard.php';
        } else {
            header("Location: index.php");
        }
        break;

    default:
        include '../views/login.php';
}
?>
