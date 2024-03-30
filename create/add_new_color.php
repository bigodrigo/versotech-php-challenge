<?php
    // Include connection.php to establish a connection to the SQLite database
    require_once __DIR__ . '/../config.php';
    require_once ROOT_PATH . '/connection.php';

    // Fetch list of users
    $users = $connection->query("SELECT id, name FROM users");

    // Fetch list of colors
    $colors = $connection->query("SELECT id, name FROM colors");
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
        <form action="process_new_color.php" method="post">
            <div class="mb-3">
                <label for="user_id" class="form-label">Select User</label>
                <select class="form-select" id="user_id" name="user_id">
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->id ?>"><?= $user->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="colorInputs">
                <div class="mb-3 color-input">
                    <label for="color1" class="form-label">Color 1</label>
                    <select class="form-select" name="colors[]">
                        <?php foreach ($colors as $color): ?>
                            <option value="<?= $color->id ?>"><?= $color->name ?></option>
                        <?php endforeach; ?>
                    </select>
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
                <select class="form-select" name="colors[]">
                    <?php foreach ($colors as $color): ?>
                        <option value="<?= $color->id ?>"><?= $color->name ?></option>
                    <?php endforeach; ?>
                </select>
            `;

            // Append the new color input element to the colorInputs div
            document.getElementById("colorInputs").appendChild(newColorInput);
        });
    </script>
</body>
</html>
