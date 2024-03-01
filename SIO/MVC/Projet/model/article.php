<?php
    class Article{
        private $table="article"; 
        private $Connexion;

        private $art_id;
        private $art_nom; 
        private $art_prix; 
        private $art_poid; 

        public function __construct($Connexion){
            $this->Connexion = $Connexion;
        }

        public function getArt_id(){
            return $this->art_id;
        }
        public function getArt_nom(){
            return $this->art_nom;
        }
        public function getArt_prix(){
            return $this->art_prix;
        }
        public function getArt_poid(){
            return $this->art_poid;
        }

        public function setArt_id($id){
            $this->art_id = $id;
        }
        public function setArt_nom($nom){
            $this->art_nom = $nom;
        }
        public function setArt_prix($prix){
            $this->art_prix = $prix;
        }
        public function setArt_poid($poid){
            $this->art_poid = $poid;
        }


        public function getAll(){
            $query = $this->Connexion->prepare("SELECT art_id, art_nom, art_prix, art_poid FROM " . $this->table ); //correction article -> $this->table
            $query->execute();
            $result = $query->fetchAll();
            $this->Connexion = null;
            return $result;
        }

        public function getById($id){
            $query = $this->Connexion->prepare("SELECT art_id, art_nom, art_prix, art_poid FROM ".
                $this->table. " WHERE art_id = :id");
            $query->execute(array(
                "id" => $id 
            ));
            $result = $query->fetchObject();
            $this->Connexion = null;
            return $result;
        }

        public function insert(){
            $query = $this->Connexion->prepare("INSERT INTO " . $this->table . " (art_nom, art_prix, art_poid)
                    VALUES (:nom,:prix,:poid)
            "); 
            // Correction $this->Art_nom --> $this->art_nom
            $result = $query->execute(array(
                "nom" => $this->art_nom,
                "prix" =>  $this->art_prix ,
                "poid" => $this->art_poid ,
            ));
            $this->Connexion = null;
            return $result;
        }

        public function update(){
            $query = $this->Connexion->prepare("
                UPDATE " . $this->table . " 
                SET art_nom= :nom, art_prix= :prix, art_poid= :poid 
                WHERE art_id = :id 
            ");

            $result = $query->execute(array(
                "id" => $this->art_id ,
                "nom" => $this->art_nom ,
                "prix" => $this->art_prix ,
                "poid" => $this->art_poid ,
            ));

            $this->Connexion = null;
            return $result;
        }



    }

?>