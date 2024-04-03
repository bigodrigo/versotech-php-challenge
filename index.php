<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <h1 class="text-center">CRUD Challenge</h1>
    <div class="container">
        <?php
            // Include the Connection class to establish a connection to the SQLite database
            require_once 'config.php';
            require_once ROOT_PATH . '/connection.php';

            // Create a new connection instance
            $connection = new Connection();
        ?>

        <div class="container text-center">
            <div class="row">
                <h4 class='mx-5'>This application allows for user creation and color selection. You can view the color table and add information using the buttons below:</h4>
                <a href='<?php echo BASE_URL ?>/create/add_new_user.php' class='btn btn-outline-success col mx-5'>Add New User</a>
                <button type="button" class="btn btn-outline-primary col mx-5" data-bs-toggle="modal" data-bs-target="#colorsModal">
                Show Colors Table
            </button>
                <a href='<?php echo BASE_URL ?>/create/add_new_color.php' class='btn btn-outline-success col mx-5'>Add a Color to a User</a>
            </div>
        </div>

        <div class="container mt-4">

        </div>

        <!-- Modal -->
        <div class="modal fade" id="colorsModal" tabindex="-1" aria-labelledby="colorsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="colorsModalLabel">Colors Table</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php require_once ROOT_PATH . '/read/colors_table.php'; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <h2 class="text-center">Users Table</h2>
            <?php
                // Include the user table file to display the user data
                require_once ROOT_PATH . '/read/user_table.php';
            ?>
        </div>

        <div class="container mt-4">
            <h2 class="text-center">Users Colors Table</h2>
            <?php
                // Include the user table file to display the user data
                require_once ROOT_PATH . '/read/user_colors_table.php';
            ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
