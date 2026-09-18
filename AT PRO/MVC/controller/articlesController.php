<?php
    class ArticlesController{

        private $connecteur;
        private $connexion;

        public function __construct(){
            requiere_once __DIR__ ."/../core/connecteur.php";
            requiere_once __DIR__ . "/../model/article.php";
        }

        public fucntion run($action){
            switch($action){
                case "index" :
                    $this->index();
                    break;
                case "creation" :
                    $this->creer();
                    break;
                case "detaille" :
                    $this->detaille();
                    break;
                case "maj" :
                    $this->maj();
                    break;
                default : 
                    $this-> index();    
            }
        }

        public function index(){
            $Article = new Article ($this->connexion);
            $listeArticles = $Article->getAll();
            $this->view("index", array("articles"=>$listeArticles, 
            "titre" => "PHP MVC"));
        }

        public function detaille(){
            $Article = new Article ($this->connexion);
            $unArticle = $Article->getById($_GET["id"]);
            $this->view("detaille", array("article"=>$unArticle,
            "titre"=> "Detaille Article"));
        }

        public function creer(){
            $Article=new Article($this->connexion);
            $Article->setArt_Nom("nom");
            $Article->setArt_Prix("prix");
            $Article->setArt_Poid("poid");
            $Article->insert();
            header('Location: index.php');
        }

        public function maj(){
            if(isset($_POST["id"])){
                $Article->setArt_id($_POST["id"]);
                $Article->setArt_Nom($_POST["nom"]);
                $Article->setArt_Prix($_POST["prix"]);
                $Article->setArt_Poid($_POST["poid"]);
                $save=$Article->update();
            }
        }

        public function view ($name,$data){
            require_once __DIR__ ."/../view/". $name . "View.php";
        }


    }
?>