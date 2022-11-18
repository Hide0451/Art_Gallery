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
			  <button  onclick=window.location.href='register.html' style=width:auto;>Register</button>
			  <script>alert('Image successfully uploaded.')</script>";
		    }
		  else {
			  echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
			  <button  onclick=window.location.href='register.html' style=width:auto;>Register</button>
			  <script>alert('The author with the name you entered does not exist or he does not have rights')</script>";
		    }
    }
	else {
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
		  echo "<a>$us_name</a><a href='search.php'>Log out</a>";
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
			  echo "<a>$u_n</a><a href='search.php'>Log out</a>";
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
		    echo "<a>$u_na</a><a href='search.php'>Log out</a>";
		  }
		  else echo "<button onclick=document.getElementById('id01').style.display='block' style=width:auto;>Log in</button>
		  <button  onclick=window.location.href='register.html' style=width:auto;>Register</button>";
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
  <?php if(isset($_POST["email"]) or isset($_COOKIE["uname"])) {
	  if(isset($_POST["email"])) {
		  $user_email = $_POST["email"];
		  $user_password = $_POST["psw"];
		  $result = pg_query($db_connection, "SELECT * FROM users WHERE u_email='$user_email' AND u_password = '$user_password'");
		  $num_r = pg_num_rows($result);
		  if ($num_r <> 0) {
			  $user_id_r = pg_fetch_result($result, 0, 0);
			  $user_email_r = pg_fetch_result($result, 0, 2);
			  $user_password_r = pg_fetch_result($result, 0, 3);
			  $u_n = pg_fetch_result($result, 0, 1);
			  $aur = pg_fetch_result($result, 0, 4);
		    }
	    }
		echo "<button type='submit' class='registerbtn'>Search</button>";	 
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
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

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