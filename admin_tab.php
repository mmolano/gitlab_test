<?php include 'templates/header.php';
 
 if ($_SESSION['user_admin'] == 0){
   header('Location: index.php');
 }

 if(isset($_POST['delete']) && !empty($_POST)){
   $delete = new User;
   $delete->DeleteUser();
  }
  
  $getAllUsers = new User;
  $user_list = $getAllUsers->getUsers();
  
?>


<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Email</th>
      <th>Pseudo</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
  while($row = $user_list->fetch()) :?> 
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['pseudo'] ?></td>
        <td> 
          <form method="POST" action="">
            <input type="hidden" name="usr_id" value="<?= $row['id'] ?>">
            <button type="submit" name="delete" value="remove"></button>
          </form> 
        </td>
      </tr>
  <?php endwhile ?>
  </tbody>
</table>



<?php include 'templates/footer.php' ?>