<?php include 'templates/header.php';

if(isset($_POST))

?>

<form action="" method="post">

<label for="">drop your image</label>
<input type="file" name="movie_image">

<label for="">movie name</label>
<input type="text" name="movie_name">

<p>Would you recommend ? </p>

<div>
  <input type="radio" for="yes_rec" name="is_recommended">
  <label for="yes_rec">Yes</label>
</div>

<div>
  <input type="radio" for="no_rec" name="is_recommended" checked>
  <label for="no_rec">No</label>
</div>

<p>is it your fav?</p>

<div>
  <input type="radio" for="yes_fav" name="is_favorite">
  <label for="yes_fav">Yes</label>
</div>

<div>
  <input type="radio" for="no_fav" name="is_favorite" checked>
  <label for="no_fav">No</label>
</div>



</form>


<?php include 'templates/footer.php' ?>