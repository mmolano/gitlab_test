<?php 

class Database
{

  private $host;
  private $username;
  private $password;
  private $dbname;
  private $charset;

  public function __construct(){
    $this->host = "localhost";
    $this->username = "root";
    $this->password = "root";
    $this->dbname = "weeb_project";
    $this->charset = "utf8";
  }

  public function connect(){
    try{
      $bdd = "mysql:host=".$this->host.";dbname=".$this->dbname.";charset=".$this->charset;
      $pdo = new PDO($bdd, $this->username, $this->password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    }catch(PDOException $e){
      echo "connection failed: ".$e->getMessage();
    }
  }

 
}



?>