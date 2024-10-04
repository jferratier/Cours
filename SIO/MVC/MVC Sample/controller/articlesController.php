<?php
class Articlescontroller{
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
            case "index" :
                $this->index();
                break;
            case "creer" :
                $this->creer();
                break;
            case "detail" :
                $this->detail();
                break;
            case "maj" :
                $this->maj();
                break;
            default :
                $this->index();
                break;
        }
    }

    public function index(){
        $Article = new Article($this->connexion);
        $listeArticles = $Article->getAll();
        $this->view("index", array("articles"=>$listeArticles, "titre"=> "PHP MVC"));
    }
    public function detail(){
        $Article = new Article($this->connexion);
        $unArticle = $Article->getById($_GET["id"]);
        $this->view("detail", array("article"=>$unArticle, "titre"=> "Detail Article"));
    }
    public function creer(){
        $Article = new Article($this->connexion);
        $Article->setArt_nom($_POST["nom"]);
        $Article->setArt_prix($_POST["prix"]);
        $Article->setArt_poid($_POST["poid"]);
        if($Article->insert()){
            header('Location: index.php');
            exit;
        }
    }
    public function maj(){
        $Article = new Article($this->connexion);
        $Article->setArt_id($_POST["id"]);
        $Article->setArt_nom($_POST["nom"]);
        $Article->setArt_prix($_POST["prix"]);
        $Article->setArt_poid($_POST["poid"]);
        if($Article->update())
            header('Location : index.php');
    }
    function view($name,$data){
        require_once __DIR__ . "/../view/". $name . "View.php";
    }
}