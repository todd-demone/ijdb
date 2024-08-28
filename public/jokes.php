<?php
try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';
    
    $result = findAll($pdo, 'joke');

    $jokes = [];
    foreach ($result as $joke) {
        $author = find($pdo, 'author', 'id', $joke['authorid'])[0];

    $jokes[] = [
        'id' => $joke['id'],
        'joketext' => $joke['joketext'],
        'jokedate' => $joke['jokedate'],
        'name' => $author['name'],
        'email' => $author['email']
    ];
    }

    $title = 'Joke list';

    $totalJokes = total($pdo, 'joke');

    ob_start();

    include __DIR__ . '/../templates/jokes.html.php';

    $output = ob_get_clean();
} catch(PDOException $e) {
    $title = "An error occurred.";

    $output = 'Unable to connect to the database server.' . $e->getMessage() . 
        $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';
