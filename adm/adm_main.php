<?php
$db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
if (isset($_POST["adm_status"])) {
	//log out
	if ($_POST["adm_status"] == 0) {
		setcookie('adm_login', $_POST["adm_status"], time()+60*30);
		$_COOKIE["adm_login"] = $_POST["adm_status"];
		if (isset($_COOKIE["adm_name"])) {
			unset($_COOKIE["adm_name"]); 
			setcookie("adm_name", null, time() - 3600, '/');
		}
		if (isset($_COOKIE["adm_id"])) {
			unset($_COOKIE["adm_id"]); 
			setcookie("adm_id", null, time() - 3600, '/');
		}
	}
	//registration
	if ($_POST["adm_status"] == 1) {
		$adm_name = $_POST["name"];
		$result = pg_query($db_connection, "SELECT * FROM administrators WHERE adm_name='$adm_name'");
		$num_r = pg_num_rows($result);
		if ($num_r == 0) {
			setcookie('adm_login', $_POST["adm_status"], time()+60*30);
			$_COOKIE["adm_login"] = $_POST["adm_status"];
			setcookie('adm_name', $_POST["name"], time()+60*30);
			$_COOKIE["adm_name"] = $_POST["name"];
			$tmp = array(
			'adm_name' => $_POST["name"],
			'adm_password' => password_hash($_POST["psw"], PASSWORD_DEFAULT)
			);
			pg_insert($db_connection, 'administrators', $tmp);
			$result = pg_query($db_connection, "SELECT adm_id FROM administrators WHERE adm_name='$adm_name'");
			$adm_id = pg_fetch_result($result, 0, 0);
			setcookie('adm_id', $adm_id, time()+60*30);
			$_COOKIE["adm_id"] = $adm_id;
		}
		else {
			echo "<script>alert('The user with $adm_name already exist.')</script>";
		}
	}
	//log in
	if ($_POST["adm_status"] == 2) {
		$adm_name = $_POST["name"];
		$adm_password = $_POST["psw"];
		$result = pg_query($db_connection, "SELECT adm_name, adm_password, adm_id FROM administrators WHERE adm_name='$adm_name'");
		$num_r = pg_num_rows($result);
		if ($num_r <> 0) {
			$adm_password_r = pg_fetch_result($result, 0, 1);
			if(password_verify($adm_password, $adm_password_r)) {
				setcookie('adm_login', 1, time()+60*30);
				$_COOKIE["adm_login"] = 1;
				$adm_name = pg_fetch_result($result, 0, 0);
				setcookie('adm_name', $adm_name, time()+60*30);
				$_COOKIE["adm_name"] = $adm_name;
				$adm_id = pg_fetch_result($result, 0, 2);
				setcookie('adm_id', $adm_id, time()+60*30);
				$_COOKIE["adm_id"] = $adm_id;
			}
			else echo "<script>alert('Wrong Login or Password')</script>";
		}
		else echo "<script>alert('Wrong Login or Password')</script>";
	}
}
else {
	if (isset($_COOKIE["adm_login"])) {
	}
	else {
		setcookie('adm_login', 0, time()+60*30);
		$_COOKIE["adm_login"] = 0;
	}
}

