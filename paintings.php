<?php
if (isset($_COOKIE["uname"])) {
}
else {
	if (isset($_POST["name"])) {
		$u_n = $_POST["name"];
		$aur = $_POST["author"];
		setcookie('uname', $u_n, time()+60*30);
		setcookie('author', $aur, time()+60*30);
	}
	else {
		if (isset($_POST["psw"])) {
		  $user_email = $_POST["email"];
		  $user_password = $_POST["psw"];
		  $db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
		  $result = pg_query($db_connection, "SELECT u_email, u_password, u_name, author FROM users WHERE u_email='$user_email'");
		  $num_r = pg_num_rows($result);
		  if ($num_r <> 0) {
			  $user_password_r = pg_fetch_result($result, 0, 1);
			  if(password_verify($user_password, $user_password_r))
			  {
			  $u_n = pg_fetch_result($result, 0, 2);
			  setcookie('uname', $u_n, time()+60*30);
			  $aur = pg_fetch_result($result, 0, 3);
			  setcookie('author', $aur, time()+60*30);
			  }
			}
		}
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
  <a class="active" href="paintings.php">Paintings</a>
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
		  'u_password' => password_hash($_POST["psw"], PASSWORD_DEFAULT),
		  'author' => $_POST["author"]
		  );
		  $db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
		  pg_insert($db_connection, 'users', $tmp);
		  echo "<a>$us_name</a><a href='paintings.php'>Log out</a>";
		  setcookie('uname', $us_name, time()+60*30);
		}
	  else {
		  $user_email = $_POST["email"];
		  $user_password = $_POST["psw"];
		  $db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
		  $result = pg_query($db_connection, "SELECT u_email, u_password, u_name FROM users WHERE u_email='$user_email'");
		  $num_r = pg_num_rows($result);
		  if ($num_r <> 0) {
			  $user_password_r = pg_fetch_result($result, 0, 1);
			  if(password_verify($user_password, $user_password_r))
			  {
			  $u_n = pg_fetch_result($result, 0, 2);
			  setcookie('uname', $u_n, time()+60*30);
			  echo "<a>$u_n</a><a href='paintings.php'>Log out</a>";
			  }
			}
			else {
				echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
				<button  onclick=window.location.href='register.html' style=width:auto;>Register</button>
				<script>alert('Wrong Email or Password')</script>";
			}
		}
	}
	else {
		if (isset($_COOKIE['uname'])) {
			$u_na = $_COOKIE['uname'];
		    echo "<a>$u_na</a><a href='paintings.php'>Log out</a>";
		  }
		  else echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
		  <button  onclick=window.location.href='register.html' style=width:auto;>Register</button>";
	}
  ?>
  </div>
</div>
</div>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="paintings.php" method="post">
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
<div class="grid-container">
<?php
$db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
$result = pg_query($db_connection, "SELECT pic_name, pic_id FROM pictures WHERE category_id = 2");
$result_1 = pg_query($db_connection, "SELECT COUNT(*) FROM pictures WHERE category_id = 2");
$result_2 = pg_query($db_connection, "SELECT u_name FROM users INNER JOIN pictures ON users.user_id = pictures.author_id WHERE category_id = 2");
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