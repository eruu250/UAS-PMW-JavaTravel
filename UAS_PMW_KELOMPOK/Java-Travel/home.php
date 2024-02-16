<?php
include("setting.php");
session_start();
if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
$email=$_SESSION['email'];
$a=mysqli_query($al, "SELECT * FROM customers WHERE email='$email'");
$b=mysqli_fetch_array($a);
$name=$b['name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tour &amp; Travels System</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="header">
  <div align="center"> <span class="headingMain">Java Travel</span> </div>
</div>
<br />
<br />
<div align="center"> <span class="subHead">Selamat Datang 
  <br />
  <?php echo $name;?></span> <br />
  <br />
  <table border="0">
<tr><td><a href="book.php" class="cmd">♦ Pemesanan Tiket</a></td><td><a href="changePassword.php" class="cmd">♦ Ganti Kata Sandi</a></td></tr>
<tr><td colspan="2" align="center"><a href="logout.php" class="cmd">♦ Logout</a>
</table>
</div>
</body>
</html>