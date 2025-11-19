<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', 1);
session_start();
//define('CONFIG', dirname(__FILE__) . 'config.php');
require_once('config.php');

function class_autoload($class_name): bool
{

    $file = 'class/' . $class_name . '.Class.php';
    if (!file_exists($file)) {
        return false;
    }
    require_once($file);
    return true;
}

spl_autoload_register('class_autoload');

$auth_object = new Auth();
$user_object = new UserPage();

if (isset($_GET['do']) && $_GET['do'] == 'logout') {
    unset($_SESSION['user']);
    header("Location: index.php");
}

if ($auth_object->check_auth()) {
    $user_object->index();
    return true;
}

if (isset($_POST['register']) && $_POST['register'] == 'go') {

    if ($user_object->saveNewUser($_POST)) {
        header("Location: index.php");
    } else {
        return $user_object->registerUser();
    }
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    if ($auth_object->checkUserPassword($_POST['email'], $_POST['password'])) {
        $user_object->index();
        return true;
    }
}

if (isset($_GET['do']) && $_GET['do'] == 'register') {
    $user_object->registerUser();
    return true;
}



$auth_object->index();
