<!--  this is the login page --> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>login</title>
<!-- linking the page to stylesheet.css -->
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!-- sending data to processlogin.php -->
<form action="processlogin.php" method="POST">
  <div id="loginbox" align="center">
  <!-- input box for username and password -->
  <h2>Login  </h2>
  <h3>Username:  <input type="text" name="uname" /></h3>
  <h3>password:
    <input type="password" name="pword" />
  </h3>
  <!-- button for submitting the form -->
  <h2><input type="image" onClick="submit();" src="loginbutton.png" /></h2>
  </div>
</form>
</body>
</html>