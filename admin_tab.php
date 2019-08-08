<?php require 'templates/header.php';
 
 if ($_SESSION['user_admin'] == 0){
   header('Location: index');
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
  while($row = $user_list->fetch()) : extract($row) ?> 
      <tr>
        <td><?= $id; ?></td>
        <td><?= $email; ?></td>
        <td><?= $pseudo; ?></td>
        <td> 
          <form method="post">
            <input type="hidden" name="usr_id" value="<?= $row['id']; ?>">
            <button type="submit" name="delete" value="remove"></button>
          </form> 
        </td>
      </tr>
  <?php endwhile; ?>
  </tbody>
</table>



<?php require 'templates/footer.php' ?>