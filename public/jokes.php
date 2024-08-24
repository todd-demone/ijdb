<?php

try {
  $pdo = new PDO('mysql:host=mysql;dbname=ijdb;charset=utf8mb4', 'ijdbuser', 'mypassword');

  $sql = 'SELECT `joketext` FROM `joke`';
  $result = $pdo->query($sql);

  while ($row = $result->fetch()) {
    $jokes[] = $row['joketext'];
  }

  $title = 'Joke list';

  ob_start();

  include __DIR__ . '/../templates/jokes.html.php';

  $output = ob_get_clean();

} catch(PDOException $e) {
    $output = 'Unable to connect to the database server.' . $e->getMessage() . 
    $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';
