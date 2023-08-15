<?php
if(isset($_POST["subject"]))
{
include("connect.php");
$name = mysqli_real_escape_string($con, $_POST["name"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$gender = mysqli_real_escape_string($con, $_POST["gender"]);
$subject = mysqli_real_escape_string($con, $_POST["subject"]);
$comments = mysqli_real_escape_string($con, $_POST["comment"]);

$query = "INSERT INTO users(name,email,gender,subject,comments)VALUES ('$name','$email','$gender','$subject', '$comments')";
mysqli_query($con, $query);
}
?>
