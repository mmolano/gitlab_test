<?php 

$errors = [];

if(isset($_POST['submit']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['pass']) ){
  $pseudo = $_POST['pseudo'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  if(strlen($pass) < 10){
    $errors['pass'] = 'Password must contain 10 characters or more';
  }else{
    $password_hash = password_hash($pass, PASSWORD_ARGON2I, [ 
      'memory_cost' => 2 ** 12,
      'time_cost' => 10,
      'threads' => 20
    ]);
  }

  $fields = [
    'pseudo' => $pseudo,
    'email' => $email,
    'pass' => $password_hash
  ];

  $db = new Database;
  $reqEmail = $db->connect()->prepare("SELECT email FROM user WHERE email = ?");
  $reqEmail->execute([$email]);
  $reqPseudo = $db->connect()->prepare("SELECT pseudo FROM user WHERE pseudo = ?");
  $reqPseudo->execute([$pseudo]);

  if($reqPseudo->rowCount() !== 0){
    $errors['user'] = 'User already exist';
  }

  if($reqEmail->rowCount() == 0){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      $new_user = new User;
      $new_user->create($fields);
    }else{
      $errors['email'] = 'Wrong email format';
    }
  }else{
    $errors['email'] = 'Email is already taken';
  }

}elseif(isset($_POST['submit']) && (empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['pass']))  ){
  $errors['empty'] = 'Please fill all fields';
}


?>