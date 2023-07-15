<?php
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
                <li><a href=""></a></li>
                <li><a href="index.php">LogIn</a></li>
                <li><a href="">About Us</a></li>
            </ul>
        </nav>
    </header>
    <form action="" method="POST">
    <div class="container">
        <div class="form-group">
            
            <div class="Th">
            <h1 id="add">SIGNIN HERE</h1>
                <label> <input type="text" name="u_name" placeholder="Enter name" required> </label>
                <label>
                <select name="gender">
                    <option> Select gender</option>
                    <option value="male" name="gender">Male</option>
                    <option value="female" name="gender">Female</option>
                </select>
                </label>
                <label> <input type="email" name="u_email" placeholder="Enter your email id" required> </label>
                <label> <input type="password" name="u_pass" placeholder="Enter Password" required> </label>
                <label> <input type="password" name="c_pass" placeholder="Confirm Password" required> </label>
                <label><b style="font-size:25px;padding-right:170px;" required> DATE OF BIRTH</b></label>
                <label> <input type="date" name="u_date" placeholder="Enter your dob" required> </label>
                <label> <select id="state" name="u_state" required>
                    <option>Select State</option>
                    <?php
                    while($result=mysqli_fetch_array($state)):?>
                    <option value="<?php echo $result['id'] ?>"><?php echo $result['state']?></option>
                    <?php endwhile;?>
                </select></label>
                <label> <select id="city" name="u_city" required>
                    <option value="" default>Select City</option>

                </select></label>
                <label><input type="submit" name="submit8" value="SIGNUP"></label>
                <select name="user" style="color:red;">
                    <option  name="user" value="customer">Customer</option>
                    <option  name="user" value="admin">Admin</option>
                    </select>
                </label>
                <label><?php
$message="";
if(isset($_POST['submit8'])){

    $u_name=$_POST['u_name'];
    $u_gender=$_POST['gender'];
    $u_email=$_POST['u_email'];
    $u_dob=$_POST['u_date'];
    $u_state=$_POST['u_state'];
    $u_city=$_POST['u_city'];
    $u_user=$_POST['user'];
    $u_password=$_POST['u_pass'];
    $c_password=$_POST['c_pass'];
    if($u_password!=$c_password){
        $message="PASSWORD DIDN'T MATCHED";
    }
    
    else{
        $count6=0;
        if($count6==0 && $u_user=='customer'){
            $fgh="SELECT * from user";
            $row_6=mysqli_query($connection,$fgh);
            while($select=mysqli_fetch_array($row_6)){
                if($select['u_email']==$u_email){
                    $count6+=1;
                }
            }
        }
        if($count6==0 && $u_user=='admin'){
            $fgh="SELECT * from admin";
            $row_6=mysqli_query($connection,$fgh);
            while($select=mysqli_fetch_array($row_6)){
                if($select['a_email']==$u_email){
                    $count6+=1;
                }
            }
        }
    if($u_user=='customer' && $count6==0)
        {
            $hjk="INSERT INTO user(u_name,u_gender,u_email,u_dob,city,state,u_pass) values('$u_name','$u_gender','$u_email','$u_dob','$u_city','$u_state','$u_password')";
            mysqli_query($connection,$hjk);
            header('location:index.php');
        }
    elseif ($u_user=='admin' && $count6==0) {
        $hjk="INSERT INTO admin(a_name,a_gender,a_email,a_dob,city,state,a_pass) values('$u_name','$u_gender','$u_email','$u_dob','$u_city','$u_state','$u_password')";
            mysqli_query($connection,$hjk);
            header('location:index.php');
    }
    elseif($count6!=0){
        $message= "USER ALREADY EXIT USE ANOTHER EMAIL";
    }
    }

}

echo "<b style='color:red;'>".$message."</b>";

?></label>
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
