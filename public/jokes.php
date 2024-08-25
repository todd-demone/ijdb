<?php

try {
  $pdo = new PDO('mysql:host=mysql;dbname=ijdb;charset=utf8mb4', 'ijdbuser', 'mypassword');

  $sql = 'SELECT `joke`.`id`, `joketext`, `name`, `email`
    FROM `joke` INNER JOIN `author`
    ON `authorid` = `author`.`id`';
  
  $jokes = $pdo->query($sql);

  $title = 'Joke list';

  ob_start();

  include __DIR__ . '/../templates/jokes.html.php';

  $output = ob_get_clean();

} catch(PDOException $e) {
  $title = "An error occurred.";

  $output = 'Unable to connect to the database server.' . $e->getMessage() . 
    $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';
