<?php
    // Use the $connection object passed from index.php
    global $connection;

    // Fetch users and their associated colors from the database
    $usersWithColors = $connection->query("
        SELECT u.id AS user_id, u.name AS user_name, u.email AS user_email, c.id AS color_id, c.name AS color_name
        FROM users u
        LEFT JOIN user_colors uc ON u.id = uc.user_id
        LEFT JOIN colors c ON uc.color_id = c.id
    ");

    echo "<table class='table table-striped'>
            <tr>
                <th>ID</th>    
                <th>Nome</th>    
                <th>Email</th>
                <th>Cor Favorita</th>
                <th>Ação</th>    
            </tr>";

    foreach ($usersWithColors as $row) {
        echo "<tr>
                <td>{$row->user_id}</td>
                <td>{$row->user_name}</td>
                <td>{$row->user_email}</td>
                <td>{$row->color_name}</td>
                <td>
                    <a href='#' class='btn btn-outline-primary'>Editar</a>
                    <a href='#' class='btn btn-danger'>Excluir</a>
                </td>
            </tr>";
    }

    echo "</table>";
?>
