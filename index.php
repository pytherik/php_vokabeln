<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./public/css/style.css">
  <title>Vokabelheft</title>
</head>
<body>
  <div class="container">

<?php

include('./configDB.php');

$de_msg = '';
$en_msg = '';

if (isset($_POST['de']) && isset($_POST['en'])) {
  $de = $_POST['de'];
  $conn->query("INSERT german (word) VALUES('$de')");
  $de_id = $conn->insert_id;
  $en = $_POST['en'];
  $en = explode(',', $en);
  if(isset($_POST['exDe'])){
    $exp = $_POST['exDe'];
  } else {
    $exp = ''
  }
  for($i=0; $i < count($en); $i++) {
    $conn->query("INSERT english (word) VALUES('$en[$i]')");
    $en_id = $conn->insert_id;
    $conn->query("INSERT eng_ger VALUES('$en_id', '$de_id')");
  }
  $conn->close();
} else {
  $de_msg = 'hier stimmt was nicht!';
}

?>

    <div class="form-container">
      <form method="POST">
        <div class="input-container">
          <label for="de">Begriff (en)</label>
          <input type="text" id="de" name="de" autofill="off" required autofocus>
          <span class="errMsg"><?php echo $de_msg ?></span>
        </div>
        <div class="input-container">
          <label for="en">Übersetzungen (de)</label>
          <input type="text" id="en" name="en" autofill="off" required>
          <span class="errMsg"><?php echo $en_msg ?></span>
        </div>
        <div class="input-container">
          <label for="ex">Erklärung</label>
          <textarea  id="ex" name="ex" rows="5">Dieses Feld kann leer bleiben.</textarea>
          <span class="errMsg"><?php echo $en_msg ?></span>
        </div>
        <div class="input-container">
        <button class="small-button" type="submit">eintragen</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>

