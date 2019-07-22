<?php include 'templates/header.php';

if(!isset($_SESSION['user_session'])){
  if(isset($_POST['login']) & !empty($_POST['pseudo']) & !empty($_POST['pass'])){
    $pseudo = $_POST['pseudo'];
    $pass = $_POST['pass'];
    
    $new_log = new User();
    $new_log->log_in($pseudo, $pass);
  }
}else{
  echo 'user is already logged as : '.$_SESSION['user_session'];
}

?>

<form method="post" action="">

<label for="">Pseudo</label>
<input type="text" name="pseudo">

<label for="">Password</label>
<input type="password" name="pass">

<input type="submit" name="login" value="submit">

</form>

<a href="?logout">Logout</a>


<?php include 'templates/footer.php' ?>
