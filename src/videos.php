<?php
    $servername = "localhost";
    $username = "root";
    $password = "resnerb";
    $database = "videoDB";
    //Create connection
    $conn = new mysqli($servername, $username, $password);
    //Check if connection works
    if ($conn->connect_error)
    {
        die ("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected Successfully to MySQL Database Server<br>";
    //Create database if it doesn't already exist
    $sql = "CREATE DATABASE IF NOT EXISTS videoDB";
    if ($conn->query($sql) === FALSE)
    {
        echo "Error creating database: " . $conn->error;
        //TODO Should exit if database can't be created
    }
    
    // Select the videoDB as the default database
    mysqli_select_db($conn, $database);
    
    // Check if the video table exists in the videoDB database
    $sql = "SHOW TABLES IN `videoDB` WHERE `Tables_in_videoDB` = 'Videos'";
    
    // perform the query and store the result
    $result = $conn->query($sql);

    // if the $result not False, and contains at least one row
    //if($result !== false) {
        // if the $result contains at least one row, the table exists, otherwise, not exist
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
    //}
    //else echo 'Unable to check the "tests", error - '. $conn->error;
/*    $sql = "SELECT * FROM Videos";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table><tr><th>Availability</th><th>Title</th><th>Category</th><th>Minutes</th><th>Remove</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $availStatus = "Checked out";
            if ($row["availability"])
            {
                $availStatus = "Available";
            }
            echo "<tr><td>".$availStatus."</td><td>".$row["title"]."</td><td>".$row["category"]."</td><td>".$row["minutes"]."</td><td>"."Remove Button"."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results<br>";
    }
    $conn->close();
 */
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
        echo "<table border='1'><tr><th>Availability</th><th>Title</th><th>Category</th><th>Minutes</th><th>Remove</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $availStatus = "Checked out";
            $bt = "Check In";
            if ($row["availability"])
            {
                $availStatus = "Available";
                $bt = "Check Out";
            }
/*            echo "<tr><td>".$availStatus."</td><td>".$row["title"]."</td><td>".$row["category"]."</td><td>".$row["minutes"]."</td><td>"."<input type='submit' value='Remove Movie' onclick='removeRow(' . $row['id'] . ')'>"."</td></tr>";
 */
            $rid = $row["id"];
            //echo "Row ID from SELECT: " . $rid . "<br>";
            $checkButtonText =
            $removeButtonText = "<form action='remove_row.php' method='post'><button type='submit' name='rowID' value='" . $rid . "'>Remove Movie</button>";
            //$buttonText = "<form action='remove_row.php' method='post'>";
            //echo "Button text for remove movie: " . $buttonText . "<br>";
            
/*            echo "<tr><td>".$availStatus."</td><td>".$row["title"]."</td><td>".$row["category"]."</td><td>".$row["minutes"]."</td><td>"."<input type='button' value='Remove Movie' onclick='location.href=\'remove_row.php?rowID=' . $row['id'] . '\'' />"."</td></tr>";
*/
            echo "<tr><td>".$availStatus."</td><td>".$row["title"]."</td><td>".$row["category"]."</td><td>".$row["minutes"]."</td><td>". $removeButtonText ."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results<br>";
    }
    $conn->close();
?>
</body>
</html>