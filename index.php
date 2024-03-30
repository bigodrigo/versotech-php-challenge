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
                <p>Podemos visualizar abaixo alguns dos dados, você pode adicionar nova informações clicando no botão:</p>
                <a href='<?php echo BASE_URL ?>/create/add_new_user.php' class='btn btn-outline-success col'>Adicionar Novo Usuário</a>
                <div class="col"></div>
                <a href='<?php echo BASE_URL ?>/create/add_new_color.php' class='btn btn-outline-success col'>Adicionar Nova Cor</a>
            </div>
        </div>

        <div class="container mt-4">
            <h2 class="text-center">Colors Table</h2>
            <?php
                // Include the colors table file to display the color data
                require_once ROOT_PATH . '/read/colors_table.php';
            ?>
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
