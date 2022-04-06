<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";

$t=$_REQUEST['t'];

// Create connection
$conn = new mysqli($servername, $username, $password,'trip');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta http-equiv="X-UA-Compatible" content = "ie=edge">
    <title> TRIPPLING </title>
    <link rel="stylesheet" href="css/nav.css"/>
     <link rel="stylesheet" href="css/comm.css"/>
        <style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat&display=swap');
.dropbtn {
  background-color: #3aafab;
  color: white;
  padding: 10px;
  font-size: 20px;
  border: none;
  cursor: pointer;
    font-family: 'Montserrat', sans-serif;
  line-height: 50px;
   width: 200px;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 80px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 10px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: grid;
}

.dropdown:hover .dropbtn {
  background-color: rgba(0,0,0,0.2);
}
</style>
</head>
<body>
<?php include "nav.php"; ?>
<!--=====================Nav-Sec====================-->

<div id="sectionOne" style="background-image:url(img/ad.jpg);background-size:cover;">
<div class="title-Area">
     <div class="search">
         <p><b><?php echo $t;
?></b></p>
     </div>
</div>
<div class="detail-Area">
    <p><b><?php echo $t;
?></b><br><?php
    $sql= "select ddiscription from distric where dname='".$t."'";
if ($rsd=mysqli_query($conn,$sql))
{
    while($row = mysqli_fetch_array($rsd))
    {
       echo $row['ddiscription'];
    }
}

?>
    </p>
</div>
</div>

<div id="sectionTwo">
<p id="sectitle"><b>Trending Locations In <?php echo $t;
?></b></p>
    <?php
    $sq= "select dsrno from distric where dname='$t'";
    $rs=mysqli_query($conn,$sq);
    $rw = mysqli_fetch_array($rs);
    $dsrno = $rw['dsrno'];

    $sql= "select * from treak where dno=".$dsrno."";
if ($rsd=mysqli_query($conn,$sql))
{
    while($row = mysqli_fetch_array($rsd))
    { ?>
     <div class="card" onclick="window.location='package.php?t=<?php  echo $row['tsrno'];?>&tn=<?php  echo $row['treakname'];?>'">
        <div class="container">
            <h4><b><?php  echo $row['treakname'];?></b></h4>
        </div>
        <img src="img/<?php echo $row['head_image'];?>" alt="Avatar" style="width:100%">
    </div>
     <?php
    }
}

?>

</div>
<footer class="footer-distributed">
        <p>Company Name © 2021</p>
</footer>
<script src="js/index.js" type="text/javascript"></script>
</body>
</html>
