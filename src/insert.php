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
    
    //mysqli_select_db($conn, $database);
    
    $availStatus = true;
    
    $sql="INSERT INTO Videos (availability, title, category, minutes)
    VALUES
    ('$availStatus','$_POST[title]','$_POST[category]','$_POST[length]')";
    
    echo $sql . "<br>";
    
    if (mysqli_query($conn, $sql))
    {
        echo "New record created successfully<br>";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    //echo "Record added";
    
    mysqli_close($conn);
    // Send it back to the videos page
    
    //This worked on my local machine, but after putting it up on the OSU server
    //it stopped going back to the main videos.php page
    //Tried location: http://web.engr.oregonstate.edu/~resnerb/videos.php
    //Tried location: /nfs/stak/students/r/resnerb/public_html/videos.php
    header("location: videos.php");
    exit();
?>