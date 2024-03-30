<?php
$id = $_GET['id'];

try {
    require_once __DIR__ . '/../config.php';
    require_once ROOT_PATH . '/connection.php';

    $connection = new Connection();

    $query = "SELECT * FROM users WHERE id = $id";
    $userData = $connection->query($query);

    $user = $userData->fetch(); // Fetch the user data directly

    // Check if user data exists
    if (!$user) {
        echo "<p>User not found.</p>";
        exit(); // Exit script if user not found
    }

    $connection->disconnect();
} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Confirm Delete</h1>
        <p>Are you sure you want to delete the following user?</p>
        <p><strong>Name:</strong> <?php echo $user->name; ?></p>
        <p><strong>Email:</strong> <?php echo $user->email; ?></p>
        <form action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="<?php echo BASE_URL; ?>/index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
