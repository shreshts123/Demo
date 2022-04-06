<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,'trip');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$t=$_REQUEST['pno'];
$nam=""
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta http-equiv="X-UA-Compatible" content = "ie=edge">
    <title> TRIPPLING </title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/nav.css"/>
    <style>

/* Style the tab */
.tabs{
     display: flex;
     flex: grid;
    position: relative;
}
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 30%;
  height: 300px;
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 70%;
  border-left: none;
  height: 100%;display: flex;
}

/* Style the content */
article {
  -webkit-flex: 3;
  -ms-flex: 3;
  flex: 3;
  background-color: #f1f1f1;
  padding: 20px;
}
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
.frm{
    padding: 40px;
    font-family: 'Montserrat', sans-serif;
}
.frm input[type="text"]{
    margin: 20px;
    padding: 10px;
    width: 200px;
    border: none;
    border-bottom: 1px solid grey;
    outline: none;
}
.frm input[type="submit"]{
    padding: 10px;
}
        .book{
            width: 100%;
            height: 100vh;
        }
        .book .frm{
            width:250px;
            margin: 50px;
            border: 1px solid black;
        }
</style>
</head>
<body>
<?php include "nav.php"; ?><!--=====================Nav-Sec====================-->
    <?php
         $sql1= "select * from userdetails where srno='".$t."'";
         $rsd1=mysqli_query($conn,$sql1);
         $row1 = mysqli_fetch_array($rsd1);
    ?>
<div class="book">
    <center>
    <div class="frm">
        <b style="font-size:24px;">Booking</b> <br><br>
      Name
      <input id="name" class="txtBox" type="text" placeholder="Enter Name" value="<?php echo $row1['name']; ?>"/>
      Mobile
      <input id="mobno" class="txtBox" type="text" value="<?php echo $row1['phno']; ?>" placeholder="Mobile Number*"/>
      Email
      <input id="email" type="text" value="<?php echo $row1['email']; ?>" placeholder="Email*"/>
      <input style="display:none;" id="pno" type="text" value="<?php echo $t; ?>" placeholder="Email*"/>

                   Adult*
             <select id="adult">
             <option value="0">0</option>
             <option value="1">1</option>
             <option value="2">2</option>
             <option value="3">3</option>
             <option value="4">4</option>
             <option value="5">5</option>
             </select>
                 Child
             <select id="child">
             <option value="0">0</option>
             <option value="1">1</option>
             <option value="2">2</option>
             <option value="3">3</option>
             <option value="4">4</option>
             <option value="5">5</option>
             </select>
                 <?php
                 $sql= "select * from package where psrno='$t'";
                 $rsd=mysqli_query($conn,$sql);
                 $row = mysqli_fetch_array($rsd); ?>



             <p><br>From <b id="fd"><?php echo $row['fdate']; ?></b> To <b id="td"><?php echo $row['tdate']; ?></b></p>
             <p><br>Prize : INR <b id="pz"><?php echo $row['prize']; ?>/-</b></p>

               <input onclick="addbook()" type="submit" >
     <script>
function addbook (){

     name =document.getElementById('name').value;
     mob =document.getElementById('mobno').value;
     em =document.getElementById('email').value;
     adult =document.getElementById('adult').value;
     child =document.getElementById('child').value;
    pno =document.getElementById('pno').value;

    if(name==""){
        alert("Enter Name");
        return false;
    }else if(mob==""){
        alert("Enter Mobile Number");
        return false;
    }else if(em==""){
        alert("Enter Email");
        return false;
    }else if(adult==0){
        alert("Select Adults");
        return false;
    }else if(child==""){
        alert("Select Childrens");
        return false;
    }else{
            bok();
}
}
function bok(){
     //Ajax
       var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('res').innerHTML =
                alert(this.responseText);

            }
        };
        xmlhttp.open("GET", "php/booking.php?name="+name+"&mob="+mob+"&em="+em+"&adult="+adult+"&child="+child+"&pno="+pno, true);
        xmlhttp.send();
}
</script>
  </div>
    </center>

  </div>

    </body>
</html>
