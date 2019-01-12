<?php

$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "dbusers";
$result = 0;

/* Create connection */
$conn = new mysqli($host, $username, $password, $dbname);
/* Check connection */
if ($conn->connect_error) {
     die("Connection to database failed: " . $conn->connect_error);
}

/* Get data from Client side using $_POST array */
$fname  = $_POST['first_name'];
$lname  = $_POST['last_name'];
$email  = $_POST['email'];
/* validate whether user has entered all values. */
if(!$fname || !$lname || !$email){
  $result = 2;
}elseif (!strpos($email, "@") || !strpos($email, ".")) {
  $result = 3;
}
else {
   //SQL query to get results from database
   $sql    = "insert into users (first_name, last_name, email) values (?, ?, ?)  ";
   $stmt   = $conn->prepare($sql);
   $stmt->bind_param('sss', $fname, $lname, $email);
   if($stmt->execute()){
     $result = 1;
   }
}
echo $result;
$conn->close();

?>
