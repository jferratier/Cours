<?php
require_once 'config/global.php';

//gestion du controler par defaut.
if(isset($_GET["controller"])){
    $controllerObj = loadController($_GET["controller"]);
    loadAction($controllerObj);
}else{
    $controllerObj=loadController(CONTROLLER_DEFAULT);
    loadAction($controllerObj);
}


function loadController($controller){
    switch($controller){
        case 'Articles' :
            $strFileController = 'controller/articlesController.php';
            require_once $strFileController;
            $controllerObj = new ArticlesController();
        break;
        
        default:
            $strFileController = 'controller/articlesController.php';
            require_once $strFileController;
            $controllerObj = new ArticlesController();
        break;
    }
}

function loadAction($controllerObj){
    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(ACTION_DEFAULT);
    }
}