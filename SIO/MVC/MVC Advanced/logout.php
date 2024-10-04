<?php
session_start();

//echo __DIR__ ; exit;
require_once __DIR__ ."/controller/utilsController.php";
require_once __DIR__ ."/core/connecteur.php";

$connecteur = new Connecteur();
$connexion=$connecteur->connexion();

$util = new UtilsController();

//Clear Session
$_SESSION["member_id"] = "";
session_destroy();

// clear cookies
$util->clearAuthCookie();

header("Location: login.php");



?>