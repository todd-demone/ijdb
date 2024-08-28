<?php

function insert($pdo, $table, $values) {
    $query = 'INSERT INTO ' . $table . ' (';
    foreach ($values as $key => $value) {
        $query .= '`' . $key . '`,';
    }
    $query = rtrim($query, ",");

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


function update($pdo, $table, $primaryKey, $values) {

    $query = 'UPDATE `' . $table . '` SET ';


    foreach ($values as $key => $value) {
        $query .= '`' . $key . '` = :' . $key . ','; 
    }

    $query = rtrim($query, ',');

    $query .= ' WHERE `' . $primaryKey . '` = :primaryKey';
    $values['primaryKey'] = $values[$primaryKey];

    $values = processDates($values);
    $stmt = $pdo->prepare($query);
    $stmt->execute($values);
}


function save($pdo, $table, $primaryKey, $record) {
    try {
        if (empty($record[$primaryKey])) {
            unset($record[$primaryKey]);
        }
        insert($pdo, $table, $record);
    } catch (PDOException $e) {
        update($pdo, $table, $primaryKey, $record);
    }
}


function delete($pdo, $table, $field, $value) {
    $values = [':value' => $value];

    $stmt = $pdo->prepare('DELETE FROM `' . $table . '` WHERE ' . $field . ' = :value');
    $stmt->execute($values);
}


function findAll($pdo, $table) {
    $stmt = $pdo->prepare('SELECT * FROM `' . $table . '`');
    $stmt->execute();
    return $stmt->fetchAll();
}


function find($pdo, $table, $field, $value) {
    $query = 'SELECT * FROM ' . $table . ' WHERE ' . $field . '= :value';

    $values = [
        'value' => $value
    ];

    $stmt = $pdo->prepare($query);
    $stmt->execute($values);

    return $stmt->fetchAll();
}


function total($pdo, $table) {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM `' . $table . '`');
    $stmt->execute();
    $row = $stmt->fetch();
    return $row[0]; // is the [0] necessary for fetch()? ie needed for fetchAll()?
}


function processDates($values) {
  foreach ($values as $key => $value) {
    if ($value instanceof DateTime) {
      $values[$key] = $value->format('Y-m-d H:i:s');
    }
  }

  return $values;
}
