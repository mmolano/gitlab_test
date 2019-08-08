<?php 
require 'templates/header.php'; 
require 'includes/profile_infos.inc.php';
?>


<form action="" method="POST">

<label for="">new email</label>
<input type="text" name="email" value="<?= $_SESSION['user_email']; ?>">

<label for="">new password</label>
<input type="password" name="pass">

<input type="submit" name="update" value="submit">


</form>





<?php require 'templates/footer.php' ?>