if (isset($_POST["img_status"])) {
	// Delete image
	if ($_POST["img_status"] == 1) {
		$img_id = $_POST["img_id"];
        $d_to_d = array('pic_id' => $_POST["img_id"]);
		pg_delete($db_connection, 'pictures', $d_to_d);
		unlink("../images/$img_id.jpg");
		echo "<script>alert('Image successfully deleted.')</script>";
	}
    // Change image info
	if ($_POST["img_status"] == 2) {
		$img_id = $_POST["img_id"];
		$result = pg_query($db_connection, "SELECT pic_name, category_id, genre_id, year_taken FROM pictures WHERE pic_id = '$img_id'");
		$p_name = pg_fetch_result($result, 0, 0);
		$c_id = pg_fetch_result($result, 0, 1);
		$g_id = pg_fetch_result($result, 0, 2);
		$year_t = pg_fetch_result($result, 0, 3);
		if ($_POST["p_name"] <> "") {
		$p_name = $_POST["p_name"];	
		}
		if ($_POST["c_id"] <> "" and $_POST["c_id"] <> 0) {
		$c_id = $_POST["c_id"];
		}
		if ($_POST["g_id"] <> "" and $_POST["c_id"] <> 0) {
		$g_id = $_POST["g_id"];
		}
		if ($_POST["year_t"] <> "") {
		$year_t = $_POST["year_t"];
		}
		$d_to_u = array(
				  'pic_name' => $p_name,
				  'category_id' => $c_id,
				  'genre_id' => $g_id,
				  'year_taken' => $year_t);
        $cond = array('pic_id' => $img_id);
		pg_update($db_connection, 'pictures', $d_to_u, $cond);
		echo "<script>alert('Image info successfully changed.')</script>";
	
	}
}
if (isset($_POST["user_status"])) {
	// Delete user
	if ($_POST["user_status"] == 1) {
		$user_id = $_POST["user_id"];
		$result = pg_query("SELECT * FROM pictures WHERE author_id = $user_id;");
		$num_r = pg_num_rows($result);
		if ($num_r == 0) {
			$d_to_d = array('user_id' => $_POST["user_id"]);
			pg_delete($db_connection, 'users', $d_to_d);
			echo "<script>alert('User successfully deleted.')</script>";
		}
		else {
			echo "<script>alert('User could not be deleted.')</script>";
		}
	}
    // Change user info
	if ($_POST["user_status"] == 2) {
		$user_id = $_POST["user_id"];
		$result = pg_query($db_connection, "SELECT u_name, u_date FROM users WHERE user_id = '$user_id'");
		$u_name = pg_fetch_result($result, 0, 0);
		$u_date = pg_fetch_result($result, 0, 1);
		if ($_POST["name"] <> "") {
		$u_name = $_POST["name"];	
		}
		if ($_POST["date"] <> "") {
		$u_date = $_POST["date"];
		}
		$d_to_u = array(
				  'u_name' => $u_name,
				  'u_date' => $u_date);
        $cond = array('user_id' => $user_id);
		pg_update($db_connection, 'users', $d_to_u, $cond);
		echo "<script>alert('User info successfully changed.')</script>";
	
	}
	// Ban user
	if ($_POST["user_status"] == 3) {
		$user_id = $_POST["user_id"];
		$d_to_u = array(
				  'u_status' => 1);
        $cond = array('user_id' => $user_id);
		pg_update($db_connection, 'users', $d_to_u, $cond);
		echo "<script>alert('Banned user.')</script>";
	}
	// Unban user
	if ($_POST["user_status"] == 4) {
		$user_id = $_POST["user_id"];
		$d_to_u = array(
				  'u_status' => 0);
        $cond = array('user_id' => $user_id);
		pg_update($db_connection, 'users', $d_to_u, $cond);
		echo "<script>alert('Unbanned user.')</script>";
	}
}
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../g_styles.css">
</head>
<body>
<a style="text-decoration:none" href="adm_main.php" ><h2 class="example" align="center">Art Gallery</h2></a>
<div id="navbar">
  <a class="active" href="adm_main.php">Home</a>
  <a href="in_users.php">Search in users</a>
  <a href="in_pictures.php">Search in pictures</a>
  <div class="navbar">
  <div class="log_in_and_reg">
  <?php
  if ($_COOKIE["adm_login"] == 0) {
	  echo "<script>window.location = 'adm_page.html'</script>";
  }
  else {
	  $u_na = $_COOKIE["adm_name"];
	  echo "<table><td><a>$u_na</a></td><td><form action='adm_page.html' method='post'><input type='hidden' id='adm_status' name='adm_status' value='0'><button type='submit'>Log out</button></form></td></table>";
  }
  ?>
  </div>
</div>
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
</body>
</html>