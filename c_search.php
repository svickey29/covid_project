<?php
session_start();
if(empty($_SESSION['userid'])){
    header('location:index.php');
}
include "connection.php";
$l="Select * from state";
$state=mysqli_query($connection,$l);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid Dose</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>
</head>
<body>
    <header>
        <div class="logo"><img src="" alt="Covid Dose"></div>
        <nav>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="">About US</a></li>
                
            </ul>
        </nav>
    </header>
    <form action="" method="POST">
    <div class="container">
        <div class="form-group">
        <div class="Th">
            <h1 id="add">SEARCH VACCINATION CENTER</h1>
                <label><input type="date" name="c_date"></label>
                <label> <select id="state" name="c_state">
                    <option>Select State</option>
                    <?php
                    while($result=mysqli_fetch_array($state)):?>
                    <option value="<?php echo $result['id'] ?>"><?php echo $result['state']?></option>
                    <?php endwhile;?>
                </select></label>
                <label> <select id="city" name="c_city">
                    <option value="" default>Select City</option>

                </select></label>
                <label><input type="submit" name="submit6" value="SEARCH"></label>
                <label><b style="color:red;"><?php

if(isset($_POST['submit6'])){
    $_SESSION["today"]=$_POST['c_date'];
    $_SESSION["bookstate"]=$_POST['c_state'];
    $_SESSION["bookcity"]=$_POST['c_city'];
    $c_date=$_POST['c_date'];
    $c_state=$_POST['c_state'];
    $c_city=$_POST['c_city'];
    include 'connection.php';
    $l3="SELECT * FROM add_vaccine";
    $ans=mysqli_query($connection,$l3);
    $count2=0;
    while($row_1=mysqli_fetch_array($ans)) {
        if($row_1['v_city']==$c_city && $row_1['v_state']==$c_state ){
            $count2+=1;
            header('location:c_book.php');
        }
    }
    if($count2==0){
        $vickey="NO VACCINATION CENTER FOUND";
        echo $vickey;
    }
}

?></b></label>
            </div>

        </div>
    </div>
    </form>
    
    <script>
        $('#state').on('change',function(){
            var country_id = this.value;
            console.log(country_id);
            $.ajax({
                url: 'ajax/city.php',
                type:"POST",
                data:{
                    country_data : country_id
                },
                success:function(result){
                    $('#city').html(result);
                }
            })
        });
            
    </script>
</body>
</html>