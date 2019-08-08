<?php 

$hideLog_in = true;

include 'templates/header.php';
  
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
<?php endif ?>
  <div class="item_form">
    <h1>Reset password</h1>
    <?php 
      if(isset($_GET['reset'])){
        switch($_GET['reset']){
          case "success":
            echo '<div class="form_success">An email has been sent to this address! Please check your spams</div>';
            break;
          case "failed":
            echo '<div class="form_alerts">Field cannot be empty</div>';
            break;
          case "email_failed":
            echo '<div class="form_alerts">Wrong email format</div>';
            break;
          case "email_not_exist":
            echo '<div class="form_alerts">This email address does not exist</div>';
            break;
        }
      }
      ?>
      <form method="post" action="includes/reset_request.inc">
        <input type="text" name="email" placeholder="Email">
        <input type="submit" name="reset_request_submit" value="submit">
      </form>
      
  </div>
</div>


<?php include 'templates/footer.php' ?>
