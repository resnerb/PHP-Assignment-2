<?php
    $servername = "localhost";
    $username = "username";
    $password = "password";
    
    $conn = new mysqli($servername, $username, $password);
    
    if ($conn->connect_error)
    {
        die ("Connection failed: " . $conn->connect_error);
    }
    echo "Connected Successfully";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Mutliplication Table</title>
</head>
<body>

<?php
    $table='<table border="1">';
    for($r = 0; $r < 2; $r++)
    {
        $table .= '<tr>';
        for($c = 0; $c < 6; $c++)
        {
            if ($r==0 && $c==0)
            {
                $table .= "<td>" . $minMultiplicand*$minMultiplier . "</td>";
            }
            elseif ($r==0 && $c==1)
            {
                $table .= "<td>" . $minMultiplicand*$maxMultiplier . "</td>";
            }
            elseif ($r==1 && $c==0)
            {
                $table .= "<td>" . $maxMultiplicand*$minMultiplier . "</td>";
            }
            else
            {
                $table .= "<td>" . $maxMultiplicand*$maxMultiplier . "</td>";
            }
        }
        $table .= '</tr>';
    }
    echo $table;
?>