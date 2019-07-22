<?php include 'templates/header.php';
  
  if(isset($_POST['submit']) & !empty($_POST)){
    $pseudo = $_POST['pseudo'];
    $pass = $_POST['pass'];
    $password_hash = password_hash($pass, PASSWORD_ARGON2I, [ 
    'memory_cost' => 2 ** 12,
    'time_cost' => 10,
    'threads' => 20
    ]);
    
    $fields = [
      'pseudo' => $pseudo,
      'pass' => $password_hash
    ];

    $new_user = new User();
    $new_user->create($fields);
  }

  

?>

<form method="post" action="">

  <label for="">Pseudo</label>
  <input type="text" name="pseudo">

  <label for="">Password</label>
  <input type="password" name="pass">

  <input type="submit" name="submit" value="submit">

</form>



<?php include 'templates/footer.php' ?>
