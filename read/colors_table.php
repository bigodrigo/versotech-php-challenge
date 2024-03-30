<?php
    // Use the $connection object passed from index.php
    global $connection;

    // Fetch colors from the database
    $colors = $connection->query("SELECT * FROM colors");

    echo "<table class='table table-striped'>
            <tr>
                <th>ID</th>    
                <th>Color</th>      
            </tr>";

    foreach ($colors as $color) {
        echo "<tr>
                <td>{$color->id}</td>
                <td>{$color->name}</td>
            </tr>";
    }

    echo "</table>";
?>