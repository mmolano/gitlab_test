<?php include 'templates/header.php';

echo $_SESSION['user_id'];
echo $_SESSION['pass']; 
 
 ?>

<header>
  <img src="" alt="">
  <div>
    <?php if (!isset($_SESSION['user_session'])) : ?>
      <a href="">home</a>
      <a href="">movies</a>
      <a href="">animes</a>
      <a href="">login</a>
      <a href="">Create account</a>
    <?php else: ?>
      <a href="?logout">logout</a>
    <?php endif; ?>
  </div>
</header>

<?php include 'templates/footer.php' ?>
