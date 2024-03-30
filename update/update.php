<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        require_once __DIR__ . '/../config.php';
        require_once ROOT_PATH . '/connection.php'; 

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        if (empty($name) || empty($email)) {
            echo "Name and email are required.";
        } else {
            $connection = new Connection();

            $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
            $statement = $connection->getConnection()->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':email', $email);

            if ($statement->execute()) {
                // Data updated successfully
                $connection->disconnect();
                header("Location: " . BASE_URL . "/index.php");
                exit();
            } else {
                // Handle database update error
                echo "Failed to update user data.";
            }
        }
    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
