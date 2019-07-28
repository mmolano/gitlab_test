<?php include 'templates/header.php';
  
  if(isset($_POST['submit']) & !empty($_POST)){
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $password_hash = password_hash($pass, PASSWORD_ARGON2I, [ 
      'memory_cost' => 2 ** 12,
      'time_cost' => 10,
      'threads' => 20
    ]);

    $fields = [
      'pseudo' => $pseudo,
      'email' => $email,
      'pass' => $password_hash
    ];

    $db = new Database;
    $reqEmail = $db->connect()->prepare("SELECT email FROM user WHERE email = ?");
    $reqEmail->execute([$email]);
    
    if($reqEmail->rowCount() == 0){
      if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $new_user = new User;
        $new_user->create($fields);
      }else{
        echo 'incorrect';
      }
    }else{
      echo 'user already exist';
    }
  }
  

  

?>

<form method="post" action="">

  <label for="">Pseudo</label>
  <input type="text" name="pseudo">

  <label for="">Email</label>
  <input type="text" name="email">

  <label for="">Password</label>
  <input type="password" name="pass">

  <input type="submit" name="submit" value="submit">

</form>



<?php include 'templates/footer.php' ?>
