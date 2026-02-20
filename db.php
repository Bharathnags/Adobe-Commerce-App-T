<?php
$conn=mysqli_connect("localhost","nags","nags","product_search")or die("Failed to connect to MySQL: " . mysqli_connect_error());
print_r($conn);