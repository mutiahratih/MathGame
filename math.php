<?php
$_SESSION['start']

?>


<!DOCTYPE html>
<html>
<head>
	<title>Math Game</title>
</head>
<body>
	<h1>Welcome to Math Game</h1>

	<?php
		if (!isset($_COOKIE['username'])){
			// tampilkan form input nama user
	?>
		<form action="game.php" method="post">
			Nama : <input type="text" name="username">
			<button type="submit" name="submitname">Submit</button>
		</form>
	<?php

			if (isset($_POST['submitname'])){
				// baca nama user dari form 
				$username = $_POST['username'];
				// simpan nama user ke cookie
				setcookie('username', $username, time()+3*30*24*60*60);
				// redirect to math.php?mode=start
				header("location:math.php?mode=start");
			}

		} else {

			if ($_GET['mode']=="play"){

				if (isset($_POST['submitans'])){
					// cek jawaban user
					// jika jawaban benar -> score +10
					// jika jawaban salah -> score -2
					//                    -> lives -1

					if ($_POST['hasil'] == $_SESSION['hasil']) {
						$_SESSION['score'] += 10;
					} else {
						$_SESSION['score'] -= 2;
						$_SESSION['lives'] -= 1;
					}
					// update score, lives di session
					// redirect to math.php?mode=play
					header("location:math.php?mode=play");
				}

				 else if ($_SESSION['lives'] > 0) {
					// muncul pertanyaan
					$bil1 = rand(0,10);
					$bil2 = rand(0,10);
					$_SESSION['hasil'] = $bil1+$bil2;

					// cetak skor dan lives
					echo "score: ". $_SESSION['score']. " | lives: ". $_SESSION['lives'];
				?>
					<form method="post" action="math.php?mode=play">
				<?php
					echo $bil1. " + ". $bil2. " = ";
				?>
					<input type="text" name="hasil">
					<input type="submit" name="submitans">
					</form>

				<?php
				} else {
					// simpan data score ke db
					$conn = mysqli_connect($host, $user, $password, $db);

					$sql = "INSERT INTO score (username, score, tgl) VALUES ('".$_COOKIE['username']."','')";


					// cetak game over
					echo "Game Over<br>";
					// munculkan link: Main lagi -> mode=start | Hall of Fame -> mode=halloffame
					echo "<a href='math.php?mode=start'>Main lagi</a> | <a href='math.php?mode=halloffame'></a>";
				}

				
			}

			if ($_GET['mode']=="start"){
				// set score -> 0
				$_SESSION['score'] = 0;
				// set lives -> 3
				$_SESSION['lives'] = 3;
				// simpan score dan lives ke session
				// redirect to math.php?mode=play
				header("location:math.php?mode=play");
			}

			if ($_GET['mode']=="halloffame"){
				// tampilkan data score dari db sort by score limit 10
			}
		}
	?>
</body>
</html>