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
    
    $sql = "DELETE FROM Videos WHERE id=" . $_POST["rowID"];

    echo "DELETE sql: " . $sql . "<br>";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        die("Error deleting record: " . mysqli_connect_error());
        //echo "Error deleting record: " . $conn->error;
    }
    
    mysqli_close($conn);
    // Send it back to the videos page
    header("location: videos.php");
    exit();
?>