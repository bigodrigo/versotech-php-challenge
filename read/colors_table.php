<?php
    // Use the $connection object passed from index.php
    global $connection;

    $colors = $connection->query("SELECT * FROM colors");

    echo "<table class='table table-striped'>
            <tr>
                <th>ID</th>    
                <th>Color Name</th>      
                <th>Color</th>  
            </tr>";

    foreach ($colors as $color) {
        echo "<tr>
                <td>{$color->id}</td>
                <td>{$color->name}</td>
                <td><div style='background-color: {$color->css_name}; width: 50px; height: 20px;'></div></td>
            </tr>";
    }

    echo "</table>";
?>