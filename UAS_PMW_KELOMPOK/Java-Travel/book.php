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
$id=$_POST['pack'];
$p=mysqli_query($al, "SELECT * FROM holiday WHERE id='$id'");
$q=mysqli_fetch_array($p);
$rate=$q['amount'];
$pack=$q['name'];
$j=$_POST['j'];
$m=$_POST['mem'];
$d=$_POST['d'];

$amount=$m*$rate;
if($id!=NULL && $j!=NULL && $m!=NULL && $d!=NULL)
{
	$sql=mysqli_query($al, "INSERT INTO bookings(email,package,members,journey,amount,date,status) VALUES('$email','$pack','$m','$j','$amount','$d','0')");
	if($sql)
	{
		$info="Ticket Berhasil Dipesan<br> Total Harganya IDR $amount Per $m penumpang  ";
	}
	else
	{
		$info="Error Mohon Coba Lagi";
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
}

</style>
</head>

<body>
<div id="header">
  <div align="center"> <span class="headingMain">Java Travel</span> </div>
</div>
<br />
<br />
<div align="center"> <span class="subHead">Pemesanan Tiket</span> <br />
  <br />
  <form method="post" action="">
 <table border="0" cellpadding="5" cellspacing="5" class="design">
 <tr><td colspan="2" align="center" class="info"><?php echo $info;?></td></tr>
 <tr><td class="labels">Rute : </td><td>
 <select name="pack" class="fields" required>
 <option value="" selected="selected" disabled="disabled"> - - Pilih Rute - -</option>
 <?php
 $x=mysqli_query($al, "SELECT * FROM holiday");
 while($y=mysqli_fetch_array($x))
 {
	 ?>
<option value="<?php echo $y['id'];?>"><?php echo "IDR ".$y['amount']. " - " .$y['name'];?></option>
<?php } ?>
</select></td></tr>
<tr><td class="labels">Pilihan Bus : </td><td>
<select name="j" class="fields" required>
<option value="" selected="selected" disabled="disabled">- - Pilih Bus - -</option>
<option value="Primajasa">Primajasa</option>
<option value="ALS">ALS</option>
<option value="NPM">NPM</option>
</select>
</td></tr>
<tr><td class="labels">Jumlah Orang : </td><td><input type="number" class="fields" size="5" placeholder="Jumlah Orang"  required="required" name="mem" /></td></tr>
<tr><td class="labels">Tanggal : </td><td><input type="date" class="fields" size="10" placeholder="DD/MM/YYY"   required="required" name="d" /></td></tr>

<tr><td colspan="2" align="center"><input type="submit" value="Pesan Sekarang" class="fields" /></td></tr>
</table> 
</form>
<br />
<br />
 

<table border="0" cellpadding="5" cellspacing="5" class="design ashu">
<tr class="labels ashu"><th class="ashu">No</th><th class="ashu">Rute</th>
<th class="ashu">Bus</th><th class="ashu">Total Harga</th><th class="ashu">Tanggal</th><th class="ashu">Status</th>
<th class="ashu">Delete</th></tr>
<?php
$u=1;
$x=mysqli_query($al, "SELECT * FROM bookings WHERE email='$email'");
while($y=mysqli_fetch_array($x))
{
	?>
<tr class="labels">
<td class="ashu"><?php echo $u;$u++;?></td>
<td class="ashu"><?php echo $y['package'];?></td>
<td class="ashu"><?php echo $y['journey'];?></td>
<td class="ashu"><?php echo "IDR ".$y['amount'];?></td>
<td class="ashu"><?php echo $y['date'];?></td><td class="ashu"><?php if($y['status']==1){echo "Approved";}else{echo "Pending";}?></td>

<td class="ashu"><a href="deleteH.php?d=<?php echo $y['id'];?>" class="link">Delete</a></td>

</td>
</tr>
<?php } ?>
</table>
<br />
<a href="home.php" class="link"><b>HOME</b></a>
</div>
</body>

</html>