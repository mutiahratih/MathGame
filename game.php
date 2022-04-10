<!DOCTYPE html>
<html>
<head>
	<title>Game Penjumlahan</title>
</head>
<body>
	<h1>Penjumlahan Angka</h1>

	<?php
	if (!isset($_COOKIE['user'])) {
		// muncul form
	?>
	<form action="game.php" method="post">
		Nama : <input type="text" name="user">
		<button type="submit" name="submit">Submit</button>
	</form>
	<?php
	} else {
		if ($_POST['submit']) {
			//baca nama user
			//simpan nama user ke cookie
			// redirect to math.php?mode=play

			echo "Selamat datang". $_COOKIE['user'];
		}

	}

	setcookie($_POST['user'], $_COOKIE['user'], time()+3*30*24*60*60);
	?>

</body>
</html>