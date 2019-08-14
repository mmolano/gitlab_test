<?php 

$errors = [];

if(isset($_POST['update']) && !empty($_POST['pass']) && !empty($_POST['pass_repeat'])){
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $repeated_pass = $_POST['pass_repeat'];

  if(strlen($pass) < 10){
    $errors['pass'] = 'Password must contain 10 characters or more';
  }

  if($pass != $repeated_pass){
    $errors['pass_check'] = 'Both passwords must be the same';
  }else{
    $password_hash = password_hash($pass, PASSWORD_ARGON2I, [ 
      'memory_cost' => 2 ** 12,
      'time_cost' => 10,
      'threads' => 20
      ]);
    $update_user = new User;
    $update_user->UpdateUser($email, $password_hash);  
    header('Location: profile?pass_change=success');
  }
}


?>
