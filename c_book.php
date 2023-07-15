<?php
session_start();
if(empty($_SESSION['userid'])){
    header('location:index.php');
}
$c_date=$_SESSION['today'];
$c_state=$_SESSION['bookstate'];
$c_city=$_SESSION['bookcity'];
$all=10;
$count4=0;
include 'connection.php';
$l6="SELECT * FROM c_book where c_date='$c_date' and c_city='$c_city'";
$result=mysqli_query($connection,$l6);
while($row=mysqli_fetch_array($result)){
    $count4+=1;
}
$jk=$all - $count4;
$book="TOTAL SLOT LEFT IS " . $all - $count4;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid Dose</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo"><img src="" alt="Covid Dose"></div>
        <nav>
            <ul>
                <li><a href="c_search.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="">About US</a></li>
                
            </ul>
        </nav>
    </header>
    <form action="" method="POST">
    <div class="container">
        <div class="form-group">
            
            <div class="Th">
            <h1 id="add">BOOK YOUR SLOT</h1>
                <label> <input type="text" name="c_name" placeholder="Enter your name" required> </label>
                <label><input type="submit" name="submit7" value="BOOK"></label>
                <label><?php
                if($jk>0){
                    if(isset($_POST['submit7'])){
                        $c_name=$_POST['c_name'];
                        $c_quantity=1;
                        $l5="INSERT INTO c_book(c_name,c_date,c_city,c_quantity,state) values('$c_name','$c_date','$c_city','$c_quantity','$c_state')";
                        mysqli_query($connection,$l5);
                        $book="ONE SLOT BOOKED";
                    }
                    echo "<b style='color:red'>" . $book . "</br>";
                }
                else{
                    echo "<b style='color:red'>SLOT ALREADY FULL</br>";
                }
                
                
                ?></label>
            </div>
        </div>
    </div>
    </form>
</body>
</html>