<?php
    // Use the $connection object passed from index.php
    global $connection;

    // Fetch user colors with their corresponding color names and user names, ordered by user_id and color_id
    $query = "SELECT uc.user_id, u.name as user_name, uc.color_id, c.css_name 
              FROM user_colors uc 
              JOIN users u ON uc.user_id = u.id
              JOIN colors c ON uc.color_id = c.id 
              ORDER BY uc.user_id ASC, uc.color_id ASC";
    $user_colors = $connection->query($query);

    echo "<table class='table table-striped'>
            <tr>
                <th>User ID</th>
                <th>User Name</th>    
                <th>Color</th>   
                <th>Action</th>   
            </tr>";

    foreach ($user_colors as $user_color) {
        echo "<tr>
                <td>{$user_color->user_id}</td>
                <td>{$user_color->user_name}</td>
                <td><div style='background-color: {$user_color->css_name}; width: 50px; height: 20px;'></div></td>
                <td>
                    <a href='./delete/color_confirmation.php?user_id={$user_color->user_id}&color_id={$user_color->color_id}' class='btn btn-danger'>Delete</a>
                </td>
            </tr>";
    }

    echo "</table>";
?>
