<?php 

error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

require_once "../config/Database.php";

if (isset($_POST['reset_password_submit']) && !empty($_POST['pass']) && !empty($_POST['pass_repeat'])){

$selector = $_POST['selector'];
$validator = $_POST['validator'];
$pass = $_POST['pass'];
$passRepeat = $_POST['pass_repeat'];

if (empty($pass) || empty($passRepeat)){
  header("Location: ../new_user");  
  exit();
}else if($pass != $passRepeat){
  header("Location: ../new-password?newpwd=pwdnotsame");
  exit();
}

$currentDate = date("U");

$db = new Database;
$sql = "SELECT * FROM password_reset WHERE selector = :selector AND expires >= :expires";
$stmt = $db->connect()->prepare($sql);


if(!$stmt){
  echo "there was an error !";
  exit();
}else {
  $stmt->bindParam(':selector', $selector);
  $stmt->bindParam(':expires', $currentDate);
  $stmt->execute();
  $returned_row = $stmt->fetch(PDO::FETCH_ASSOC);

  if($returned_row == 0){
    echo "you need to re-submit your reset request.";
    exit();
  }else{
    $tokenBin = hex2bin($validator);
    $tokenCheck = password_verify($tokenBin, $returned_row['token']);

    if ($tokenCheck === false){
      echo "You need to re-submit your reset request.";
      exit();
    }elseif($tokenCheck === true){
      $tokenEmail = $returned_row['email'];
      $db = new Database;
      $sql = "SELECT * FROM user WHERE email = :email";
      $stmt = $db->connect()->prepare($sql);

    if(!$stmt){
      echo "there was an error !";
      exit();
    }else {
      $stmt->bindParam(':email', $tokenEmail);
      $stmt->execute();
      $returned_row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($returned_row == 0){
        echo "there was an error";
        exit();
      }else{
        $db = new Database;
        $sql = "UPDATE user SET pass = :pass WHERE email = :email";
        $stmt = $db->connect()->prepare($sql);
        if(!$stmt){
          echo "there was an error !";
          exit();
        }else {
          $newPassHash = password_hash($pass, PASSWORD_ARGON2I, [ 
            'memory_cost' => 2 ** 12,
            'time_cost' => 10,
            'threads' => 20
          ]);
          $stmt->bindParam(':pass',$newPassHash);
          $stmt->bindParam(':email',$tokenEmail);
          $stmt->execute();

          $db = new Database;
          $sql = "DELETE FROM password_reset WHERE email = :email";
          $stmt = $db->connect()->prepare($sql);
        
          if(!$stmt){
            echo "there was an error !";
            exit();
          }else {
            $stmt->bindParam(':email',$userEmail);
            $stmt->execute();
            header("Location: ../login?reset=success");
          }
        }
      } 
    }
  }
 }
}

} else {
  header("Location: ../index");
}


?>