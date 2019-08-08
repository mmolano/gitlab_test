<?php 

$hideLog_in = true;
$folder_in = true;

include '../templates/header.php';
  
?>

<div class="login_video">
  <video autoplay="true" loop muted>
    <source src="../source/videos/1.mp4" type="video/mp4">
  </video>
</div>

<div class="login_form">
<?php if(!$_SERVER['HTTP_REFERER']) : ?>
<a class="return_arrow" href="index"></a>
<?php else : ?>
<a class="return_arrow" href="<?= $_SERVER['HTTP_REFERER']; ?>"></a>
<?php endif ?>

  <div class="item_form">
    <h1>Reset password</h1>
  <?php 
  $selector = $_GET['selector'];
  $validator = $_GET['validator'];

  if(empty($selector) || empty($validator)){
    echo '<div class="form_alerts">Could not validate your request!</div>';
  }else {
    if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
      ?>
      <form method="post" action="../includes/reset_pass.inc">
        <input type="hidden" name="selector" value="<?= $selector; ?>">
        <input type="hidden" name="validator" value="<?= $validator; ?>">
        <input type="password" name="pass" placeholder="enter a new password">
        <input type="password" name="pass_repeat" placeholder="repeat the new password">
        <input type="submit" name="reset_password_submit" value="submit">
      </form>
      <?php 
    }
  }

?>
     
  </div>
</div>


<?php include '../templates/footer.php' ?>
