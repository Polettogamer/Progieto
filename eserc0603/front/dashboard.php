<?php
require_once "../back/connection.php";
require_once "../back/queries.php";

$result = $conn->query($q1);

if ($result) {
    // This will fetch all rows as associative arrays
    $list = $result->fetch_all(MYSQLI_ASSOC); 
    // Do something with $list, for example, print it
    print_r($list);
} else {
    echo "Error: " . $conn->error;
}

?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        
     
    </body>
</html>