<?php
$user_id = $_GET['user_id'];
$color_id = $_GET['color_id'];

try {
    require_once __DIR__ . '/../config.php';
    require_once ROOT_PATH . '/connection.php';

    $connection = new Connection();

    $query = "SELECT uc.user_id, c.css_name 
              FROM user_colors uc 
              JOIN colors c ON uc.color_id = c.id 
              WHERE uc.user_id = :user_id AND uc.color_id = :color_id";
    $statement = $connection->getConnection()->prepare($query);
    $statement->bindParam(':user_id', $user_id);
    $statement->bindParam(':color_id', $color_id);
    $statement->execute();
    $user_color = $statement->fetch();

    // Check if user color data exists
    if (!$user_color) {
        echo "<p>Relationship not found.</p>";
        exit(); // Exit script if user color data not found
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
    <title>Confirm Color Delete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Confirm Color Delete</h1>
        <p>Are you sure you want to delete the following Color from user?</p>
        <p><strong>User ID:</strong> <?php echo $user_color['user_id']; ?></p>
        <p><strong>Color:</strong> <div style='background-color: <?php echo $user_color['css_name']; ?>; width: 50px; height: 20px;'></div></p>
        <form action="color_delete.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="color_id" value="<?php echo $color_id; ?>">
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="<?php echo BASE_URL; ?>/index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
