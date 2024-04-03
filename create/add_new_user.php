<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include connection.php to establish a connection to the SQLite database
    require_once __DIR__ . '/../config.php';
    require_once ROOT_PATH . '/connection.php'; 

    // Push the data submitted via POST
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Validation
    if (empty($name) || empty($email)) {
        echo "Name and email are required.";
    } else {
        $connection = new Connection();
        $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $statement = $connection->getConnection()->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);

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
    <title>Add New Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Add New Data</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>