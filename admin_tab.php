<?php include 'templates/header.php';
 
 if ($_SESSION['user_admin'] == 0){
   header('Location: index.php');
 }

 $get_users = new User;

?>


<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Pseudo</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
      <?= $get_users->getUsers(); ?>
  </tbody>
</table>



<?php include 'templates/footer.php' ?>