<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  margin: 0;
  font-size: 28px;
  font-family: Arial, Helvetica, sans-serif;
  background-color: #0f0f0f;
}

.header {
  background-color: #f1f1f1;
  padding: 30px;
  text-align: center;
}

#navbar {
  overflow: hidden;
  background-color: #333;
  opacity: 90%;
  z-index: 9999;
}

#navbar a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

#navbar a:hover {
  background-color: #ddd;
  color: black;
}

#navbar a.active {
  background-color: #00b359;
  color: white;
}

.content {
  padding: 16px;
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 60px;
}

.navbar .log_in_and_reg {
  float: right;
}

* {box-sizing: border-box;}
body {font-family: Arial, Helvetica, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 600px;
  position: relative;
  margin: 20px;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #00b359;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

}
</style>
<style>
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto;
  background-color: #0f0f0f;
  
}
.grid-item {
  background-color: rgba(40, 40, 40,.98);
  border: 1px solid rgba(0, 0, 0, 0.4);
  padding: 20px;
  font-size: 30px;
  text-align: center;
}
h2.example {
    background-color: #0f0f0f;
    color: #00b359;
}
p.name_color {
    color: #00b359;
}
p.ncol {
    color: white
}
.overlay {
  position: relative;
  bottom: 0; 
  background: rgb(0, 0, 0);
  background: rgba(0, 0, 0, 0.5); /* Black see-through */
  color: #f1f1f1; 
  width: 100%;
  transition: .5s ease;
  opacity:0;
  color: white;
  font-size: 20px;
  padding: 20px;
  text-align: center;
}
.grid-container:hover .overlay {
  opacity: 1;
</style>
<style>
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #00b359;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #333;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #00b359;
  width: 40%; /* Could be more or less, depending on screen size */
  color: white;
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #00b359;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}
</style>
<style>
/* width */
::-webkit-scrollbar {
  width: 8px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #00b359; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #E0E0E0; 
}
</style>
</head>
<body>
<a style="text-decoration:none" href="index.php" ><h2 class="example" align="center">Art Gallery</h2></a>
<div id="navbar">
  <a class="active" href="index.php">Home</a>
  <a href="paintings.php">Paintings</a>
  <a href="photos.php">Photos</a>
  <a href="drawings.php">Drawings</a>
  <a href="about.php">About</a>
  <a href="contact.php">Contact</a>
  <a href="upload.php">Upload</a>
  <a href="search.php">Search</a>
  <div class="navbar">
  <div class="log_in_and_reg">
  <?php
  if (isset($_POST["email"])) {
	  if (isset($_POST["name"])) {
		  $us_name = $_POST["name"];
		  $tmp = array(
		  'u_name' => $_POST["name"],
		  'u_email' => $_POST["email"],
		  'u_password' => $_POST["psw"],
		  'author' => $_POST["author"]
		  );
		  $db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
		  pg_insert($db_connection, 'users', $tmp);;
		  echo "<a>$us_name</a>";
		}
	  else {
		  $user_email = $_POST["email"];
		  $user_password = $_POST["psw"];
		  $db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
		  $result = pg_query($db_connection, "SELECT u_email, u_password, u_name FROM users WHERE u_email='$user_email' AND u_password = '$user_password'");
		  $num_r = pg_num_rows($result);
		  if ($num_r !== 0) {
			  $user_email_r = pg_fetch_result($result, 0, 0);
			  $user_password_r = pg_fetch_result($result, 0, 1);
			  $u_n = pg_fetch_result($result, 0, 2);
			  echo "<a>$u_n</a>";
			}
			else {
				echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
				<button  onclick=window.location.href='register.php' style=width:auto;>Register</button>
				<script>alert('Wrong Email or Password')</script>";
			}
		}
	}
	else echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
	<button  onclick=window.location.href='register.php' style=width:auto;>Register</button>";
  ?>
  </div>
</div>
</div>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="index.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <label for="uemail"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>

<div class="slideshow-container">

<div class="mySlides fade">
  <img src="1.jpg" height="300px" width="100%" border="1px" alt="">
</div>

<div class="mySlides fade">
  <img src="2.jpg" height="300px" width="100%" border="1px" alt="">
</div>

<div class="mySlides fade">
  <img src="3.jpg" height="300px" width="100%" border="1px" alt="">
</div>
<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>
</div>
<br>

<div style="text-align:left">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000); // Change image every 5 seconds
}
</script>

<div class="grid-container">
<?php
$db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
$result = pg_query($db_connection, "SELECT pic_name, pic_id FROM pictures");
$result_1 = pg_query($db_connection, "SELECT COUNT(*) FROM pictures");
$result_2 = pg_query($db_connection, "SELECT u_name FROM users INNER JOIN pictures ON users.user_id = pictures.author_id");
$a = 0;
$coun = pg_fetch_result($result_1, $a, 0);
while($a < $coun) {
$val[$a] = pg_fetch_result($result, $a, 0);
$names[$a] = pg_fetch_result($result_2, $a, 0);
$im[$a] = pg_fetch_result($result, $a, 1);
$a++;
}
$a = 0;
?>
<script>
var i=0;
var arr = <?php echo json_encode($val); ?>;
var k = <?php echo json_encode($im); ?>;
var coun = <?php echo $coun; ?>;
var a_name = <?php echo json_encode($names); ?>;
while (i<coun) {
  
  document.write('<div class="grid-item"><img src="' + k[i] + '.jpg" height="190px" width="90%" border="1px" alt="" /><div class="overlay"><p class="ncol">' + arr[i] + ' ' + 'by ' + a_name[i] + '</p></div></div>')
  i++;
}
 </script> 
</div>
</body>
</html>