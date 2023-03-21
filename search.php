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
$exen = false;
$exde = false;

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
  if (!mysqli_num_rows($res) == 0) {
    // var_dump($res);
    echo "
    <table>
    <tr><th>english</th>
    <th>deutsch</th>
    </tr>";
    while($row=$res->fetch_assoc()) {
      $en = $row['en'];
      $de = $row['de'];
      $exen = $row['exen'];
      $exde = $row['exde'];
      echo "
      <tr>
      <td>$en</td>
      <td>$de</td>
      <tr>";
    }
    echo "</table>";
    if($exen || $exde) {
      echo "<h4>Erklärung</h4><p>$exde</p><h4>Explanation</h4><p>$exen</p>";
    }
  } else {
    echo "<h4>'$such' ist noch nicht im Heft!</h4>
    <button class='small-button'>anlegen</button>";
  }
}

?>