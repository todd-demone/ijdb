<?php
try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../includes/DatabaseFunctions.php';

  if (isset($_POST['joketext'])) {
    save($pdo, 'joke', 'id', [
        'id' => $_POST['jokeid'], 
        'joketext' => $_POST['joketext'],
        'jokedate' => new DateTime(),
        'authorid' => 1
      ]
    );

    header('location: jokes.php');
  } else {

    if (isset($_GET['id'])) {
      $joke = find($pdo, 'joke', 'id', $_GET['id'])[0] ?? null;
    } else {
      $joke = null;
    }

    $title = 'Edit joke';

    ob_start();

    include __DIR__ . '/../templates/editjoke.html.php';

    $output = ob_get_clean();
  }
} catch (PDOException $e) {
  $title = "An error has occurred";

  $output = 'Database error: ' . $e->getMessage() . ' in ' . 
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';