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
			    echo "<script>window.location = 'upload.php'</script>";
			}
		}
		else {
			echo "<script>alert('Wrong Email or Password')</script>";
		    echo "<script>window.location = 'upload.php'</script>";
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
if (isset($_COOKIE["author"]) == 1 and isset($_POST["upload"])) {
	      $pic_name = $_POST["p_name"];
		  $u_name = $_COOKIE["uname"];
		  $db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
		  $result = pg_query($db_connection, "SELECT * FROM users INNER JOIN pictures ON users.user_id = pictures.author_id
		  WHERE u_name = '$u_name' AND pic_name = '$pic_name'");
		  $num_r = pg_num_rows($result);
		  if ($num_r == 0 and $_POST["c_id"] <> 0 and $_POST["g_id"] <> 0 and $_POST["year_t"] > 0) {
			  $info = pathinfo($_FILES['f_to_u']['name']);
			  $ext = $info['extension']; // get the extension of the file
			  if ($ext == 'jpg') {
				  $result_1 = pg_query($db_connection, "SELECT COUNT(*) FROM pictures");
				  $coun = pg_fetch_result($result_1, 0, 0);
				  $coun++;
				  $newname = "$coun.".$ext; 
				  $target = 'images/'.$newname;
				  move_uploaded_file( $_FILES['f_to_u']['tmp_name'], $target);
				  $tmp = array(
				  'pic_name' => $_POST["p_name"],
				  'author_id' => $_COOKIE["u_id"],
				  'category_id' => $_POST["c_id"],
				  'genre_id' => $_POST["g_id"],
				  'year_taken' => $_POST["year_t"]);
				  $db_connection = pg_connect("host=localhost dbname=test user=postgres password=yo_password");
				  pg_insert($db_connection, 'pictures', $tmp);
				  echo "<script>alert('Image successfully uploaded.')</script>";
				  echo "<script>window.location = 'upload.php'</script>";
			  }
			  else {
				  echo "<script>alert('Sorry, only JPG files are allowed.')</script>";
		      }
		  }
		  else {
			  echo "<script>alert('Wrong cridentials')</script>";
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
  <a class="active" href="upload.php">Upload</a>
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
	  echo "<table><td><a>$u_na</a></td><td><form action='upload.php' method='post'><input type='hidden' id='u_status' name='u_status' value='0'><button type='submit'>Log out</button></form></td>
	  <td><button onclick=window.location.href='settings.php'>Settings</button></td></table>";
  }
  ?>
  </div>
</div>
</div>
  <form action="upload.php" method="post" enctype="multipart/form-data">
  <div class="container">
  <h3>Upload image</h3>
  <p>Please fill in this form to upload your image.</p><hr>
  <label for="p_name"><b>Name</b></label>
  <input type="text" placeholder="Enter Name" name="p_name" id="p_name">
  <input type="hidden" name="upload" id="upload" value="1">
  <hr>
  Select image to upload:
  <input type="file" name="f_to_u" id="f_to_u">
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
  <?php if($_COOKIE["login"] <> 0 and isset($_COOKIE["author"])) {
	  if ($_COOKIE["author"] == 1) {
		  echo "<button type='submit' class='registerbtn'>Upload</button>";
	  }
	  else {
		echo "<script>alert('Sorry! It looks like you don\'t have rights to to upload images.');</script>";
	  }		
    }
	else {
		echo "<script>alert('Sorry! It looks like you don\'t have rights to to upload images.');</script>";
	}
  ?>
  </div>
  <div class="container signin">
  <p>Don't have an account? <a href="register.html">Register Now</a>.</p>
  </div>
  </form>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="upload.php" method="post">
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