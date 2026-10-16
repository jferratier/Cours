<?php 
class ArticlesController{

    private $connecteur;
    private $connexion;

    public function __construct(){
        require_once __DIR__ ."/../core/connecteur.php";
        require_once __DIR__ ."/../model/article.php";

        $this->connecteur = new Connecteur();
        $this->connexion=$this->connecteur->connexion();
    }

    public function run($action){
        switch($action){
            case "ajout" :      // formulaire d'ajout
                $this->ajout();
                break;
            case "creation" :   // traitement du formulaire d'ajout
                $this->creer();
                break;
            case "gestion" :    // liste des articles
                $this->gestion();
                break;
            case "detaille" :   // formulaire de modification
                $this->detaille();
                break;
            case "maj" :        // traitement de la modification
                $this->maj();
                break;
            case "supprimer" :
                $this->supprimer();
                break;
            case "index" :
            default :
                $this->index();
                break;
        }
    }

    /**
     * Page d'accueil
     */
    public function index(){
        $Article = new Article($this->connexion);
        $nb = count($Article->getAll());
        $this->view("index", array("titre" => "Accueil", "nbArticles" => $nb));
    }

    /**
     * Page dédiée à l'ajout
     */
    public function ajout(){
        $this->view("ajout", array("titre" => "Ajouter un article"));
    }

    public function creer(){
        if(isset($_POST["nom"], $_POST["prix"], $_POST["poid"])){
            $Article=new Article($this->connexion);
            $Article->setArt_nom($_POST["nom"]);
            $Article->setArt_prix($_POST["prix"]);
            $Article->setArt_poid($_POST["poid"]);
            $Article->insert();
            $_SESSION["message"] = "Article ajouté.";
        }
        header('Location: index.php?controller=articles&action=gestion');
        exit;
    }

    /**
     * Page dédiée à la gestion (liste + modifier / supprimer)
     */
    public function gestion(){
        $Article = new Article($this->connexion);
        $listeArticles = $Article->getAll();
        $this->view("gestion", array("articles" => $listeArticles, "titre" => "Gérer les articles"));
    }

    public function detaille(){
        if(!isset($_GET["id"])){
            header('Location: index.php?controller=articles&action=gestion');
            exit;
        }
        $Article = new Article($this->connexion);
        $unArticle = $Article->getById($_GET["id"]);
        if(!$unArticle){
            $_SESSION["message"] = "Article introuvable.";
            header('Location: index.php?controller=articles&action=gestion');
            exit;
        }
        $this->view("detaille", array("article"=>$unArticle,"titre" => "Modifier un article"));
    }

    public function maj(){
        if(isset($_POST["id"])){
            $Article=new Article($this->connexion);
            $Article->setArt_id($_POST["id"]);
            $Article->setArt_nom($_POST["nom"]);
            $Article->setArt_prix($_POST["prix"]);
            $Article->setArt_poid($_POST["poid"]);
            $Article->update();
            $_SESSION["message"] = "Article modifié.";
        }
        header('Location: index.php?controller=articles&action=gestion');
        exit;
    }

    public function supprimer(){
        // Suppression en POST (et non en GET) pour éviter une suppression par simple lien
        if(isset($_POST["id"])){
            $Article = new Article($this->connexion);
            $Article->setArt_id($_POST["id"]);
            $Article->delete();
            $_SESSION["message"] = "Article supprimé.";
        }
        header('Location: index.php?controller=articles&action=gestion');
        exit;
    }

    public function view($name,$data){
        require_once __DIR__ . "/../view/" . $name . "View.php";
    }

}
