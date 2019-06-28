<!Doctype html>
<?php mb_internal_encoding('utf-8')?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title><?= isset($title) ? formantString($title) : 'Mon Calendrier' ?></title>
</head>
<body>
<nav class="navbaar navbar-dark bg-primary mb-3">
    <a href="index.php" class="navbar-brand">Mon calendier</a>
</nav>

