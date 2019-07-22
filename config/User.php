<?php 

class User extends Database
{

  public function create($fields){
    try{
      $implodeColumns = implode(', ', array_keys($fields));
      $implodePlaceHolder = implode(", :", array_keys($fields));

      $sql = "INSERT INTO user ($implodeColumns) VALUES (:".$implodePlaceHolder.")";
      $stmt = $this->connect()->prepare($sql); 

      foreach($fields as $k => $value){
        $stmt->bindValue(':'.$k,$value);
      }

      $execute = $stmt->execute();

      if($execute){
        header('Location: Login.php');
      }

    }catch(PDOException $e){
      echo 'il y a une erreur : ' .$e->getMessage();
    }
  }

  public function ReadUsers(){
    $stmt = $this->connect()->query("SELECT pseudo, pass FROM user");

    while ($row = $stmt->fetch()){
      echo "Nom de famille ".$row['pseudo']." ";
    }
  }

  public function UpdateUser(){

  }

  public function DeleteUser(){

  }

  public function log_in($pseudo, $pass){
    try{
      
      $sql = "SELECT * FROM user WHERE pseudo=:pseudo";
      $stmt = $this->connect()->prepare($sql); 
      $stmt->bindParam(":pseudo", $pseudo);
  
      $stmt->execute();

      $returned_row = $stmt->fetch();

      if($returned_row > 0){
        if (password_verify($pass, $returned_row['pass'])) {
          $_SESSION['user_session'] = $returned_row['pseudo'];
          header('Location: login.php');
          return true;
          exit();
        } else {
          echo 'Wrong password or pseudo';
          return false;
        }
      }else{
        echo 'Wrong password or pseudo';
        return false;
      }

    }catch(PDOException $e){
      echo 'il y a une erreur : ' .$e->getMessage();
    }
  }

  public function log_out() {
    session_destroy();
    unset($_SESSION['user_session']);
    header('Location: index.php');
    return true;
  }


}



?>
