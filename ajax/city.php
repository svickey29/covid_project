<?php

include "../connection.php";
$city = $_POST['country_data'];
$l= "SELECT * FROM city where country_id = $city";
$city_qry = mysqli_query($connection,$l);
$output = '<option value="">Select City</option>';
while ($city_row = mysqli_fetch_array($city_qry)){
    $output .= '<option value="' . $city_row['id'] . '">' . $city_row['city'] . '</option>';
}
echo $output;
?>
