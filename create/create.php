<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include connection.php to establish a connection to the SQLite database
    require __DIR__ . '../connection.php';

    // Get the data submitted via POST
    $name = $_POST['name'];
    $email = $_POST['email'];
    $colors = $_POST['colors']; // Get the selected colors as an array

    // Validation (you can add more sophisticated validation as needed)
    if (empty($name) || empty($email) || empty($colors)) {
        // Handle validation error (e.g., display an error message)
        echo "Name, email, and at least one color are required.";
    } else {
        // Data is valid, proceed to insert into the database
        // You may need to modify your database schema to handle multiple colors for each user
        // Here, we'll simply implode the array of colors into a comma-separated string
        $colorIds = implode(',', $colors);

        $query = "INSERT INTO users (name, email, color_ids) VALUES (:name, :email, :color_ids)";
        $statement = $connection->getConnection()->prepare($query);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':color_ids', $colorIds);

        if ($statement->execute()) {
            // Data inserted successfully
            // Redirect back to the index page
            header("Location: index.php");
            exit();
        } else {
            // Handle database insertion error
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
            <div id="colorInputs">
                <div class="mb-3 color-input">
                    <label for="color1" class="form-label">Color 1</label>
                    <input type="color" class="form-control" id="color1" name="colors[]">
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="addColor">Add Color</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById("addColor").addEventListener("click", function() {
            // Get the current number of color inputs
            var colorInputCount = document.querySelectorAll(".color-input").length;

            // Create a new color input element
            var newColorInput = document.createElement("div");
            newColorInput.className = "mb-3 color-input";
            newColorInput.innerHTML = `
                <label for="color${colorInputCount + 1}" class="form-label">Color ${colorInputCount + 1}</label>
                <input type="color" class="form-control" id="color${colorInputCount + 1}" name="colors[]">
            `;

            // Append the new color input element to the colorInputs div
            document.getElementById("colorInputs").appendChild(newColorInput);
        });
    </script>
</body>
</html>