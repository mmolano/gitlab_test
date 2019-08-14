<?php 

$hideLog_in = true;

require 'templates/header.php';
require 'includes/login_user.inc.php';

?>

<div class="login_video">
  <video autoplay="true" loop muted>
    <source src="source/videos/1.mp4" type="video/mp4">
  </video>
</div>


<div class="login_form">
<?php if(!$_SERVER['HTTP_REFERER']) : ?>
<a class="return_arrow" href="index"></a>
<?php else : ?>
<a class="return_arrow" href="<?= $_SERVER['HTTP_REFERER']; ?>"></a>
<?php endif; ?>
  <div class="item_form">
    <h1>Login</h1>
    <?php if($error) : ?>
      <div class="form_alerts">
        <ul>
          <li>
            <?= $error; ?>
          </li>
        </ul>
      </div>
    <?php endif; ?>
    <?php 
      if(isset($_GET['reset'])){
        if($_GET['reset'] == 'success'){
          echo '<div class="form_success">Sucessfully changed your password!</div>';
        }
      }
      if(isset($_GET['create'])){
        if($_GET['create'] == 'success'){
          echo '<div class="form_success">Your account has been created!</div>';
        }
      }
      if(isset($_GET['exist'])){
        if($_GET['exist'] == 'failed'){
          echo '<div class="form_alerts">Wrong username or password!</div>';
        }
      }
    ?>
      <form method="post">
        <input type="text" name="pseudo" placeholder="Pseudo">
        <input type="password" name="pass" placeholder="Password">
        <a href="reset">Forgotten password?</a>
        <a href="new_user">Create account</a>
        <input type="submit" name="login" value="submit">
      </form>
  </div>
</div>




<?php require 'templates/footer.php' ?>
