<?php

$request_uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($request_uri === '/') {
    include('index.php');
} elseif ($request_uri === '/create' && $method === 'GET') {
    include('create.php');
} elseif (preg_match('/^\/edit\/(\d+)$/', $request_uri, $matches) && $method === 'GET') {
    include('edit.php');
} elseif (preg_match('/^\/delete\/(\d+)$/', $request_uri, $matches) && $method === 'POST') {
    include('delete.php');
} else {
    // Handle 404 error
    http_response_code(404);
    echo '404 Not Found';
}

?>