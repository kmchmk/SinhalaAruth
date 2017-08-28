<?php
$con=mysqli_connect("localhost","aruthbot","aruth1234","aruth");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$temp = '<font color="red">test</font>';
$name = strip_tags ($temp);
echo $temp;
echo $name;
//$sql="INSERT INTO Persons (FirstName, LastName, Age)
//VALUES ('$firstname', '$lastname', '$age')";

//if (!mysqli_query($con,$sql)) {
//  die('Error: ' . mysqli_error($con));
//}
//echo "1 record added";

mysqli_close($con);
?>