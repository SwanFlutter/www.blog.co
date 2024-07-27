<?php

namespace Database;

class Database
{
   private $host = "localhost";
   private $user = "root";
   private $password = "";
   private $database = "blog";
   public $conn;
   public function __construct()
   {
      $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);

      if ($this->conn->connect_error) {
         die("Connection failed: " . $this->conn->connect_error);
      }
   }
}