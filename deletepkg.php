<?php
 header("Access-Control-Allow-Origin: *");
$sn=$_REQUEST['sn'];

$servername = "localhost";
$username = "root";
$password = "";
$sessstat="";
// Create connection
$conn = new mysqli($servername, $username, $password,'trip');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "delete FROM book WHERE bsrno=$sn";

if ($conn->query($sql) === TRUE) {
    echo "Ticket Cancelled";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
