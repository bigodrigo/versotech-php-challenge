<?php
$request_uri = strtok($_SERVER['REQUEST_URI'], '?'); // Remove query string
$request_method = $_SERVER['REQUEST_METHOD'];

// Route handling without query parameters
if ($request_uri === '/') {
    include('index.php');
} elseif ($request_uri === '/create' && $request_method === 'GET') {
    include('create.php');
} elseif (preg_match('/^\/edit\/(\d+)$/', $request_uri, $matches) && $request_method === 'GET') {
    $id = $matches[1];
    $_GET['id'] = $id; // Set the ID parameter in $_GET array
    include('edit.php');
} elseif (preg_match('/^\/delete\/(\d+)$/', $request_uri, $matches) && $request_method === 'POST') {
    include('delete.php');
} else {
    // Handle 404 error
    http_response_code(404);
    echo '404 Not Found';
}
?>