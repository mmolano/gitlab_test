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
        header('Location: login');
        return true;
        exit();
      }else{
        $this->showError($stmt);
        return false;
        exit();
      }
    }catch(PDOException $e){
      echo 'il y a une erreur : ' .$e->getMessage();
    }
  }

  public function UpdateUser($email, $password_hash){
    try{
      $sql = "UPDATE user SET email=:email, pass=:pass, updated_at = CURRENT_TIMESTAMP  WHERE id = '".$_SESSION['user_id']."'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':pass', $password_hash);
      $stmt->execute();
    }catch(PDOException $e){
      echo 'error : '.$e->getMessage();
    }
  }

  public function getUsers(){
    try{
      $sql = "SELECT id, pseudo, email FROM user WHERE id <> '".$_SESSION['user_id']."' ORDER BY id";
      $stmt = $this->connect()->query($sql);
      return $stmt;
    }catch(PDOException $e){
      echo 'error : '.$e->getMessage();
    }
  } 
  
  public function DeleteUser(){
    try{
      $sql = "DELETE FROM user WHERE id=:id";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(['id' => $_POST['usr_id']]);
    }catch(PDOException $e){
      echo 'error : ' .$e->getMessage();
    }
  }

  public function log_in($pseudo, $pass){
    try{
      $sql = "SELECT * FROM user WHERE '$pseudo' IN (pseudo, email)";
      $stmt = $this->connect()->prepare($sql); 
  
      $stmt->execute();

      $returned_row = $stmt->fetch(PDO::FETCH_ASSOC);

      if($returned_row > 0){
        if (password_verify($pass, $returned_row['pass'])) {
            $_SESSION['user_session'] = $returned_row['pseudo'];
            $_SESSION['user_id'] = $returned_row['id'];
            $_SESSION['user_email'] = $returned_row['email'];
            $_SESSION['user_admin'] = $returned_row['is_admin'];
            $_SESSION['user_friends'] = $returned_row['is_friend'];
            $_SESSION['user_number_friends'] = $returned_row['number_of_friends'];
            $_SESSION['user_created_at'] = $returned_row['created_at'];
          header('Location: login');
          exit();
        } else {
          $error = 'Wrong password or pseudo';
          return $error;
          exit();
        }
      }else{
        $error = 'Wrong password or pseudo';
        return $error;
        exit();
      }

    }catch(PDOException $e){
      echo 'il y a une erreur : ' .$e->getMessage();
    }
  }

  public function log_out() {
    session_destroy();
    unset($_SESSION['user_session']);
    header('Location: index');
  }


}



?>
