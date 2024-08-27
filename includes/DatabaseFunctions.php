<?php
function totalJokes($pdo) {
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM `joke`');
  $stmt->execute();

  $row = $stmt->fetch();

  return $row[0];
}


function getJoke($pdo, $id) {
  $stmt = $pdo->prepare('SELECT * FROM `joke` WHERE `id` = :id');
  
  $values = [
    ':id' => $id
  ];

  $stmt->execute($values);

  return $stmt->fetch();
}


function insertJoke($pdo, $values) {
  $query = 'INSERT INTO `joke` (';

  $insertFields = [];

  foreach ($values as $key => $value) {
    $insertFields[] = '`' . $key . '`';
  }

  $query .= implode(', ', $insertFields);

  $query = rtrim($query, ',');

  $query .= ') VALUES (';

  foreach ($values as $key => $value) {
    $query .= ':' . $key . ',';
  }

  $query = rtrim($query, ',');

  $query .= ')';

  $values = processDates($values);

  $stmt = $pdo->prepare($query);
  
  $stmt->execute($values);
}


function updateJoke($pdo, $values) {

  $query = 'UPDATE `joke` SET ';

  $updateFields = [];

  foreach ($values as $key => $value) {
    $updateFields[] = '`' . $key . '` = :' . $key;
  }

  $query .= implode(', ', $updateFields);

  $query .= ' WHERE `id` = :primaryKey';
  
  // Set the :primaryKey variable
  $values['primaryKey'] = $values['id'];

  $values = processDates($values);
  
  $stmt = $pdo->prepare($query);

  $stmt->execute($values);
}


function deleteJoke($pdo, $id) {
  $stmt = $pdo->prepare('DELETE FROM `joke` WHERE `id` = :id');

  $values = [
    ':id' => $id
  ];

  $stmt->execute($values);
}


function allJokes($pdo) {
  $stmt = $pdo->prepare('SELECT `joke`.`id`, `joketext`, `jokedate`, `name`, `email`
  FROM `joke` INNER JOIN `author` 
  ON `authorid` = `author`.`id`');

  $stmt->execute();

  return $stmt->fetchAll();
}


function processDates($values) {
  foreach ($values as $key => $value) {
    if ($value instanceof DateTime) {
      $values[$key] = $value->format('Y-m-d H:i:s');
    }
  }

  return $values;
}


function allAuthors($pdo) {
  $stmt = $pdo->prepare('SELECT * FROM `author`');
  $stmt->execute();
  return $stmt->fetchAll();
}


function deleteAuthor($pdo, $id) {
  $values = [':id' => $id];

  $stmt = $pdo->prepare('DELETE FROM `author` WHERE `id` = :id');

  $stmt->execute($values);
}


function insertAuthor($pdo, $values) {
  $query = 'INSERT INTO `author` (';

  foreach ($values as $key => $value) {
    $query .= '`' . $key . '`,';
  }

  $query = rtrim($query, ',');

  $query .= ') VALUES (';

  foreach ($values as $key => $value) {
    $query .= ':' . $key . ',';
  }

  $query = rtrim($query, ',');

  $query .= ')';

  $values = processDates($values);

  $stmt = $pdo->prepare($query);
  $stmt->execute($values);
}