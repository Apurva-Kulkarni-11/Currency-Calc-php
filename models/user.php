<?php

use function PHPSTORM_META\type;

class User {
    private $conn;
    private $table_name = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function validateUser($username, $password, $ip) {
        echo gettype($ip);
        
        $statement = $this->conn->prepare("select * from users where username = :username"); 
        $statement->execute(array(':username' => $username));
        //$row = $statement->fetch();
        //echo $row;

        if ($statement->rowCount() > 0){
            echo "Row count successful";
            $check = $statement->fetchAll(PDO::FETCH_ASSOC);
            $row_id = $check[0];
            echo implode(',', $row_id);
        
        }
        return true;
    }
}
?>
