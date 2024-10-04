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
            case "index" :
                $this->index();
                break;
            case "read" :
                $this->read();
                break;
            case "getAll" :
                $this->getAll();
                break;
            case "edition" :
                $this->edition();
                break;
            case "create" :
                $this->create();
                break;
            case "save" :
                $this->save();
                break;
            case "delete" :
                $this->delete();
                break;
            default :
                $this->index();
                break;
        }


    }

    /**
     * Chargement des articles sur la page d'accueil
     */
    public function index(){
        // on charge un objet modele Article
        //$Article = new Article($this->connexion);
        //$listeArticles = $Article->getAll();
        //$this->view("index",array("articles"=>$listeArticles,"titre"=> "PHP MVC"));
        header('Location: welcome.php');
    }   

    public function read(){
        // on charge un objet modele Article
        $Article = new Article($this->connexion);
        $unArticle = $Article->getById($_GET["id"]);
        $this->view("articleRead", array("article"=>$unArticle,"titre" => "Article"));
    }


    public function save(){
        if(isset($_POST["id"])){
            $Article=new Article($this->connexion);
            $Article->setArt_id($_POST["id"]);
            $Article->setArt_Nom($_POST["nom"]);
            $Article->setArt_Prix($_POST["prix"]);
            $Article->setArt_Poid($_POST["poid"]);
            $save=$Article->update();
        }
        else
        {
            $Article=new Article($this->connexion);
            $Article->setArt_Nom($_POST["nom"]);
            $Article->setArt_Prix($_POST["prix"]);
            $Article->setArt_Poid($_POST["poid"]);
            $insert=$Article->insert(); 
        }
        header('Location: index.php?controller=articles&action=getAll');
    }

    public function delete(){
        if(isset($_GET["id"])){
            $Article=new Article($this->connexion);
            $Article->setArt_id($_GET["id"]);
            $save=$Article->delete();
        }
        header('Location: index.php?controller=articles&action=getAll');
    }


    public function edition(){
        // on charge un objet modele Article
        $Article = new Article($this->connexion);
        $unArticle = $Article->getById($_GET["id"]);
        $this->view("articleUpdate", array("article"=>$unArticle,"titre" => "Edition Article"));
    }


    public function create(){
        $Article = new Article($this->connexion);
        $this->view("articleCreate", array("article"=>$Article,"titre" => "Ajout Article"));
    }

    public function getAll(){
        $Article = new Article($this->connexion);
        $listeArticles = $Article->getAll();
        $this->view("articleList",array("articles"=>$listeArticles,"titre"=> "Liste des articles"));
    }

    public function view($name,$data){
        require_once __DIR__ . "/../view/article/" . $name . "View.php";
    }

    

}