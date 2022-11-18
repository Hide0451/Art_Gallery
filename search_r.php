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
		  echo "<a>$us_name</a><a href='search_r.php'>Log out</a>";
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
			  echo "<a>$u_n</a><a href='search_r.php'>Log out</a>";
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
		    echo "<a>$u_na</a><a href='search_r.php'>Log out</a>";
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
  if ($_POST["p_name"] <> 0 or $_POST["a_id"] <> 0 or $_POST["c_id"] <> 0 or $_POST["g_id"] <> 0 or $_POST["year_t"] <> 0) {
	      if ($_POST["p_name"] <> 0) {
			  $pic_n = $_POST["p_name"];
		  }
		  else {
			  $pic_n = 'pic_name';
		  }
		  if ($_POST["a_id"] <> 0 and $_POST["a_id"] <> "") {
			  $s_n = $_POST["a_id"];
			  $result_ = pg_query("SELECT user_id FROM users WHERE u_name = '$s_n';");
			  $num_r = pg_num_rows($result_);
			  if ($num_r <> 0) {
				  $pic_a = pg_fetch_result($result_, 0, 0);
			  }
		  }
		  else {
			  $pic_a = 'author_id';
		  }
		  if ($_POST["c_id"] <> 0 and $_POST["c_id"] <> "") {
			  $pic_c = $_POST["c_id"];
		  }
		  else {
			  $pic_c = 'category_id';
		  }
		  if ($_POST["g_id"] <> 0 and $_POST["g_id"] <> "") {
			  $pic_g = $_POST["g_id"];
		  }
		  else {
			  $pic_g = 'genre_id';
		  }
		  if ($_POST["year_t"] <> 0 and $_POST["year_t"] <> "") {
			  $pic_y = $_POST["year_t"];
		  }
		  else {
			  $pic_y = 'year_taken';
		  }
		  $result = pg_query($db_connection, "SELECT pic_id, pic_name, u_name FROM pictures 
		  INNER JOIN users ON pictures.author_id = users.user_id WHERE pic_name LIKE '%$pic_n%' AND
		  author_id = $pic_a AND category_id = $pic_c AND genre_id = $pic_g AND year_taken = $pic_y;");
		  $num_r = pg_num_rows($result);
		  $a = 0;
		  if ($num_r <> 0) {
			  $result_1 = pg_query($db_connection, "SELECT COUNT(*) FROM pictures 
		      INNER JOIN users ON pictures.author_id = users.user_id WHERE pic_name LIKE '%$pic_n%' AND
		  author_id = $pic_a AND category_id = $pic_c AND genre_id = $pic_g AND year_taken = $pic_y;");
		  $coun = pg_fetch_result($result_1, $a, 0);
			  while($a < $coun) {
				  $val[$a] = pg_fetch_result($result, $a, 1);
				  $names[$a] = pg_fetch_result($result, $a, 2);
				  $im[$a] = pg_fetch_result($result, $a, 0);
				  $a++;
				}
			}
			else {
				echo "<script>alert('No images were found that correspond to your request')</script>";
			}
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