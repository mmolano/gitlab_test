<?php 
require 'templates/header.php'; 
require 'includes/profile_infos.inc.php';
?>

<?php if($errors): ?>
    <div class="form_alerts">
      <ul>
        <?php foreach ($errors as $error): ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
<?php endif; ?>

<?php 
if(isset($_GET['pass_change'])){
  if($_GET['pass_change'] == 'success'){
    echo '<div class="form_success">Sucessfully changed your password!</div>';
  }
}
?>

<form method="post">

<label for="">New password</label>
<input type="password" name="pass">
<label for="">Repeat password</label>
<input type="password" name="pass_repeat">


<input type="submit" name="update" value="submit">


</form>





<?php require 'templates/footer.php' ?>