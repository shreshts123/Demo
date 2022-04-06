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
</style>
</head>
<body>
<!--=====================Nav-Sec=======================-->
<?php include "nav.php"; ?>
<!--=====================Nav-Sec====================-->

<div class="tabs">
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Paris')"id="defaultOpen">Add Distric</button>
  <button class="tablinks" onclick="openCity(event, 'London')" >Add Places</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Add Package</button>
</div>

<div id="Paris" class="tabcontent">
    <h3>Add Distric</h3>
    <div class="frm">

            <input type="text" id="Country" placeholder="Country" required>
          <input type="text" id="state" placeholder="State" required>
            <input type="text" id="Distric"  placeholder="Distric" required>
            <input type="text" id="ddiscription"  placeholder="Distric Description" required>
            <input type="submit" onClick="dist()" name="DSubmit"><br>
            <a id="res"></a>

        <script>
function dist() {
    var country=document.getElementById('Country').value;
var  distt=document.getElementById('Distric').value;
  var ddis=document.getElementById('ddiscription').value;
    var state=document.getElementById('state').value;
    if(country==""){
        alert("Enter Country");
        return false;
    }else if(distt==""){
        alert("Enter Distric");
        return false;
    }else if(ddis==""){
        alert("Enter Description");
        return false;
    }else{

   //Ajax
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('res').innerHTML =
                this.responseText;

            }
        };
        xmlhttp.open("GET", "php/adddist.php?cntry="+country+"&Dis="+distt+"&ddis="+ddis+"&state="+state, true);
        xmlhttp.send();
}
}
</script>
    </div>
</div>
<div id="London" class="tabcontent">
    <h3>Add Treak</h3>
    <div class="frm">
        <select id="Dist">
            <option value="#">Select District</option>
        </select>
        <input type="text" name="trkname" id="trkname" placeholder="Name Of The Treaking Place">
        <input type="text" name="trkdis" id="trkdis" placeholder="Treaking Description"><br>

        <input type="text" name="duration" id="duration" placeholder="Duration in Days">
        <input type="file" name="Himg" name="Himg" id="Himage" required>
        <input type="text" name="ttc" id="ttc" placeholder="Things To Carry">
        <input type="text" name="map" id="map" placeholder="Paste <frame> Link">

        <input type="submit" onclick="trk()" name="submit">
<script>
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myObj= this.responseText;
                document.getElementById('Dist').insertAdjacentHTML(
                'beforeend',myObj);
            }
        }


        xmlhttp.open("GET", "php/showdist.php", true);
        xmlhttp.send();
</script>
<script>
function trk() {
        //Every Thing
     distt =document.getElementById('Dist').value;
     trkname =document.getElementById('trkname').value;
     trkdis =document.getElementById('trkdis').value;
     duration =document.getElementById('duration').value;
     var Himage =document.getElementById('Himage').value;
     ttc =document.getElementById('ttc').value;
     map =document.getElementById('map').value;
    if(distt==""){
        alert("Enter Distric");
        return false;
    }else if(trkname==""){
        alert("Enter Treak Title");
        return false;
    }else if(trkdis==""){
        alert("Treak Discreption");
        return false;
    }else if(duration==""){
        alert("Enter Duration");
        return false;
    }else if(Himage==""){
        alert("Select Image");
        return false;
    }else if(ttc==""){
        alert("Things To Carry");
        return false;
    }else if(map==""){
        alert("Paste Map Link");
        return false;
    }else{
            addtrk();
}
}
function addtrk(){
    var image=document.getElementById('Himage');
     var imgname=Himage.files.item(0).name;

     //Ajax
       var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('res').innerHTML =
                alert(this.responseText);

            }
        };
        xmlhttp.open("GET", "php/addtreak.php?Distric="+distt+"&trkname="+trkname+"&trkdis="+trkdis+"&duration="+duration+"&Himage="+imgname+"&ttc="+ttc+"&map="+map, true);
        xmlhttp.send();
}
</script>
    </div>
</div>

<div id="Tokyo" class="tabcontent">
  <h3>Add Package</h3>
     <div class="frm">
        <select id="trknam">
            <option value="#">Select Treak</option>
            <?php
    $sql= "select treakname from treak";
if ($rsd=mysqli_query($conn,$sql))
{
    while($row = mysqli_fetch_array($rsd))
    { ?>
            <option value="<?php echo $row['treakname'];?>"><?php echo $row['treakname'];?></option>
     <?php
    }
}
?>
        </select><br>
        <input type="date" name="fdat" id="fdat">
         <input type="date" name="tdat" id="tdat">
        <input type="text" name="dur" id="dur" placeholder="Duration in Days">
        <input type="text" name="pz" id="pz" placeholder="prize">
        <input type="submit" onclick="treakkk()" name="submit">

<script>
function treakkk() {
        //Every Thing
     trknam = document.getElementById('trknam').value;
     fdat =document.getElementById('fdat').value;
     tdat =document.getElementById('tdat').value;
      dur =document.getElementById('dur').value;
     pz =document.getElementById('pz').value;
    if(trknam==""){
        alert("Select Treak Title");
        return false;
    }else if(fdat==""){
        alert("Treak Start Date");
        return false;
    }else if(tdat==""){
        alert("Treak End Date");
        return false;
    }else if(dur==""){
        alert("Duration");
        return false;
    }else if(pz==""){
        alert("Prize");
        return false;
    }else{
            addpkg();
}
}
function addpkg(){

     //Ajax
       var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('res').innerHTML =
                alert(this.responseText);

            }
        };
        xmlhttp.open("GET", "php/addpkg.php?trkname="+trknam+"&fdate="+fdat+"&tdate="+tdat+"&duration="+dur+"&pz="+pz, true);
        xmlhttp.send();
}
</script>

</div>

</div>
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<!--<script src="https://kit.fontawesome.com/7fbc8291bc.js" crossorigin="anonymous"></script> -->
</body>
</html>
