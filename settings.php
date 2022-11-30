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
	//log in
	if ($_POST["u_status"] == 2) {
		$user_email = $_POST["email"];
		$user_password = $_POST["psw"];
		$result = pg_query($db_connection, "SELECT u_email, u_password, u_name, author, user_id, u_status FROM users WHERE u_email='$user_email'");
		$num_r = pg_num_rows($result);
		if ($num_r <> 0) {
			$user_password_r = pg_fetch_result($result, 0, 1);
			$user_status = pg_fetch_result($result, 0, 5);
			if(password_verify($user_password, $user_password_r) and $user_status == 0) {
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
			else {
				echo "<script>alert('Wrong Email or Password')</script>";
			    echo "<script>window.location = 'settings.php'</script>";
			}
		}
		else {
			echo "<script>alert('Wrong Email or Password')</script>";
			echo "<script>window.location = 'settings.php'</script>";
		}
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
<a style="text-decoration:none" href="index.php" ><h2 class="example" align="center"><span lang="en">Art Gallery</span><span lang="ru">Галерея творчества</span></h2></a>
<div id="navbar">
  <a class="active" href="index.php"><span lang="en">Home</span><span lang="ru">Главная</span></a>
  <a href="paintings.php"><span lang="en">Paintings</span><span lang="ru">Картины</span></a>
  <a href="photos.php"><span lang="en">Photos</span><span lang="ru">Фотографии</span></a>
  <a href="drawings.php"><span lang="en">Drawings</span><span lang="ru">Рисунки</span></a>
  <a href="upload.php"><span lang="en">Upload</span><span lang="ru">Загрузка</span></a>
  <a href="search.php"><span lang="en">Search</span><span lang="ru">Поиск</span></a>
  <form>
    <a>
    <select id="lang-switch">
        <option value="en" selected>English</option>
        <option value="ru">Русский</option>
    </select>
	</a>
</form>
  <div class="navbar">
  <div class="log_in_and_reg">
  <?php
  if ($_COOKIE["login"] == 0) {
	  echo "<table><td><button onclick=document.getElementById('id01').style.display='block' style=width:auto;><span lang='en'>Log in</span><span lang='ru'>Войти</span></button></td>
	  <td><button  onclick=window.location.href='register.html' style=width:auto;><span lang='en'>Register</span><span lang='ru'>Регистрация</span></button></td>
	  <td><button  onclick=window.location.href='settings.php'><span lang='en'>Settings</span><span lang='ru'>Настройки</span></button></td></table>";
  }
  else {
	  $u_na = $_COOKIE["uname"];
	  echo "<table><td><a>$u_na</a></td><td><form action='settings.php' method='post'><input type='hidden' id='u_status' name='u_status' value='0'><button type='submit'><span lang='en'>Log out</span><span lang='ru'>Выйти</span></button></form></td>
	  <td><button  onclick=window.location.href='settings.php'><span lang='en'>Settings</span><span lang='ru'>Настройки</span></button></td></table>";
  }
  ?>
  </div>
</div>
</div>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="settings.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <div class="container">
      <label for="uemail"><b><span lang="en">Email</span><span lang="ru">Адрес электронной почты</span></b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="psw"><b><span lang="en">Password</span><span lang="ru">Пароль</span></b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
      <input type="hidden" id="u_status" name="u_status" value="2">
      <button type="submit"><span lang="en">Log in</span><span lang="ru">Войти</span></button>
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

<form action="index.php" method="post">
  <div class="container">
    <h1><span lang="en">Settings:</span><span lang="ru">Настройки:</span></h1>
	<?php if($_COOKIE["login"] <> 0 and isset($_COOKIE["author"])) {
	  if ($_COOKIE["author"] == 0) {
		  echo "<hr><label for='cbox'><b><span lang='en'>Author?</span><span lang='ru'>Автор?</span></b></label>
		  <input type='hidden' name='author' value='0' />
		  <input type='checkbox' placeholder='author' name='author' id='author' value='1'><hr>
		  <input type='hidden' id='up_author' name='up_author' value='1'>";
	  }	
    }
  ?>

    <button type="submit" class="registerbtn"><span lang="en">Save changes</span><span lang="ru">Сохранить изменения</span></button>
  </div>
</form>

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

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
$('[lang]').hide(); // hide all lang attributes on start.
$('[lang="en"]').show(); // show just English text 
$('#lang-switch').change(function () { // put onchange event when user select option from select
    var lang = $(this).val(); // decide which language to display using switch case
    switch (lang) {
        case 'en':
            $('[lang]').hide();
            $('[lang="en"]').show();
        break;
        case 'ru':
            $('[lang]').hide();
            $('[lang="ru"]').show();
        break;
        default:
            $('[lang]').hide();
            $('[lang="en"]').show();
        }
});
</script>

</body>
</html>