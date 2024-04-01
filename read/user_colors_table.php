<?php
    // Use the $connection object passed from index.php
    global $connection;

    // Fetch user colors with their corresponding color names, ordered by user_id and color_id
    $query = "SELECT uc.user_id, c.css_name 
              FROM user_colors uc 
              JOIN colors c ON uc.color_id = c.id 
              ORDER BY uc.user_id ASC, uc.color_id ASC";
    $user_colors = $connection->query($query);

    echo "<table class='table table-striped'>
            <tr>
                <th>User</th>    
                <th>Color</th>      
            </tr>";

    foreach ($user_colors as $user_color) {
        echo "<tr>
                <td>{$user_color->user_id}</td>
                <td><div style='background-color: {$user_color->css_name}; width: 50px; height: 20px;'></div></td>
            </tr>";
    }

    echo "</table>";
?>
