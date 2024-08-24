<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Jokes</title>
    <link rel="stylesheet" href="jokes.css">
</head>
<body>
<?php if (isset ($error)): ?>
<p>
    <?= $error; ?>
</p>
<?php else: ?>
<?php foreach ($jokes as $joke): ?>
<blockquote>
    <p>
    <?= htmlspecialchars($joke, ENT_QUOTES, 'UTF-8'); ?>
    </p>
</blockquote>
<?php endforeach; ?>
<?php endif; ?>
</body>
</html>