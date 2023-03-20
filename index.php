<?php
include('./header.php');
?>

<div class="form-container">
  <form method="POST">
    <div class="input-container">
      <input type="submit" name="create" value="anlegen">
    </div>
    <div class="input-container">
      <input type="submit" name="bearbeiten" value="bearbeiten">
    </div>
    <div class="input-container">
      <input type="submit" name="üben" value="üben">
    </div>
  </form>
</div>

<?php
if (isset($_POST['create'])){
  header('Location:./create.php');
}
include('./footer.php');
?>