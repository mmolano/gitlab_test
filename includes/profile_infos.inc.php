<?php 

if(isset($_POST['update']) && !empty($_POST)){
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $password_hash = password_hash($pass, PASSWORD_ARGON2I, [ 
    'memory_cost' => 2 ** 12,
    'time_cost' => 10,
    'threads' => 20
    ]);
  $update_user = new User;
  $update_user->UpdateUser($email, $password_hash);  
}


?>
