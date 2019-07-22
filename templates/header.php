<?php 
  function __autoload($class)
  {
    require_once "config/$class.php";
  }

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
  <link rel="icon"  href="images/space.png">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <title>My Remember Space</title>
</head>
<body>
  