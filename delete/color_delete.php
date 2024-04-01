<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        require_once __DIR__ . '/../config.php';
        require_once ROOT_PATH . '/connection.php'; 

        $user_id = $_POST['user_id'];
        $color_id = $_POST['color_id'];

        $connection = new Connection();

        $query = "DELETE FROM user_colors WHERE user_id = :user_id AND color_id = :color_id";
        $statement = $connection->getConnection()->prepare($query);
        $statement->bindParam(':user_id', $user_id);
        $statement->bindParam(':color_id', $color_id);

        if ($statement->execute()) {
            // Deletion successful, redirect to index or any other page
            header("Location: " . BASE_URL . "/index.php");
            exit();
        } else {
            // Handle deletion failure
            echo "Failed to delete user color relationship.";
        }
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Handle invalid request
    echo "Invalid request.";
}
?>
