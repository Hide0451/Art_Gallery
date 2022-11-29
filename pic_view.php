<?php
$db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
setcookie('pic_tmp_id', 0, time()+60*30);
if (isset($_POST["u_status"])) {
	//log out
	if ($_POST["u_status"] == 0) {
		setcookie('login', $_POST["u_status"], time()+60*30);
		$_COOKIE["login"] = $_POST["u_status"];
		if (isset($_COOKIE["uname"])) {
			unset($_COOKIE["uname"]); 
			setcookie("uname", null, time() - 3600, '/');
		}
		if (isset($_COOKIE["author"])) {
			unset($_COOKIE["author"]); 
			setcookie("author", null, time() - 3600, '/');
		}
		if (isset($_COOKIE["u_id"])) {
			unset($_COOKIE["u_id"]); 
			setcookie("u_id", null, time() - 3600, '/');
		}
	}
	//log in
	if ($_POST["u_status"] == 2) {
		$user_email = $_POST["email"];
		$user_password = $_POST["psw"];
		$result = pg_query($db_connection, "SELECT u_email, u_password, u_name, author, user_id FROM users WHERE u_email='$user_email'");
		$num_r = pg_num_rows($result);
		if ($num_r <> 0) {
			$user_password_r = pg_fetch_result($result, 0, 1);
			if(password_verify($user_password, $user_password_r)) {
				setcookie('login', 1, time()+60*30);
				$_COOKIE["login"] = 1;
				$uname = pg_fetch_result($result, 0, 2);
				setcookie('uname', $uname, time()+60*30);
				$_COOKIE["uname"] = $uname;
				$author = pg_fetch_result($result, 0, 3);
				setcookie('author', $author, time()+60*30);
				$_COOKIE["author"] = $author;
				$user_id = pg_fetch_result($result, 0, 4);
				setcookie('u_id', $user_id, time()+60*30);
				$_COOKIE["u_id"] = $user_id;
			}
			else echo "<script>alert('Wrong Email or Password')</script>";
		}
		else echo "<script>alert('Wrong Email or Password')</script>";
	}
}
else {
	if (isset($_COOKIE["login"])) {
	}
	else {
		setcookie('login', 0, time()+60*30);
		$_COOKIE["login"] = 0;
	}
}
?>
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
  <a href="upload.php">Upload</a>
  <a href="search.php">Search</a>
  <div class="navbar">
  <div class="log_in_and_reg">
  <?php
  if ($_COOKIE["login"] == 0) {
	  echo "<table><td><button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button></td>
	  <td><button  onclick=window.location.href='register.html' style=width:auto;>Register</button></td>
	  <td><button  onclick=window.location.href='settings.php'>Settings</button></td></table>";
  }
  else {
	  $u_na = $_COOKIE["uname"];
	  echo "<table><td><a>$u_na</a></td><td><form action='index.php' method='post'><input type='hidden' id='u_status' name='u_status' value='0'><button type='submit'>Log out</button></form></td>
	  <td><button  onclick=window.location.href='settings.php'>Settings</button></td></table>";
  }
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
      <input type="hidden" id="u_status" name="u_status" value="2">
      <button type="submit">Log in</button>
    </div>
  </form>
</div>


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

<div class="grid-container">
<?php
$sel_pic_id = $_POST["sel_pic_id"];
$db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
$result = pg_query($db_connection, "SELECT pic_name, u_name, category_name, genre_name, year_taken, date_posted FROM pictures
INNER JOIN genre ON pictures.genre_id = genre.genre_id INNER JOIN category ON pictures.category_id = category.category_id
INNER JOIN users ON pictures.author_id = users.user_id WHERE pic_id = $sel_pic_id");
$pic_name = pg_fetch_result($result, 0, 0);
$u_name = pg_fetch_result($result, 0, 1);
$category = pg_fetch_result($result, 0, 2);
$genre = pg_fetch_result($result, 0, 3);
$year_t = pg_fetch_result($result, 0, 4);
$date_posted = pg_fetch_result($result, 0, 5);
echo "<table><tr><td><img src='images/$sel_pic_id.jpg' height='350px' width='100%' border='1px' alt='' /></td></tr><tr><td><p class='ncol' align='center'>$pic_name</p></td></tr></table>";
echo "<table> <tr><td><p class='ncol'>Author: $u_name</p></td></tr><hr>";
echo "<tr><td><p class='ncol'>Category: $category</p></td></tr>";
echo "<tr><td><p class='ncol'>Genre: $genre</p></td></tr>";
echo "<tr><td><p class='ncol'>Year: $year_t</p></td></tr>";
echo "<tr><td><p class='ncol'>Date posted: $date_posted</p></td></tr></table>";
?>
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
</body>
</html>