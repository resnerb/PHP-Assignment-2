<?php
    $servername = "oniddb.cws.oregonstate.edu";
    $username = "resnerb-db";
    $password = "7qKnFUFXqMYOmsTZ";
    $database = "resnerb-db";
    //$servername = "localhost";
    //$username = "root";
    //$password = "resnerb";
    //$database = "videoDB";
    //Create connection
    $conn = new mysqli($servername, $username, $password);
    //Check if connection works
    if ($conn->connect_error)
    {
        die ("Connection failed: " . $conn->connect_error);
    }
    //Create database if it doesn't already exist
    $sql = "CREATE DATABASE IF NOT EXISTS " . $database;
    if ($conn->query($sql) === FALSE)
    {
        echo "Error creating database: " . $conn->error;
        //TODO Should exit if database can't be created
    }
    
    // Select the videoDB as the default database
    mysqli_select_db($conn, $database);
    
    // Check if the video table exists in the videoDB database
    $sql = "SHOW TABLES IN `". $database . "` WHERE `Tables_in_" . $database . "` = 'Videos'";
    
    // perform the query and store the result
    $result = $conn->query($sql);

    // if the $result not False, and contains at least one row
    if ($result->num_rows == 0)
    {
        // Table doesn't exist, so create it
        $sql = "CREATE TABLE Videos (
        id INT (5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        availability BOOL,
        title VARCHAR (255) NOT NULL,
        category VARCHAR (255) NOT NULL,
        minutes INT (3) UNSIGNED
        )";
        if ($conn->query($sql) === TRUE) {
            echo "Table Videos created successfully<br>";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Mutliplication Table</title>
</head>
<body>

<form action="insert.php" method="post">
Title:<br>
<input type="text" name="title">
<br>
Category:<br>
<input type="text" name="category">
<br>
Time/Length (in minutes):<br>
<input type="text" name="length">
<br><br>
<input type="submit" value="Add Movie">
</form>

<form action="remove_all_rows.php" method="post">
<br>
<input type="submit" value="Delete All Movies">
<br>
</form>


<?php
    $sql = "SELECT * FROM Videos";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>Action</th><th>Availability</th><th>Title</th><th>Category</th><th>Minutes</th><th>Remove</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $availStatus = "Checked out";
            $bt = "Check In";
            if ($row["availability"])
            {
                $availStatus = "Available";
                $bt = "Check Out";
            }
            
            $rid = $row["id"];
            
            // Remove button was working prior to adding the check in/out button - don't know why
            // the remove button stopped working!
            $removeButtonText = "<form action='remove_row.php' method='post'><button type='submit' name='removeRowID' value='" . $rid . "'>Remove Movie</button>";
            $checkButtonText = "<form action='check_availability.php' method='post'><button type='submit' name='checkRowID' value='" . $rid . "'>".$bt."</button>";

            echo "<tr><td>".$checkButtonText."</td><td>".$availStatus."</td><td>".$row["title"]."</td><td>".$row["category"]."</td><td>".$row["minutes"]."</td><td>". $removeButtonText ."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<br>There are no movies entered in the database!<br>";
    }
    $conn->close();
?>
</body>
</html>