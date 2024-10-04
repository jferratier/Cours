<?php
    class Auth{
        private $table="tbl_token_auth"; 
        private $Connexion;

        private $id;
        private $username; 
        private $password_hash; 
        private $selector_hash; 
        private $is_expired; 
        private $expiry_date ; 

        public function __construct($Connexion){
            $this->Connexion = $Connexion;
        }

        public function getId(){
            return $this->id;
        }
        public function getUsername(){
            return $this->username;
        }
        public function getPassword_hash(){
            return $this->password_hash;
        }
        public function getSelector_hash(){
            return $this->selector_hash;
        }
        public function getIs_expired(){
            return $this->is_expired;
        }
        public function getExpiry_date(){
            return $this->expiry_date;
        }

        public function setId($id){
            $this->id = $id;
        }
        public function setUsername($username){
            $this->username = $username;
        }
        public function setPassword_hash($password_hash){
            $this->password_hash= $password_hash;
        }
        public function setSelector_hash($selector_hash){
            $this->selector_hash = $selector_hash;
        }
        public function setIs_expired($is_expired){
            $this->is_expired= $is_expired;
        }
        public function setExpiry_date($expiry_date){
            $this->expiry_date = $expiry_date;
        }


        public function getAll(){
            $query = $this->Connexion->prepare("SELECT id, username, password_hash, selector_hash, is_expired, expiry_date FROM " . $this->table ); 
            $query->execute();
            $result = $query->fetchAll();
            $this->Connexion = null;
            return $result;
        }

        public function getById($id){
            $query = $this->Connexion->prepare("SELECT * FROM ".
                $this->table. " WHERE id = :id");
            $query->execute(array(
                "id" => $id 
            ));
            $result = $query->fetchObject();
            $this->Connexion = null;
            return $result;
        }

        public function getTokenByUsername($username,$expired){
            $query = $this->Connexion->prepare("SELECT * FROM ".
                $this->table. " WHERE username = :username AND  is_expired = :is_expired");
            $query->execute(array(
                "username" => $username ,
                "is_expired" => $expired 
            ));
            $result = $query->fetchObject();
            $this->Connexion = null;
            return json_decode(json_encode($result), true); // Transformation de l'objet STDClass en tableau$result;
        }

        public function markAsExpired($tokenId){
            $query = $this->Connexion->prepare("
                UPDATE " . $this->table . " 
                SET is_expired = 1 
                WHERE id  = :id 
            ");

            $result = $query->execute(array(
                "id" => $tokenId 
            ));

            $this->Connexion = null;
            return json_decode(json_encode($result), true); // Transformation de l'objet STDClass en tableau $result;
        }

        public function insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date){
            $query = $this->Connexion->prepare("INSERT INTO " . $this->table . " (username, password_hash, selector_hash, expiry_date)
                    VALUES (:username, :random_password_hash, :random_selector_hash, :expiry_date)
            "); 
            // Correction $this->Art_nom --> $this->art_nom
            $result = $query->execute(array(
                "username" => $username,
                "random_password_hash" =>  $random_password_hash ,
                "random_selector_hash" => $random_selector_hash ,
                "expiry_date" => $expiry_date 
            ));
            $this->Connexion = null;
            return json_decode(json_encode($result), true); // Transformation de l'objet STDClass en tableau $result;
        }

        //TODO faire l'insert, update, delete
        
    }

?>