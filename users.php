<?php
class User{

    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $password;
    public $created;

    public function __construct($db){
        $this->conn-$db;
    }

    function signup()
    {
        if($this->isAlreadyExist()){
            return false;
        }

        $query ="Insert into ". $this->table_name.
                                "username=:username,
                                passowrd=:password";

        $stmt=$this->conn->prepare($query);

        $this->username=htmlspecialchars(strip_tags($this->username))
        $this->password=htmlspecialchars(strip_tags($this->password))

        $stmt->bindParam(":username",$this->username);
        $stmt->bindParam(":password",$this->password);

        if($stmt->execute()){
            $this->id=$this->conn->lastInsertId()
            return true;
        }

        return false;
    }

    fucntion login(){
        $query="Select 'id', 'username','password'
        FROM
        " .$this->table_name."
        WHERE
        username='".$this->username."'
        and password='".$this->password."'";

        $stmt=$this->conn->prepare($query);

        $stmt->execute();
        return $stmt;

    }
    function isAlreadyExists(){
        $query="select * from ". 
        $this->table_name ."
        where
        username='".$this->username."'";

        $stmt=$this->conn->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0){
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>