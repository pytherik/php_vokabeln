<?php

$host = 'localhost';
$user = 'root';
$pass = '321null';

$conn = new mysqli($host, $user, $pass);
$conn->query("CREATE DATABASE IF NOT EXISTS vocab");
$conn->query("USE vocab");

$conn->query(
  "CREATE TABLE IF NOT EXISTS english(
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(150) NOT NULL,
    explanation TEXT(500))");

$conn->query(
  "CREATE TABLE IF NOT EXISTS german(
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(150) NOT NULL,
    explanation TEXT(500))");

$conn->query(
  "CREATE TABLE IF NOT EXISTS eng_ger(
    eng_id INT NOT NULL, 
    ger_id INT NOT NULL, 
    PRIMARY KEY(eng_id, ger_id))"); 

?>