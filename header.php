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
  <div class="navbar">
    <div>
      <form method="POST">
        <button type="submit" class="small-button nav-btn" name="back">zurück</button>
      </form>
    </div>
    <div class="header">
      <h1>Vokabelheft</h1>
    </div>
    <div class="right">
      <form method="POST">
        <button type="submit" class="small-button nav-btn" name="search">suchen</button>
      </form>
    </div>
  </div>
  <div class="container">
<?php

if (isset($_POST['back'])) {
  header("Refresh:0; url=./index.php");
}

if (isset($_POST['search'])) {
  header("Refresh:0;url=./search.php");
}

?>
