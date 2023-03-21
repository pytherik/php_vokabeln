<?php
include('./header.php');
include('./configDB.php');

$de_msg = '';
$deEx_msg = '';
$en_msg = '';
$enEx_msg = '';


if (isset($_POST['de']) && isset($_POST['en'])) {
  $en = trim($_POST['en']);
  $de = $_POST['de'];

  $res = $conn->query("SELECT * FROM english WHERE word='$en'");
  if($row = $res->fetch_assoc()){
    $en_msg = 'Diese Vokabel ist schon im Heft';
  } else {
    if(isset($_POST['exEn'])) {
      $exp = trim($_POST['exEn']);
    } else {
      $exp = '';
    }
    $conn->query("INSERT english (word, explanation) VALUES('$en', '$exp')");
    $en_id = $conn->insert_id;
    $de = explode(',', $de);
    if(isset($_POST['exDe'])) {
      $exp = trim($_POST['exDe']);
    } else {
      $exp = '';
    }
    for($i=0; $i < count($de); $i++) {
      $deutsch = trim($de[$i]);
      $res = $conn->query("SELECT id FROM german WHERE word = '$deutsch'");
      if(!$row = $res->fetch_assoc()) {
        $conn->query("INSERT german (word, explanation) VALUES('$deutsch', '$exp')");
        $de_id = $conn->insert_id;
      } else {
        $de_id = $row['id'];
      }
      $conn->query("INSERT eng_ger VALUES('$en_id', '$de_id')");
    }
    $conn->close();
  }
} else if (isset($_POST['back'])) {
  header('Location:./index.php');
} else if (!isset($_POST['de']) && isset($_POST['en'])) {
  $de_msg = 'Bitte gib min eine deutsche Übersetzung ein';
} else if (!isset($_POST['en']) && isset($_POST['de'])) {
  $en_msg = 'Bitte gib einen englischen Begriff ein';
}


?>

    <div class="form-container">
      <form method="POST">
        <div class="input-container">
          <label for="en">Begriff (en)</label>
          <input type="text" id="en" name="en" autocomplete="off" required autofocus />
          <span class="errMsg"><?php echo $en_msg ?></span>
        </div>
        <div class="input-container">
          <label for="exEn">Erklärung (en)</label>
          <textarea  id="exEn" name="exEn" rows="5" placeholder="Dieses Feld kann leer bleiben."></textarea>
          <span class="errMsg"><?php echo $enEx_msg ?></span>
        </div>
        <div class="input-container">
          <label for="de">Übersetzungen (de)</label>
          <input type="text" id="de" name="de" autocomplete="off" required />
          <span class="errMsg"><?php echo $de_msg ?></span>
        </div>
        <div class="input-container">
          <label for="exDe">Erklärung (de)</label>
          <textarea  id="exDe" name="exDe" rows="5" placeholder="Dieses Feld kann leer bleiben."></textarea>
          <span class="errMsg"><?php echo $deEx_msg ?></span>
        </div>
        <div class="input-container">
        <button class="small-button" type="submit">eintragen</button>
        </div>
      </form>
    </div>

<?php
  include('./footer.php');
?>