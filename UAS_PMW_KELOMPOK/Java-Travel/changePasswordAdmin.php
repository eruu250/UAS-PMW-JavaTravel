<?php
include("setting.php");
session_start();
if(!isset($_SESSION['aid']))
{
	header("location:admin.php");
}
$aid=$_SESSION['aid'];
$a=mysqli_query($al, "SELECT * FROM admin WHERE aid='$aid'");
$b=mysqli_fetch_array($a);
$name=$b['name'];
$pass=$b['password'];
$old=sha1($_POST['old']);
$p1=sha1($_POST['p1']);
$p2=sha1($_POST['p2']);
if($_POST['old']==NULL || $_POST['p1']==NULL || $_POST['p2']==NULL)
{
	//ASL Do Nothing
}
else
{
if($old!=$pass)
{
	$info="Incorrect Old Password";
}
elseif($p1!=$p2)
	{
		$info="New Password Didn't Matched";
	}
	else
	{
		mysqli_query($al, "UPDATE admin SET password='$p2' WHERE aid='$aid'");
		$info="Successfully Changed your Password";
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tour &amp; Travels System</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.ashu
{
	border:1px solid #333;
	border-collapse:collapse;
		color:#FFF;
		text-shadow:1px 1px 1px #000000; 
}

</style>
</head>

<body>
<div id="header">
  <div align="center"> <span class="headingMain">Java Travel</span> </div>
</div>
<br />
<br />

<div align="center">

 <span class="subHead"><b>Ganti Kata Sandi</b><br /></span><br />
<form method="post" action="">
<table cellpadding="3" cellspacing="3" class="design" align="center">
<tr><td colspan="2" class="info" align="center"><?php echo $info;?></td></tr>
<tr><td class="labels">Kata Sandi Lama :</td><td><input type="password" name="old" size="25" class="fields" placeholder="Massukan Kata Sandi Lama" required="required" /></td></tr>
<tr><td class="labels">Kata Sandi Baru :</td><td><input type="password" name="p1" size="25" class="fields" placeholder="Masukkan Kata Sandi Baru" required="required"  /></td></tr>
<tr><td class="labels">Konfirmasi Kata Sandi :</td><td><input type="password" name="p2" size="25"  class="fields" placeholder="Konfirmasi Kata Sandi" required="required" /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Ganti " class="fields" /></td></tr>
</table>
</form>
<br />
<br />
<a href="ahome.php" class="link">HOME</a>
</div>
</body>

</html>