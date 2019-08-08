<?php 

if(!isset($_SESSION['user_session'])){
  if(isset($_POST['login']) && !empty($_POST['pseudo']) && !empty($_POST['pass'])){
    $pseudo = $_POST['pseudo'];
    $pass = $_POST['pass'];
    
    $new_log = new User();
    $new_log->log_in($pseudo, $pass);

    header("Location: index");   
    
  }elseif(isset($_POST['login']) && (empty($_POST['pseudo']) || empty($_POST['pass']))  ){
    $error = 'Please fill all fields';
  }
}else{
  header('Location: index');
}


?>