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
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form action="update.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $user->name; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->email; ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
