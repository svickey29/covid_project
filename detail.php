<?php

session_start();
if(empty($_SESSION['userid'])){
    header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid Dose</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table td{
            padding:15px;
        }
        .container{
            min-width:700px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo"><img src="" alt="Covid Dose"></div>
        <nav>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="admin.php">Center</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="">About US</a></li>
            </ul>
        </nav>
    </header>
    <form action="" method="POST">
    <div class="container">
        <table>
            <tr>
                <th colspan="4"><h1> CENTER NAME WITH VACCINE</h1> </th>
            </tr>
            
            <tr><b>
                <td>Vaccine Name</td>
                <td>Quantity</td>
                <td>Date</td>
                <td>City</td>
    </b>
            </tr>
            
                <?php
                include 'connection.php';
                $k="SELECT * FROM c_book";
                $vaccine=mysqli_query($connection,$k);
                $home="";
                while($row=mysqli_fetch_array($vaccine)){
                    
                    $rj=$row['c_city'];
                    $mj="Select city from city where id='$rj'";
                    $city_result=mysqli_query($connection,$mj);
                    while($row_2=mysqli_fetch_array($city_result)){
                        $home=$row_2['city'];
                    }
                    echo "<tr>";
                    echo "<td>" . $row['c_name'] . "</td>";
                    echo "<td>" . $row['c_quantity'] . "</td>";
                    echo "<td>" . $row['c_date'] . "</td>";
                    echo "<td>" . $home . "</td>";
                    echo "</tr>";
                }
                ?>

            
        </table>
    </div>
    </form>
</body>
</html>