<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        require_once __DIR__ . '/../config.php';
        require_once ROOT_PATH . '/connection.php'; 

        $id = $_POST['id'];

        $connection = new Connection();

        $query = "DELETE FROM users WHERE id = :id";
        $statement = $connection->getConnection()->prepare($query);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            // Deletion successful, redirect to index or any other page
            header("Location: " . BASE_URL . "/index.php");
            exit();
        } else {
            // Handle deletion failure
            echo "Failed to delete user.";
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
