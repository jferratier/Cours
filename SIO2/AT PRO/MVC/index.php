<?php
/*
 * Contrôleur frontal (point d'entrée unique de l'application)
 * URL de la forme : index.php?controller=articles&action=gestion
 */
session_start();

require_once 'config/global.php';

$controller = isset($_GET["controller"]) ? strtolower($_GET["controller"]) : CONTROLLER_DEFAULT;
$action     = isset($_GET["action"]) ? $_GET["action"] : ACTION_DEFAULT;

// Protection : toute page autre que l'authentification nécessite d'être connecté
if (!isset($_SESSION["utilisateur"]) && $controller != "auth") {
    header('Location: index.php?controller=auth&action=login');
    exit;
}

$controllerObj = loadController($controller);
$controllerObj->run($action);

function loadController($controller){
    switch ($controller){
        case 'auth':
            require_once 'controller/authController.php';
            $controllerObj = new AuthController();
            break;

        case 'articles':
        default:
            require_once 'controller/articlesController.php';
            $controllerObj = new ArticlesController();
            break;
    }
    return $controllerObj;
}
