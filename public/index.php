<?php

try {
    $pdo = new PDO('mysql:host=mysql;dbname=ijdb;charset=utf8mb4', 'ijdbuser', 'mypassword');
    // $output = 'Database connection established.';
    
// CREATE TABLE EXAMPLE USING $pdo->exec()

    // $sql = 'CREATE TABLE `joke` (
    // id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    // joketext TEXT,
    // jokedate DATE NOT NULL
    // ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';

    // $pdo->exec($sql);

    // $output = 'Joke table successfully created.';

// UPDATE EXAMPLE USING $pdo->exec()
    // $sql = 'UPDATE `joke` SET jokedate="2021-04-01"
    //     WHERE joketext LIKE "%knock%"';
    
    // $affectedRows = $pdo->exec($sql);

    // $output = 'Updated ' . $affectedRows . ' rows.';

// SELECT EXAMPLE USING $pdo->query()
    $sql = 'SELECT `joketext` FROM `joke`';
    // returns a PDOStatement object, which represents a result set 
    // containing a list of rows returned from query
    $result = $pdo->query($sql);

    // fetch() method returns the next row as an associative array
    // fetch() returns false when no more rows
    // while ($row = $result->fetch()) {
    //     $jokes[] = $row['joketext'];
    // }

    // PDOStatement objects behave just like arrays when passed to 
    // foreach, so you can use this to extract the rows to an array
    foreach ($result as $row) {
        $jokes[] = $row['joketext'];
    }
    
} catch(PDOException $e) {
    $output = 'Unable to connect to the database server.' . $e->getMessage() . 
    $e->getFile() . ':' . $e->getLine();
}

// include __DIR__ . '/../templates/output.html.php';
include __DIR__ . '/../templates/jokes.html.php';
