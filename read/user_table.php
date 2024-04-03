<?php
    require_once __DIR__ . '/../config.php';
    require_once ROOT_PATH . '/connection.php'; 

    $users = $connection->query("SELECT * FROM users");

    echo "<table class='table table-striped text-center'>

        <tr>
            <th scope='col'>ID</th>    
            <th scope='col'>Name</th>    
            <th scope='col'>Email</th>
            <th scope='col'>Action</th>    
        </tr>
    ";

    foreach ($users as $user) {
        echo "<tr>
                <td>{$user->id}</td>
                <td>{$user->name}</td>
                <td>{$user->email}</td>
                <td>
                    <a href='./update/edit.php?id={$user->id}' class='btn btn-outline-primary'>Edit</a>
                    <a href='./delete/user_confirmation.php?id={$user->id}' class='btn btn-danger'>Delete</a>
                </td>
            </tr>";
    }

    echo "</table>";
?>
