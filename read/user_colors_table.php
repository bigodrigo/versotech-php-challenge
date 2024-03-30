<?php
    // Use the $connection object passed from index.php
    global $connection;

    // Fetch colors from the database
    $colors = $connection->query("SELECT * FROM user_colors");

    echo "<table class='table table-striped'>
            <tr>
                <th>User</th>    
                <th>Color</th>      
            </tr>";

    foreach ($users as $user) {
        echo "<tr>
                <td>{$user->user_id}</td>
                <td>{$user->color_id}</td>
            </tr>";
    }

    echo "</table>";
?>