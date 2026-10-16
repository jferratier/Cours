<?php
class AuthController{

    private $connecteur;
    private $connexion;

    public function __construct(){
        require_once __DIR__ . "/../core/connecteur.php";
        require_once __DIR__ . "/../model/utilisateur.php";

        $this->connecteur = new Connecteur();
        $this->connexion  = $this->connecteur->connexion();
    }

    public function run($action){
        switch($action){
            case "logout" :
                $this->logout();
                break;
            case "login" :
            default :
                $this->login();
                break;
        }
    }

    /**
     * Affiche le formulaire (GET) ou vérifie les identifiants (POST)
     */
    public function login(){
        $erreur = "";

        if(isset($_POST["login"], $_POST["mdp"])){
            $Utilisateur = new Utilisateur($this->connexion);
            // ATTENTION : mot de passe stocké en clair (demande pédagogique)
            $user = $Utilisateur->verifier($_POST["login"], $_POST["mdp"]);

            if($user){
                $_SESSION["utilisateur"] = array(
                    "id"     => $user->uti_id,
                    "login"  => $user->uti_login,
                    "nom"    => $user->uti_nom,
                    "prenom" => $user->uti_prenom
                );
                header('Location: index.php');
                exit;
            }
            $erreur = "Identifiant ou mot de passe incorrect.";
        }

        $this->view("login", array("titre" => "Connexion", "erreur" => $erreur));
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }

    public function view($name, $data){
        require_once __DIR__ . "/../view/" . $name . "View.php";
    }
}
