<?php
function __autoload($classname)
{
    $filename = __DIR__ . "/core/" . $classname . ".php";
    include_once($filename);
}

if (isset($_REQUEST['q']) && !empty($_REQUEST['q'])) {
    $controller_name = 'account';
    $action_name = 'index';
} else {
    $routes = preg_match_all('#/?([^/]*)/?#', $_SERVER['REQUEST_URI'], $matches);
    if ($matches[1][0]) {
        $controller_name = $matches[1][0];
        if (!empty($matches[1][1]))
            $controller_name = $matches[1][1];
    } else {
        $controller_name = 'main';
    }

    $routes = preg_match_all('#/([^/]+).php#', $_SERVER['REQUEST_URI'], $matches);

    if ($routes) {
        $action_name = $matches[1][0];
    } else {
        $action_name = 'index';
    }
}

new Route($controller_name, $action_name);
