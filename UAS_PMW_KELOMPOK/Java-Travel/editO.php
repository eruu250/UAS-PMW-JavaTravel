<?php
include("setting.php");
session_start();
if(!isset($_SESSION['aid'])) {
    header("location:admin.php");
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $booking_query = mysqli_query($al, "SELECT * FROM bookings WHERE id='$id'");
    $booking_data = mysqli_fetch_array($booking_query);
} else {
    // Redirect if id is not provided
    header("location:orders.php");
}

// Proses edit booking
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $package = $_POST['package'];
    $journey = $_POST['journey'];
    $amount = $_POST['amount'];
    $members = $_POST['members'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    // Validasi input

    // Perbarui data di database
    $update_query = mysqli_query($al, "UPDATE bookings SET email='$email', package='$package', journey='$journey', amount='$amount', members='$members', date='$date', status='$status' WHERE id='$id'");
    if($update_query) {
        header("location:orders.php");
    } else {
        $error_message = "Gagal menyunting data pemesanan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pesanan</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="header">
        <div align="center">
            <span class="headingMain">Java Travel</span>
        </div>
    </div>
    <div align="center">
        </br> <span class="subHead"><b>Edit Pesanan</b></span><br /> <br />
        <form method="post" action="">
            <table cellpadding="5" cellspacing="5" class="design">
                <tr><td colspan="2" class="info" align="center"><?php echo isset($error_message) ? $error_message : ''; ?></td></tr>
                <tr><td class="labels">E-mail:</td><td><input type="text" name="email" value="<?php echo $booking_data['email']; ?>" class="fields"></td></tr>
                <tr><td class="labels">Rute Perjalanan:</td><td><input type="text" name="package" value="<?php echo $booking_data['package']; ?>" class="fields"></td></tr>
                <tr><td class="labels">BUS:</td><td><input type="text" name="journey" value="<?php echo $booking_data['journey']; ?>" class="fields"></td></tr>
                <tr><td class="labels">Harga:</td><td><input type="text" name="amount" value="<?php echo $booking_data['amount']; ?>" class="fields"></td></tr>
                <tr><td class="labels">Jumlah Penumpang:</td><td><input type="text" name="members" value="<?php echo $booking_data['members']; ?>" class="fields"></td></tr>
                <tr><td class="labels">Tanggal:</td><td><input type="text" name="date" value="<?php echo $booking_data['date']; ?>" class="fields"></td></tr>
                <tr><td class="labels">Status:</td><td>
                    <select name="status" class="fields">
                        <option value="0" <?php if($booking_data['status'] == 0) echo "selected"; ?>>Belum Disetujui</option>
                        <option value="1" <?php if($booking_data['status'] == 1) echo "selected"; ?>>Disetujui</option>
                    </select>
                </td></tr>
                <tr><td colspan="2" align="center">
                        <button type="submit" class="fields">Simpan Perubahan</button>
                    </td>
                </tr>
            </table>
			</br>
			</br>
			<a href="orders.php" class="fields">Kembali</a>
        </form>
    </div>
</body>
</html>
