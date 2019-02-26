<?php 

class Status{
    // database connection and tablename
    private $conn;
    private $tablename="status";

    // object properties
    public $id;
    public $status;
    public $category_id;
    public $created_at;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query = "INSERT INTO ".$this->tablename." 
                 SET 
                 status=:status, category_id=:category_id,author=:author,created_at=:created_at";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(":status",$this->status);
        $stmt->bindparam(":category_id",$this->category_id);
        $stmt->bindparam(":author",$this->author);
        $stmt->bindparam(":created_at",$this->created_at);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function read(){
        $query = "SELECT
         c.name as category_name ,s.id , s.status,s.created_at  
         FROM
          ".$this->tablename." s
          LEFT JOIN
            categories c 
                ON
                    s.category_id = c.id
            ORDER BY
                s.created_at  DESC;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}