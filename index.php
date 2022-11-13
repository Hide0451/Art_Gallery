<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="g_styles.css">
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
		  if ($num_r <> 0) {
			  $user_email_r = pg_fetch_result($result, 0, 0);
			  $user_password_r = pg_fetch_result($result, 0, 1);
			  $u_n = pg_fetch_result($result, 0, 2);
			  echo "<a>$u_n</a>";
			}
			else {
				echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
				<button  onclick=window.location.href='register.html' style=width:auto;>Register</button>
				<script>alert('Wrong Email or Password')</script>";
			}
		}
	}
	else echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
	<button  onclick=window.location.href='register.html' style=width:auto;>Register</button>";
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
        
      <button type="submit">Log in</button>
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
<table width="95%" align="center">
<td align="left" width="70%">
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
<br>
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
</div>
</td>
<td><p class="ncol">Welcome to Art Gallery!
A place where you can find a lot of artwork from famous artists!</p></td>
</table>
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
  
  document.write('<div class="grid-item" id="' + k[i] + '"><button class="expand" id="' + k[i] + '" onclick="document.getElementById(\'id02\').style.display=\'block\';updateRecord(this)"><img src="' + k[i] + '.jpg" height="190px" width="90%" border="1px" alt="" /><div class="overlay"><p class="ncol">' + arr[i] + ' ' + 'by ' + a_name[i] + '</p></div></button></div>');
  i++;
}
</script>
</div>
<script>
	function updateRecord(button){
		var id = button.id;
	  document.write('<img src="' + id + '.jpg">');
	}
</script>
<div id="id02" class="modal">
  
  <form class="modal-content animate">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>