<?php 
  spl_autoload_register(function($class)
  {
    require_once "config/$class.php";
  });

  session_start();

  if(isset($_GET['logout'])){
    $destroy_sessions = new User();
    $destroy_sessions->log_out();
  }

?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="My Movie List">
  <meta name="Publisher" content="Miguel Molano">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon"  href="../source/images/ico/space.png">
  <link rel="stylesheet" type="text/css"
  <?php if ($folder_in == true)  : ?>
  href="../source/css/style.css"
  <?php else: ?>
  href="source/css/style.css"
  <?php endif ?>
  />
  <title>Space One</title>
</head>
<body <?php if ($hideLog_in == true)  : ?> class="logs" <?php endif ?>>
 

<?php if ($hideLog_in != true)  : ?>
<header>
  <img src="" alt="">
  <div>
      <a href="index">home</a>
      <a href="#">movies</a>
      <a href="#">animes</a>
    <?php if (!isset($_SESSION['user_session'])) : ?>
      <a href="login">login</a>
      <a href="new_user">Create account</a>
    <?php else: ?>
      <a href="?logout">logout</a>
    <?php endif; ?>
  </div>
</header>
<?php endif; ?>