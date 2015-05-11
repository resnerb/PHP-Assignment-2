<?php
    $servername = "oniddb.cws.oregonstate.edu";
    $username = "resnerb-db";
    $password = "7qKnFUFXqMYOmsTZ";
    $database = "resnerb-db";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully<br>";
    
    $sql = "SELECT * FROM Videos WHERE id=" . $_POST["checkRowID"];
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Delete each row from the table
        while($row = $result->fetch_assoc()) {
            $availStatus = 1;
            if ($row["availability"])
            {
                $availStatus = 0;
            }
            $sql = "UPDATE Videos SET availability=" . $availStatus . " WHERE id=" . $row["id"];
            
            echo "UPDATE of availability: " . $sql . "<br>";
            
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                die("Error updating record: " . mysqli_connect_error());
                //echo "Error deleting record: " . $conn->error;
            }
        }
    }
    
    mysqli_close($conn);
    // Send it back to the videos page
    header("location: videos.php");
    exit();
?>