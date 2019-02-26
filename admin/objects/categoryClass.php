<?php
class Category{
    private $conn;
    private $tablename = "categories";

    public $id;
    public $name;
    public $description;
    public $created;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query = "INSERT INTO ".$this->tablename."
                    SET
                    name=:name,description =:description,created=:created";
        $stmt = $this->conn->prepare($query);

        $stmt->bindparam(":name",$this->name);
        $stmt->bindparam(":description",$this->description);
        $stmt->bindparam(":created",$this->created);
        return $stmt->execute();
    }

}