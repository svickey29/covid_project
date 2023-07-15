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
<body>
    <header>
        <div class="logo"><img src="" alt="Covid Dose"></div>
        <nav>
            <ul>
                <li><a href="detail.php">Home</a></li>
                <li><a href="">About US</a></li>
                <li><a href=""></a></li>
                <li><a href="">Logout</a></li>
            </ul>
        </nav>
    </header>
    <form action="" method="POST">
    <div class="container">
        <div class="form-group">
            
            <div class="Th">
            <h1 id="add">ADD VACCINE</h1>
                <label> <input type="text" name="v_name" placeholder="Enter Vaccine name"> </label>
                <label> <input type="text" name="v_quantity" placeholder="Enter Quantity"> </label>
                <label> <select id="state" name="v_state">
                    <option>Select State</option>
                    <?php
                    while($result=mysqli_fetch_array($state)):?>
                    <option value="<?php echo $result['id'] ?>"><?php echo $result['state']?></option>
                    <?php endwhile;?>
                </select></label>
                <label> <select id="city" name="v_city">
                    <option value="" default>Select City</option>

                </select></label>
                <label><input type="submit" name="submit1" value="ADD"></label>
                <label><input type="submit" name="submit4" value="CLICK HERE TO DELETE CENTER"></label>
            </div>
        </div>
    </div>
    </form>
    <script>

        // state --city change
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
                    //console.log(result);
                }
            })
        });
            
    </script>
</body>
</html>
<?php

if(isset($_POST['submit4'])){
    header('location:remove.php');
}
if(isset($_POST['submit1'])){
$v_name = $_POST['v_name'];
$v_quantity = $_POST['v_quantity'];
$v_state = $_POST['v_state'];
$v_city = $_POST['v_city'];
    include 'connection.php';
    $l = "SELECT * FROM add_vaccine";
    $k = mysqli_query($connection, $l);
    $count = 0;

    while ($res = mysqli_fetch_array($k)) {
        if ($res['v_name'] == $v_name && $res['v_city']==$v_city && $res['v_state']==$v_state) {
            $count = $count + 1;
            $j = $res['v_quantity'] + $v_quantity;
            $n = "UPDATE add_vaccine SET v_quantity=$j WHERE v_name = '$v_name' and v_city = '$v_city' and v_state='$v_state'";
            mysqli_query($connection, $n);
            header('location:remove.php');
        }
    }

    if ($count == 0) {
        $q = "INSERT INTO add_vaccine(v_name,v_quantity,v_state,v_city) VALUES ('$v_name', '$v_quantity','$v_state','$v_city')";
        mysqli_query($connection, $q);
        header('location:remove.php');
        
    }
}

?>