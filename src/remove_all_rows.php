<?php
    $servername = "localhost";
    $username = "root";
    $password = "resnerb";
    $database = "videoDB";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully<br>";
    
    $sql = "SELECT id FROM Videos";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Delete each row from the table
        while($row = $result->fetch_assoc()) {
            $sql = "DELETE FROM Videos WHERE id=" . $row["id"];
            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully";
            } else {
                die("Error deleting record: " . mysqli_connect_error());
                //echo "Error deleting record: " . $conn->error;
            }
        }
    }
    
    mysqli_close($conn);
    // Send it back to the videos page
    header("location: videos.php");
    exit();
?>