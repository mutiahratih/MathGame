
<?php
	session_start();
	if (empty($_SESSION['bil'])) {
		$_SESSION['bil'] = rand(1,100);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Tebak Angka</h1>

	<?php
		if (isset($_POST['submit'])) {
			if ($_POST['angka'] < $_SESSION['bil']) {
				echo "Tebakan terlalu kecil";
			} elseif ($_POST['angka'] > $_SESSION['bil']) {
				echo "Tebakan terlalu besar";
			} elseif ($_POST['angka'] = $_SESSION['bil']) {
				echo "Tebakan BENAR";
				session_destroy();
				echo "<a href='tebakAngka.php'>(Main lagi?)</a>";
				exit();
			} 
		}
	?>

	<form action="tebakAngka.php" method="post">
		Tebak angka (1-100) : <input type="text" name="angka">
		<button type="submit" name="submit">Submit</button>
	</form>

</body>
</html>


