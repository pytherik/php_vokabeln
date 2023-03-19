<?php

$host = 'localhost';
$user = 'root';
$pass = '321null';

$conn = new mysqli($host, $user, $pass);
$conn->query("DROP DATABASE IF EXISTS vokabeln");
$conn->query("CREATE DATABASE vokabeln");
$conn->query("USE vokabeln");

$conn->query(
  "CREATE TABLE english(
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(150) NOT NULL,
    explanation TEXT(500))");

$conn->query(
  "CREATE TABLE german(
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(150) NOT NULL,
    explanation TEXT(500))");

$conn->query(
  "CREATE TABLE eng_ger(
    eng_id INT NOT NULL, 
    ger_id INT NOT NULL, 
    PRIMARY KEY(eng_id, ger_id))"); 


$file_to_read = fopen('./voxnscore.csv', 'r');
if($file_to_read !== FALSE){
    
    while(($data = fgetcsv($file_to_read, 100, ',')) !== FALSE){
      $res = $conn->query("SELECT id FROM english WHERE word='$data[0]'");
      if($row = $res->fetch_assoc()){
        $eng_id = $row['id'];
      } else {
        $conn->query("INSERT INTO english (word) VALUES('$data[0]')");
        $res = $conn->query("SELECT id FROM english WHERE word='$data[0]'");
        $row = $res->fetch_assoc();
        $eng_id = $row['id'];
      }
      var_dump($row);
      echo "<h3>english: $data[0]<h3>";
      for($i = 1; $i < count($data) -4; $i++) {
        $res = $conn->query("SELECT id FROM german WHERE word='$data[$i]'");
        if($row = $res->fetch_assoc()){
          $ger_id = $row['id'];
        } else {
          $conn->query("INSERT INTO german (word) VALUES('$data[$i]')");
          $res = $conn->query("SELECT id FROM german WHERE word='$data[$i]'");
          $row = $res->fetch_assoc();
          $ger_id = $row['id'];
        }
          $conn->query("INSERT INTO eng_ger VALUES('$eng_id', '$ger_id')");
          echo "<h5>german$i: $data[$i]<h5>";
        }
    }
    fclose($file_to_read);
}
// $csv = fopen('./voxnscore.csv', 'r');

// while(! feof($csv)) {
//   $line = fgets($csv);
//   echo $line. "<br>";
// }

// fclose($csv);

?>