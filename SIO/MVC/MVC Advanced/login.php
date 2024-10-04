<?php
session_start();

//echo __DIR__ ; exit;
require_once __DIR__ ."/model/auth.php";
require_once __DIR__ ."/controller/utilsController.php";
require_once __DIR__ ."/core/connecteur.php";
require_once __DIR__ ."/controller/authenticateController.php";

$connecteur = new Connecteur();
$connexion=$connecteur->connexion();

$auth = new Auth($connexion);
$member = new Member($connexion);
$util = new UtilsController();



if ($isLoggedIn) {
    //$util->redirect("dashboard.php");
    //echo "isConnected";
    header('Location: welcome.php');
}

if (! empty($_POST["login"])) {
    $isAuthenticated = false;
    
    $username = $_POST["member_name"];
    $password = $_POST["member_password"];
    
    $user = $member->getMemberByUsername($username); 

    // INFO : var_dump équivalent de echo en plus poussé
    //var_dump($user);
    //echo $password;
    //echo $user["member_password"];
    //echo password_hash("admin", PASSWORD_DEFAULT);

    if (password_verify($password, $user["member_password"])) {
        $isAuthenticated = true;
    }
    
    if ($isAuthenticated) {
        $_SESSION["member_id"] = $user["member_id"];
        $_SESSION["member_name"] = $user["member_name"];
        
        // Set Auth Cookies if 'Remember Me' checked
        if (! empty($_POST["remember"])) {
            setcookie("member_login", $username, $cookie_expiration_time);
            
            $random_password = $util->getToken(16);
            setcookie("random_password", $random_password, $cookie_expiration_time);
            
            $random_selector = $util->getToken(32);
            setcookie("random_selector", $random_selector, $cookie_expiration_time);
            
            $random_password_hash = password_hash($random_password, PASSWORD_DEFAULT);
            $random_selector_hash = password_hash($random_selector, PASSWORD_DEFAULT);
            
            $expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);
            
            // mark existing token as expired
            $userToken = $auth->getTokenByUsername($username, 0);
            if (! empty($userToken["id"])) {
                $auth->markAsExpired($userToken["id"]);
            }
            // Insert new token
            $auth->insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date);
        } else {
            $util->clearAuthCookie();
        }
        header('Location: welcome.php'); //$util->redirect("dashboard.php");
    } else {
        $message = "Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <style>
        input{
            margin-top:5px;
            margin-bottom:5px;
        }
        .right{
            float:right;
        }
    </style>
        <!-- Bibliothèque Fontawesome pour les icones  -->
        <link href="/assets/image/fontawesome-free-6.4.0-web/css/fontawesome.min.css" rel="stylesheet" />
    <link href="/assets/image/fontawesome-free-6.4.0-web/css/brands.min.css" rel="stylesheet"/>
    <link href="/assets/image/fontawesome-free-6.4.0-web/css/solid.min.css" rel="stylesheet"/> 
    <!-- Bibliothèque Boostrap pour la mise en page  -->
    <link rel="stylesheet" href="/assets/bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="/assets/bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

    <div class="container mt-3">
        <style>
             #frmLogin { width:50%; height:420px;  
                border-radius:3px; box-shadow: 2px 2px 6px grey; 
                background:white;position:absolute;
                top:30%;left:25%; padding-top:5%;padding-bottom:5%; text-align:left;}
        </style>
        
        <form action="" method="post" id="frmLogin" style="padding: 50px; ">
            <h2 style="text-align:center">Application Test</h2>
            <br>
            <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
            <div class="field-group">
                <div>
                    <label for="login">Username</label>
                </div>
                <div>
                    <input name="member_name" type="text"
                        value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>"
                        class="form-control">
                </div>
            </div>
            <br>
            <div class="field-group">
                <div>
                    <label for="password">Password</label>
                </div>
                <div>
                    <input name="member_password" type="password"
                        value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"
                        class="form-control">
                </div>
            </div>
            <br>
            <div class="field-group">
                <div>
                    <input type="checkbox" name="remember" id="remember"
                        <?php if(isset($_COOKIE["member_login"])) { ?> checked
                        <?php } ?> /> <label for="remember-me">Remember me</label>
                </div>
            </div>
            <div class="field-group">
                <div style="text-align:center">
                    <input type="submit" name="login" value="Login" 
                        class="btn btn-success"></span>
                </div>
            </div>
        </form>
    </div>

</body>
</html>