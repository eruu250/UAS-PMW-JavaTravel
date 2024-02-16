<?php
include("setting.php");
session_start();
if(!isset($_SESSION['aid'])) {
    header("location:admin.php");
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $holiday_query = mysqli_query($al, "SELECT * FROM holiday WHERE id='$id'");
    $holiday_data = mysqli_fetch_array($holiday_query);
} else {
    // Redirect if id is not provided
    header("location:holiday.php");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $amount = $_POST['amount'];


    $update_query = mysqli_query($al, "UPDATE holiday SET name='$name', amount='$amount' WHERE id='$id'");
    if($update_query) {
        header("location:holiday.php");
    } else {
        $error_message = "Gagal menyunting data rute perjalanan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Rute Perjalanan</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="header">
        <div align="center">
            <span class="headingMain">Java Travel</span>
        </div>
    </div>
    <div align="center">
        </br> <span class="subHead">Edit Rute Perjalanan</span><br /> <br />
        <form method="post" action="">
            <table cellpadding="5" cellspacing="5" class="design">
                <tr><td colspan="2" class="info" align="center"><?php echo isset($error_message) ? $error_message : ''; ?></td></tr>
                <tr><td class="labels">Lokasi Keberangkatan:</td><td><input type="text" name="name" value="<?php echo $holiday_data['name']; ?>" class="fields"></td></tr>
                <tr><td class="labels">Harga:</td><td><input type="text" name="amount" value="<?php echo $holiday_data['amount']; ?>" class="fields"></td></tr>
                <tr><td colspan="2" align="center">
                        <button type="submit" class="fields">Simpan Perubahan</button>
                    </td>
                </tr>
            </table>
			</br>
			</br>
			<a href="holiday.php" class="fields">Kembali</a>
        </form>
    </div>
</body>
</html>
