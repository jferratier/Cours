<?php
class member {
    private $table="members"; 
    private $Connexion;
    private $member_id ;
    private $member_name; 
    private $member_password; 
    private $member_email; 

    public function __construct($Connexion){
        $this->Connexion = $Connexion;
    }

    public function getMember_id(){
        return $this->member_id;
    }
    public function getMember_name(){
        return $this->member_name;
    }
    public function getMember_password(){
        return $this->member_password;
    }
    public function getMember_email(){
        return $this->member_email;
    }

    public function setMember_id($id){
        $this->member_id = $id;
    }
    public function setMember_name($name){
        $this->member_name = $name;
    }
    public function setMember_password($password){
        $this->member_password = $password;
    }
    public function setMember_email($email){
        $this->member_email = $email;
    }


    public function getAll(){
        $query = $this->Connexion->prepare("SELECT member_id, member_name, member_password, member_email FROM " . $this->table ); 
        $query->execute();
        $result = $query->fetchAll();
        $this->Connexion = null;
        return $result;
    }

    public function getById($id){
        $query = $this->Connexion->prepare("SELECT member_id, member_name, member_password, member_email FROM ".
            $this->table. " WHERE member_id = :id");
        $query->execute(array(
            "id" => $id 
        ));
        $result = $query->fetchObject();
        $this->Connexion = null;
        return $result;
    }

    public function getMemberByUsername($username){
        $query = $this->Connexion->prepare("SELECT member_id, member_name, member_password, member_email FROM ".
            $this->table. " WHERE member_name = :username");
        $query->execute(array(
            "username" => $username 
        ));
        $result = $query->fetchObject();
        $this->Connexion = null;
        return json_decode(json_encode($result), true); // Transformation de l'objet STDClass en tableau
    }

    //TODO faire l'insert, update, delete

}

?>