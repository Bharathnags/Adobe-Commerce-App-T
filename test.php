<?php
include("db.php");
$data=mysqli_query($conn,"SELECT * FROM products");
echo "<table border='1'>";
echo "<tr>";
echo "<td>ID</td>";
echo "<td>Name</td>";
echo "<td>Price</td>";
echo "<td>Category</td>";
echo "</tr>";
while($row = mysqli_fetch_array($data)){
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['category'] . "</td>";

}
