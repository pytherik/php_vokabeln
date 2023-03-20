<?php
include('./configDB.php');
include('./header.php');

?>

<div class="form-container">
  <form method="POST">
    <div class="input-container">
      <label for="such">Suchbegriff:</label>
      <input type="text" id="such" name="such" autocomplete="off" autofocus />
    </div>
  </form>
</div>

<?php

if (isset($_POST['such'])) {
  $such = $_POST['such'];
  $res = $conn->query(
    "SELECT e.word AS en, 
    g.word AS de, 
    e.explanation AS exen, 
    g.explanation AS exde 
    FROM german g 
    JOIN eng_ger eg ON g.id=eg.ger_id 
    JOIN english e ON e.id = eg.eng_id 
    WHERE e.word='$such' OR g.word='$such'");
  if ($res) {
    echo "
    <table>
    <tr><th>english</th><th>deutsch</th><th>Explanation</th><th>Erklärung</th></tr>";
    while($row=$res->fetch_assoc()) {
      $en = $row['en'];
      $de = $row['de'];
      $exen = $row['exen'];
      $exde = $row['exde'];
      echo "<tr><td>$en</td><td>$de</td><td>$exen</td><td>$exde</td><tr>";
    }
    echo "</table>";
  }
}

?>