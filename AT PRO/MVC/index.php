<?php 

require_once 'config/global.php';

if(isset($_GET["controller"])){

        $controllerObj = loadController($_GET["controller"]);
        loadAction($controllerObj ); // correction  $controller(CONTROLLER_DEFAULT) --> $controllerObj 
}else{
    $controllerObj=loadController(CONTROLLER_DEFAULT);
    loadAction($controllerObj);
}

function loadController($controller){
    switch ($controller){
        case 'Articles':
            $strFileController='controller/articlesController.php';
            require_once $strFileController;
            $controllerObj=new ArticlesController();
            break;
        
        default:
            $strFileController='controller/articlesController.php';
            require_once $strFileController;
            $controllerObj=new ArticlesController();
            break; 
    }
    return $controllerObj; // correction ligne manquante
}

function loadAction($controllerObj){

    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(ACTION_DEFAULT);
    }
}