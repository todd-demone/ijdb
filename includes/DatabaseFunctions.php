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

function insertJoke($pdo, $joketext, $authorId) {
  $stmt = $pdo->prepare('INSERT INTO `joke` (`joketext`, `jokedate`, `authorId`)
    VALUES (:joketext, :jokedate, :authorId)');
  
  $values = [
    ':joketext' => $joketext,
    ':jokedate' => date('Y-m-d'),
    ':authorId' => $authorId
  ];

  $stmt->execute($values);
}

function updateJoke($pdo, $jokeId, $joketext, $authorId) {
  
  $stmt = $pdo->prepare('UPDATE `joke` SET
                          `joketext` = :joketext,
                          `authorId` = :authorId
                        WHERE `id` = :id');

  $values = [
    ':joketext' => $joketext,
    ':authorId' => $authorId,
    ':id' => $jokeId
  ];

  $stmt->execute($values);
}