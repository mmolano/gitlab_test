<?php 

$hideLog_in = true;

include 'templates/header.php';
include 'includes/new_user.inc.php';

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
    <h1>Create</h1>
    <div class="form_alerts"><?= $error; ?></div>
      <form method="post">
        <input type="text" name="pseudo" placeholder="Pseudo">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="pass" placeholder="Password">
        <a href="login">Already have an account? - Login</a>
        <input type="submit" name="submit" value="submit">
      </form>
  </div>
</div>


<?php include 'templates/footer.php' ?>
