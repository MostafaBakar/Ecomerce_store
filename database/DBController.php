<?php

class DBController
{
    // Database Connection Properties
    // protected $host = 'localhost';
    // protected $user = 'root';
    // protected $password = '';
    // protected $database = "shopee";
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'shopee';

    // connection property
    public $con = null;

    // call constructor
    public function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if ($this->con->connect_error){
            echo "Fail " . $this->con->connect_error;
        }
    }
    //way to connect data
    // public function __construct()
    // {
    //   $conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
  
    //   if (mysqli_error($conn)) {
    //     die("Database connection failed: " . mysqli_connect_error());
    //   }
  
    //   $this->conn = $conn;
    // }
  
  
    public function getConn()
    {
      return $this->con;
    }

    // public function __destruct()
    // {
    //     $this->closeConnection();
    // }

    // for mysqli closing connection
    // protected function closeConnection(){
    //     if ($this->con != null ){
    //         $this->con->close();
    //         $this->con = null;
    //     }
    // }
}
