<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include connection.php to establish a connection to the SQLite database
    require_once __DIR__ . '/../config.php';
    require_once ROOT_PATH . '/connection.php'; 

    // Push the data submitted via POST
    $user_id = $_POST['user_id'];
    $color_id = $_POST['color_id'];

    // Validation
    if (empty($user_id) || empty($color_id)) {
        echo "User and color are required.";
    } else {
        $connection = new Connection();
        $query = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
        $statement = $connection->getConnection()->prepare($query);
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':color_id', $color_id);

        if ($statement->execute()) {
            // Redirect back to the index page
            header("Location: " . BASE_URL . "/index.php");
            exit();
        } else {
            echo "Failed to insert data into the database.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Color</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Add New Color</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="text" class="form-control" id="user_id" name="user_id">
            </div>
            <div class="mb-3">
                <label for="color_id" class="form-label">Color ID</label>
                <input type="text" class="form-control" id="color_id" name="color_id">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
