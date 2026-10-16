<?php
    class Utilisateur{
        private $table = "utilisateur";
        private $Connexion;

        public function __construct($Connexion){
            $this->Connexion = $Connexion;
        }

        /**
         * Retourne l'utilisateur si login + mot de passe correspondent, sinon false.
         * ATTENTION : mot de passe en clair (à remplacer par password_hash / password_verify)
         */
        public function verifier($login, $mdp){

            //Sensible au injections SQL 
            //$sql = "SELECT * FROM utilisateur WHERE uti_login = '$login' AND uti_mdp = '$mdp'";
            //$this->Connexion->query($sql);

            //Requete PDO préparé : Non sensible aux injections SQL 
            $query = $this->Connexion->prepare("SELECT uti_id, uti_login, uti_nom, uti_prenom FROM "
                . $this->table . " WHERE uti_login = :login AND uti_mdp = :mdp");
            $query->execute(array(
                "login" => $login,
                "mdp"   => $mdp
            ));
            return $query->fetchObject();
        }
    }
?>
