<?php

	define('TITLE', 'Register');
	include('includes/functions.php');
	include('templates/header.html');

	print '<h2>Registration Form</h2>';

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$problem = false;
		if(empty($_POST['user'])) {
			$problem = true;
			print '<p class="text--error">ERROR:</p><p>Missing username</p>';
		}
		if(empty($_POST['email'])) {
			$problem = true;
			print '<p class="text--error">ERROR:</p><p>Missing email</p>';
		}
		if(empty($_POST['password'])) {
			$problem = true;
			print '<p class="text--error">ERROR:</p><p>Missing password</p>';
		}
		if(empty($_POST['c_password'])) {
			$problem = true;
			print '<p class="text--error">ERROR:</p><p>Confirm your password</p>';
		}
		if($_POST['password'] != $_POST['c_password']) {
			$problem = true;
			print '<p class="text--error">ERROR:</p><p>Your passwords dont match</p>';
		}

		if(!$problem) {
			include('includes/mysqli_connect.php');
			$query = "SELECT * FROM users WHERE username='" . $_POST['user'] . "'";
			if($r = mysqli_query($dbc, $query)) {
				if(mysqli_num_rows($r) == 1) {
					print '<p class="text--error">ERROR:</p><p>Username already exists</p>';
					print '<form action="register.php" method="post" class="form--inline">
						<p><label for="email">Username:</label><input type="text" name="user" size="20"></p>
						<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
						<p><label for="password">Confirm Password:</label><input type="password" name="c_password" size="20"></p>
						<p><label for="email">Email Address:</label><input type="email" name="email" size="20"></p>
						<p><input type="submit" name="submit" value="Register!" class="button--pill"</p>
					</form>';
					mysqli_close($dbc);
					include('templates/footer.html');
					exit();
				}
			}
			$user = $_POST['user'];
			$pass = sha1(trim($_POST['password']));
			$email = $_POST['email'];

			$query = "INSERT INTO users (id, username, password, email) VALUES (0, '$user', '$pass', '$email')";
			if(mysqli_query($dbc, $query)) {
				print '<p class="text--success">You are now registered, ' . $_POST['user'] . '!<br><a href="a_index.php">Home Page</a> <-> <a href="login.php">Login</a>';
			} else {
				'<p class="text--error">ERROR:</p>Could not add the entry because:<br>' . mysqli_error($dbc) . '.</p><p>The query being run was: ' . $query . '</p>';
			}
			mysqli_close($dbc);
		}
	} else {
		print '<form action="register.php" method="post" class="form--inline">
					<p><label for="email">Username:</label><input type="text" name="user" size="20"></p>
					<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
					<p><label for="password">Confirm Password:</label><input type="password" name="c_password" size="20"></p>
					<p><label for="email">Email Address:</label><input type="email" name="email" size="20"></p>
					<p><input type="submit" name="submit" value="Register!" class="button--pill"</p>
				</form>';
	}

	include('templates/footer.html');
?>