<?php
    require_once __DIR__ . '/../config.php';
    require_once ROOT_PATH . '/connection.php'; 

    $users = $connection->query("SELECT * FROM users");

    echo "<table class='table table-striped'>

        <tr>
            <th scope='col'>ID</th>    
            <th scope='col'>Nome</th>    
            <th scope='col'>Email</th>
            <th scope='col'>Ação</th>    
        </tr>
    ";

    foreach ($users as $user) {
        echo "<tr>
                <td>{$user->id}</td>
                <td>{$user->name}</td>
                <td>{$user->email}</td>
                <td>
                    <a href='./update/edit.php?id={$user->id}' class='btn btn-outline-primary'>Editar</a>
                    <a href='./delete/confirmation.php?id={$user->id}' class='btn btn-danger'>Delete</a>
                </td>
            </tr>";
    }

    echo "</table>";
?>
