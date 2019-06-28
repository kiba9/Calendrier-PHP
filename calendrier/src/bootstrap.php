<?php
require '../vendor/autoload.php';

/**
 *
 */
function e404()
{
    require '../public/404.php';
    exit();
}

/**
 * @param mixed ...$vars
 */
function debug(...$vars)
{
    foreach ($vars as $var) {
        echo '<pre>';
        print_r($var);
        echo "<pre>";
    }
}

/**
 * @return PDO
 */
function getConnexion()
{
    return new \PDO('mysql:host=localhost;dbname=tutocalendar', 'root', '', [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
    ]);
}

/**
 * @param string|null $value
 * @return string
 */
function formantString(?string $value)
{
    if ($value === null) {
        return "";
    }
    return htmlspecialchars($value);
}

/**
 * @param string $view
 * @param array $parameters
 */
function render(string $view, array $parameters = [])
{
    extract($parameters);
    include "../views/{$view}.php";
}
