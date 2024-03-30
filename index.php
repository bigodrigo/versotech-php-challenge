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
        <div class="container text-center">
            <div class="row">
                <p class="col-8">Podemos visualizar abaixo alguns dos dados, você pode adicionar nova informações clicando no botão:</p>
                <a href='./create/create.php' class='btn btn-outline-success col-4'>Adicionar Novo</a>
            </div>
        </div>
        <?php
            // Include the Connection class to establish a connection to the SQLite database
            require './connection.php';

            // Create a new connection instance
            $connection = new Connection();
        ?>

        <div class="container mt-4">
            <h2 class="text-center">Users Table</h2>
            <?php
            // Include the user table file to display the user data
            require './read/user_table.php';
            ?>
        </div>

        <div class="container mt-4">
            <h2 class="text-center">Colors Table</h2>
            <?php
            // Include the colors table file to display the color data
            require './read/colors_table.php';
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
