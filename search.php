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
  margin: 5px;
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
  padding: 5px;
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
button.expand {
	background-color: rgba(40, 40, 40,.98);
}
p.ncol {
    color: white;
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
  padding: 5px;
  text-align: center;
}
.grid-item:hover .overlay {
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
<style>
* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: #0f0f0f;
  color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #00b359;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #333;
  text-align: center;
}
</style>
<style>
/*the container must be positioned relative:*/
.custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element:*/
}

.select-selected {
  background-color: #333;
}

/*style the arrow inside the select element:*/
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/*point the arrow upwards when the select box is open (active):*/
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/*style the items (options), including the selected item:*/
.select-items div,.select-selected {
  color: #ffffff;
  padding: 4px 8px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
  user-select: none;
}

/*style items (options):*/
.select-items {
  position: absolute;
  background-color: #333;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/*hide the items when the select box is closed:*/
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}
</style>
</head>
<body>
<a style="text-decoration:none" href="index.php" ><h2 class="example" align="center">Art Gallery</h2></a>
<div id="navbar">
  <a href="index.php">Home</a>
  <a href="paintings.php">Paintings</a>
  <a href="photos.php">Photos</a>
  <a href="drawings.php">Drawings</a>
  <a href="about.php">About</a>
  <a href="contact.php">Contact</a>
  <a href="upload.php">Upload</a>
  <a class="active" href="search.php">Search</a>
  <div class="navbar">
  <div class="log_in_and_reg">
  <?php
  $db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
  if (isset($_POST["p_name"])) {
	      $author_n = $_POST["a_id"];
		  $result = pg_query($db_connection, "SELECT u_name, user_id FROM users WHERE u_name = '$author_n'");
		  $num_r = pg_num_rows($result);
		  $check_c = $_POST["c_id"];
		  $check_g = $_POST["g_id"];
		  if ($num_r <> 0 and $check_c <> 0 and $check_g <> 0) {
			  $author_id = pg_fetch_result($result, 0, 1);
			  $tmp = array(
			  'pic_name' => $_POST["p_name"],
			  'author_id' => $author_id,
			  'category_id' => $_POST["c_id"],
			  'genre_id' => $_POST["g_id"],
			  'year_taken' => $_POST["year_t"]);
			  pg_insert($db_connection, 'pictures', $tmp);
			  echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
			  <button  onclick=window.location.href='register.php' style=width:auto;>Register</button>
			  <script>alert('Image successfully uploaded.')</script>";
		    }
		  else {
			  echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
			  <button  onclick=window.location.href='register.php' style=width:auto;>Register</button>
			  <script>alert('The author with the name you entered does not exist or he does not have rights')</script>";
		    }
    }
	else {
		if (isset($_POST["login"]) and isset($_POST["psw"])) {
			if (isset($_POST["name"])) {
				$us_name = $_POST["name"];
				$tmp = array(
				'u_name' => $_POST["name"],
				'u_email' => $_POST["login"],
				'u_password' => $_POST["psw"],
				'author' => $_POST["author"]
				);
				pg_insert($db_connection, 'users', $tmp);
				echo "<a>$us_name</a>";
			}
			else {
				$user_email = $_POST["login"];
				$user_password = $_POST["psw"];
				$result = pg_query($db_connection, "SELECT * FROM users WHERE u_email='$user_email' AND u_password = '$user_password'");
				$num_r = pg_num_rows($result);
				if ($num_r <> 0) {
					$user_id_r = pg_fetch_result($result, 0, 0);
					$user_email_r = pg_fetch_result($result, 0, 2);
					$user_password_r = pg_fetch_result($result, 0, 3);
					$u_n = pg_fetch_result($result, 0, 1);
					$aur = pg_fetch_result($result, 0, 4);
						echo "<a>$u_n</a>";
					}
				else {
					echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
					<button  onclick=window.location.href='register.php' style=width:auto;>Register</button>
					<script>alert('Wrong Email or Password')</script>";
				}
			}
		}
		else { echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
		<button  onclick=window.location.href='register.php' style=width:auto;>Register</button>";
	}
	}
	?>
  </div>
</div>
</div>
  <form action="search_r.php" method="post">
  <div class="container">
  <h3>Search for image(s)</h3>
  <hr>
  <label for="p_name"><b>Name</b></label>
  <input type="text" placeholder="Enter Name" name="p_name" id="p_name">
  <hr>
  <label for="a_id"><b>Author name</b></label>
  <input type="text" placeholder="Enter Author" name="a_id" id="a_id">
  <hr>
  <table>
  <td>
  <label for="c_id"><b>Category: </b></label>
  </td>
  <td>
  <div class="custom-select" style="width:230px;">
  <select id="c_id" name="c_id">
    <option value="0">Select category</option>
    <option value="1">Photo</option>
    <option value="2">Painting</option>
    <option value="3">Drawing</option>
  </select>
  </div>
  </td>
  </table>
  <hr>
  <table>
  <td>
  <label for="g_id"><b>Genre: </b></label>
  </td>
  <td>
  <div class="custom-select" style="width:200px;">
  <select id="g_id" name="g_id">
    <option value="0">Select genre</option>
    <option value="1">People</option>
    <option value="2">Nature</option>
    <option value="3">Animals</option>
	<option value="4">Characters</option>
    <option value="5">History</option>
    <option value="6">Architecture</option>
	<option value="7">Other</option>
  </select>
  </div>
  </td>
  </table>
  <hr>
  <label for="year_t"><b>Year Taken</b></label>
  <input type="text" placeholder="Enter Year" name="year_t" id="year_t">
  <?php if(isset($_POST["login"])) {
	  $user_email = $_POST["login"];
				$user_password = $_POST["psw"];
				$result = pg_query($db_connection, "SELECT * FROM users WHERE u_email='$user_email' AND u_password = '$user_password'");
				$num_r = pg_num_rows($result);
				if ($num_r <> 0) {
					$user_id_r = pg_fetch_result($result, 0, 0);
					$user_email_r = pg_fetch_result($result, 0, 2);
					$user_password_r = pg_fetch_result($result, 0, 3);
					$u_n = pg_fetch_result($result, 0, 1);
					$aur = pg_fetch_result($result, 0, 4);
					echo "<button type='submit' class='registerbtn'>Search</button>";	
					} 
  }
  ?>
  </div>
  </form>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="search.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <label for="login"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="login" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Log in</button>
      <label>
        <input type="checkbox" checked="checked" name="rememberme"> Remember me
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
	}
	else {
		navbar.classList.remove("sticky");
	}
}
</script>
<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>

</body>
</html>