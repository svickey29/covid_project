<?php
session_start();
if(empty($_SESSION['userid'])){
    header('location:index.php');
}
include "connection.php";
$l="Select * from state";
$state=mysqli_query($connection,$l);
$karan="";

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
<style>
    .container table{
        padding-left 50px;
    }
    table{
        align-items:center;
        padding-top:50px;
        padding-bottom:30px;
        
    }
    table tr td{
        text-align:center;
        padding-top: 10px;
        padding-left: 50pxpx;
        
    }
    th{
        font-size: 30px;

        
    }
</style>
<body>
    <header>
        <div class="logo"><img src="" alt="Covid Dose"></div>
        <nav>
            <ul>
                <li><a href="detail.php">Home</a></li>
                
                <li><a href=""></a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="">About US</a></li>
            </ul>
        </nav>
    </header>
    <div class="imp">
    <form action="" method="POST">
    <div class="container">
        <div class="form-group">
            
            <div class="Th">
            <h1 id="add">REMOVE VACCINATION CENTER</h1>
                <label> <select id="state" name="d_state">
                    <option>Select State</option>
                    <?php
                    while($result=mysqli_fetch_array($state)):?>
                    <option value="<?php echo $result['id'] ?>"><?php echo $result['state']?></option>
                    <?php endwhile;?>
                </select></label>
                <label> <select id="city" name="d_city">
                    <option value="" default>Select City</option>

                </select></label>
                <label><input type="submit" name="submit2" value="DELETE"></label>
                <label><input type="submit" name="submit3" value="ADD CENTER OR VACCINE"></label>
                <label id="message"> <?php

if(isset($_POST['submit2'])){
    $v_city=$_POST['d_city'];
    $v_state=$_POST['d_state'];
    include 'connection.php';
    $j="SELECT * FROM add_vaccine";
    $k=mysqli_query($connection,$j);
    $count1=0;
    while ($res = mysqli_fetch_array($k)) {
        if ($res['v_city']==$v_city && $res['v_state']==$v_state) {
            $count1 = $count1 + 1;
            $n = "DELETE FROM add_vaccine WHERE v_city=$v_city and v_state=$v_state";
            mysqli_query($connection, $n);
        }
    }

    if ($count1 == 0) {
        $karan="ALREADY DELETED OR WRONG CHOICE";
        echo "<b style='color:red;'>" . $karan . "</b>";
    }
}
if(isset($_POST['submit3'])){
    header('location:admin.php');
}
?>
</label>

            </div>
        </div>
        
    </div>
    </form>
    
    <script>

        // state --city change
        $('#state').on('change',function(){
            var country_id = this.value;
            //console.log(country_id);
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
   <div class="container5">
        <table>
                <th colspan="4"> CENTER NAME WITH VACCINE </th>
            </tr>
            
            <tr>
                <td>Vaccine Name</td>
                <td>Quantity</td>
                <td>City</td>
                <td>State</td>
            </tr>
            <tr>
                <?php
                include 'connection.php';
                $k="SELECT * FROM add_vaccine";
                $no="";
                $yes="";
                $vaccine=mysqli_query($connection,$k);
                while($row=mysqli_fetch_array($vaccine)){

                    $new_city="SELECT * from city where id='$row[v_city]'";
                    $new_state="SELECT * from state where id='$row[v_state]'";
                    $l1=mysqli_query($connection,$new_city);
                    while($xyz=mysqli_fetch_array($l1)){
                        $no=$xyz['city'];
                    }
                    $l2=mysqli_query($connection,$new_state);
                    while($xz=mysqli_fetch_array($l2)){
                        $yes=$xz['state'];
                    }
                    echo "<tr>";
                    echo "<td>" . $row['v_name'] . "</td>";
                    echo "<td>" . $row['v_quantity'] . "</td>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $yes . "</td>";
                    echo "</tr>";
                }
                ?>

            </tr>
        </table>
        </div>
    </div>
    
</body>
</html>
