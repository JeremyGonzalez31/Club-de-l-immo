<?php

/**
 * This file dispatch routes.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routeParts = explode('/', ltrim($_SERVER['REQUEST_URI'], '/') ?: HOME_PAGE);
$controller = 'App\Controller\\' . ucfirst($routeParts[0] ?? '') . 'Controller';

$method = $routeParts[1] ?? '';

// Suppression de la query string dans le nom de la méthode
// eg monAction?q=var devient monAction.
$method = preg_replace('/\?.*/', '', $method);

$vars = array_slice($routeParts, 2);

if (class_exists($controller) && method_exists(new $controller(), $method)) {
    echo (new $controller())->$method(...$vars);
} else {
    header("HTTP/1.0 404 Not Found");
    echo '404 - Page not found';
    exit();
}
