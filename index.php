<?php
session_start();
session_unset();
session_destroy();
include "connection.php";
$l_user="";
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
                <li><a href="signin.php">Sign In</a></li>
                <li><a href="">About Us</a></li>
            </ul>
        </nav>
    </header>
    <form action="" method="POST">
    <div class="container">
        <div class="form-group">
            
            <div class="Th">
            <h1 id="add">LOGIN HERE</h1>
                <label> <input type="email" name="l_email" placeholder="Enter your email id"> </label>
                <label> <input type="password" name="l_pass" placeholder="Enter Password"> </label>
                <label><input type="submit" name="submit9" value="LOGIN"></label>
                <select name="l_user">
                    <option  name="l_user" value="customer" selected>Customer</option>
                    <option  name="l_user" value="admin">Admin</option>
                    </select>
                </label>
                <label >
                    <?php
                    if(isset($_POST['submit9'])){
                        $l_email=$_POST['l_email'];
                        $l_pass=$_POST['l_pass'];
                        $l_user=$_POST['l_user'];
                        $count10=0;
                        if($l_user == 'customer'){
                            $fg="SELECT * FROM user";
                            $fd=mysqli_query($connection,$fg);
                            while($row=mysqli_fetch_array($fd)){
                                if($l_email==$row['u_email'] && $l_pass==$row['u_pass']){
                                    session_start();
                                    $_SESSION['userid']=$l_email;
                                    header('location:c_search.php');
                                    $count10+=1;
                                }
                            
                            }
                        }
                        elseif($l_user == 'admin'){
                            $fg="SELECT * FROM admin";
                            $fd=mysqli_query($connection,$fg);
                            while($row=mysqli_fetch_array($fd)){
                                if($l_email==$row['a_email'] && $l_pass==$row['a_pass']){
                                    session_start();
                                    $_SESSION['userid']=$l_email;
                                    header('location:detail.php');
                                    $count10+=1;
                                    break;
                                }
                                
                            }
                        }
                        if($count10==0){
                            echo "INVALID ENTRY";
                        }
                        
                        
                    }
                    
                    ?>
                </label>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
