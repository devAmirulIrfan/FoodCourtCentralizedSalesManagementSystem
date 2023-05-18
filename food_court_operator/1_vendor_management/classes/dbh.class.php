<?php

// $out = new test();
// $out->getUsers();

// $out2 = new test();
// $out2->getUsers("admin","admin");


class Dbh{

    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "fyp";

    protected function connect(){
        $dsn = 'mysql: host='. $this->host . ';dbname=' .$this->dbName;
        $pdo = new PDO($dsn , $this->user , $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE , PDO::FETCH_ASSOC);
        return $pdo;
    }
}

// class test extends Dbh{

//     public function getUsers(){
//         $sql = "SELECT * FROM acc_fc_operator" ;
//         $stmt = $this->connect()->query($sql);
//         while($row = $stmt->fetch()){
//             echo $row["username"] . $row["password"];
//         }
        
//     }

//     public function getUsersStmt($username,$password){
//         $sql = "SELECT * FROM acc_fc_operator WHERE username = ? AND password = ?" ;
//         $stmt = $this->connect()->prepare($sql);
//         $stmt->execute([$username,$password]);
//         $names = $stmt->fetchAll();

//         foreach($names as $name){
//             echo $name["username"] . $name["password"];
//         }
        
//     }
// }

?>