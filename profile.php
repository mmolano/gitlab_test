<?php include 'templates/header.php'; 

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


<form action="" method="POST">

<label for="">new email</label>
<input type="text" name="email" value="<?= $_SESSION['user_email'] ?>">

<label for="">new password</label>
<input type="password" name="pass">

<input type="submit" name="update" value="submit">


</form>





<?php include 'templates/footer.php' ?>