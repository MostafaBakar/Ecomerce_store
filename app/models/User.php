<?php

include '../../database/DBController.php';

class User
{

  protected $con;


  public function __construct()
  {
    $db = new DBController();
    $this->con = $db->getConn();
  }


  public function getAll()
  {
    $con = $this->con;


    $query = "SELECT * FROM users";
    $result = mysqli_query($con, $query);
    

    if (!$result) {
      die("Couldn't connect to categories table");
    }


    return $result;
  }




  public function create($data)
  {
    $name = $data['name'];
    $email = $data['email'];
    $password = $data['password'];

    $query = "INSERT INTO users (name, email, password) VALUES ('$name','$email','$password')";

    if (!mysqli_query($this->con, $query)) {
      die('Could not insert the cateon into the database');
    }

    return true;
  }




  public function fetchAssoc()
  {
    $result = $this->getAll();
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);


    return $data;
  }


  public function show($id)
  {
    $query = "SELECT * FROM categories WHERE id = '$id'";
    $result = mysqli_query($this->con, $query);

    if (!$result) {
      die('Could not find category');
    }

    return mysqli_fetch_assoc($result);
  }


  public function delete($id)
  {
    $query = "DELETE FROM categories WHERE id = '$id'";

    $result = mysqli_query($this->con, $query);

    if (!$result) {
      die('Could not delete category');
    }
    
    return true;
  }
}
