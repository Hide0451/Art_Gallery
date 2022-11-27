<?php
$db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
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
	//registration
	if ($_POST["u_status"] == 1) {
		$user_email = $_POST["email"];
		$result = pg_query($db_connection, "SELECT * FROM users WHERE u_email='$user_email'");
		$num_r = pg_num_rows($result);
		if ($num_r == 0) {
			setcookie('login', $_POST["u_status"], time()+60*30);
			$_COOKIE["login"] = $_POST["u_status"];
			setcookie('uname', $_POST["name"], time()+60*30);
			$_COOKIE["uname"] = $_POST["name"];
			setcookie('author', $_POST["author"], time()+60*30);
			$_COOKIE["author"] = $_POST["author"];
			$tmp = array(
			'u_name' => $_POST["name"],
			'u_email' => $_POST["email"],
			'u_password' => password_hash($_POST["psw"], PASSWORD_DEFAULT),
			'author' => $_POST["author"]
			);
			$user_email = $_POST["email"];
			pg_insert($db_connection, 'users', $tmp);
			$result = pg_query($db_connection, "SELECT user_id FROM users WHERE u_email='$user_email'");
			$user_id = pg_fetch_result($result, 0, 0);
			setcookie('u_id', $user_id, time()+60*30);
			$_COOKIE["u_id"] = $user_id;
		}
		else {
			echo "<script>alert('Wrong Email')</script>";
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
  <a href="index.php">Home</a>
  <a href="paintings.php">Paintings</a>
  <a class="active" href="photos.php">Photos</a>
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
	  echo "<table><td><a>$u_na</a></td><td><form action='photos.php' method='post'><input type='hidden' id='u_status' name='u_status' value='0'><button type='submit'>Log out</button></form></td>
	  <td><button  onclick=window.location.href='settings.php'>Settings</button></td></table>";
  }
  ?>
  </div>
</div>
</div>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="photos.php" method="post">
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
$db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
$result = pg_query($db_connection, "SELECT pic_name, pic_id FROM pictures WHERE category_id = 1");
$result_1 = pg_query($db_connection, "SELECT COUNT(*) FROM pictures WHERE category_id = 1");
$result_2 = pg_query($db_connection, "SELECT u_name FROM users INNER JOIN pictures ON users.user_id = pictures.author_id WHERE category_id = 1");
$a = 0;
$coun = pg_fetch_result($result_1, $a, 0);
$start_num = pg_fetch_result($result, $a, 1);
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
  
  document.write('<div class="grid-item" id="' + k[i] + '"><form action="pic_view.php" method="post"><input type="hidden" id="sel_pic_id" name="sel_pic_id" value="' + k[i] + '"><button type="submit" class="expand" id="' + k[i] + '"><img src="images/' + k[i] + '.jpg" height="190px" width="90%" border="1px" alt="" /><div class="overlay"><p class="ncol">' + arr[i] + ' ' + 'by ' + a_name[i] + '</p></div></button></form></div>');
  i++;
}
</script>
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