<?php
include('./configDB.php');
include('./header.php');

?>

<div class="form-container">
  <form method="POST">
    <div class="input-container">
      <label for="such">Suchbegriff:</label>
      <input type="text" id="such" name="such" />
    </div>
  </form>
</div>

<?php

if (isset($_POST['such'])) {
  $res = $conn->query("SELECT ");
}

?>