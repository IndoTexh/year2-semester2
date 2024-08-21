
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "attendance";


try {
    $conn = mysqli_connect($host, $username, $password, $database);

    if ($conn->connect_error) {
        throw new Exception("Connetion: Failed" . $conn->connect_error);
    } else {
    }
} catch (Exception $e) {
    echo "Error:" . $e->getMessage();
}

/*  class Database{
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct($host, $username, $password, $database){
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect(){
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if($this->conn->connect_error){
            die("Connection: Failed" . $this->conn->connect_error);
        }else{
            
        }
    }

    public function closeConnection(){
        $this->conn->close();
    }

    public function getConnection(){
        return $this->conn;
    }
   }

   $host = "localhost";
   $username = "root";
   $password = "";
   $database = "schooltbl";
   $conn;

   $db = new Database($host, $username, $password, $database);
   $db->connect();
   $connect = $db->getConnection();
   $db->closeConnection(); */
?>