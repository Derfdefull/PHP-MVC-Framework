<?php

class LoginModel extends Model{


    function __construct()
    {
        parent::__construct();
    }

    function SignIn($Data, $qry){
        $query = $this->db->connect()->prepare($qry);
        $query->execute($Data);
        return (count($query->fetchAll(PDO::FETCH_ASSOC)) > 0);
    }

    function SignUp($Data){
        try {
            $query = $this->db->connect()->prepare("INSERT INTO `user`(`Username`, `UserPassword`, `Email`) VALUES (:User,:Pwd,:Email)");
            $query->execute($Data); 
            return true;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
     }
}
?>