<?php

	define('TITLE', 'Login');
	include('includes/functions.php');
	include('templates/header.html');

	print '<h2>Login Form</h2>';

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if((!empty($_POST['user'])) && (!empty($_POST['password']))) {
			include('includes/mysqli_connect.php');

			$query = "SELECT * FROM users WHERE username='" . $_POST['user'] . "'";

			if($r = mysqli_query($dbc, $query))
			{
				if(mysqli_num_rows($r) == 1)
				{
					$row = mysqli_fetch_array($r);
					if(($row['password'] == sha1(trim($_POST['password'])))) 
					{
						if(isset($_POST['staylogged'])) {
							setcookie('user', $_POST['user'], time()+7200);
							setcookie('email', $row['email'], time()+7200);
							setcookie('id', $row['id'], time()+7200);
							setcookie('administrator', $row['administrator'], time()+7200);
							setcookie('staff', $row['staff'], time()+7200);
							setcookie('loggedin', time(), time()+7200);
							setcookie('staylogged', $_POST['staylogged'], time()+7200);
						} else {
							$_SESSION['user'] = $_POST['user'];
							$_SESSION['email'] = $row['email'];
							$_SESSION['id'] = $row['id'];
							$_SESSION['administrator'] = $row['administrator'];
							$_SESSION['staff'] = $row['staff'];
							$_SESSION['loggedin'] = time();
						}

						print '<p>You are now logged in, ' . $_POST['user'] . '!</p>';
						
						print '<a href="a_index.php">Home Page</a>';
					} else {
						print '<p class="text--error">ERROR:</p><p> Invalid username or password.</p>';
						print '<form action="login.php" method="post" class="form--inline">
							<p><label for="email">Username:</label><input type="text" name="user" size="20"></p>
							<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
							<p>Stay Logged In: <input type="checkbox" name="staylogged"></p>
							<p><input type="submit" name="submit" value="Log In!" class="button--pill"></p>
						</form>';
					}
				} else {
					print '<p class="text--error">ERROR:</p><p> Invalid username or password.</p>';
					print '<form action="login.php" method="post" class="form--inline">
							<p><label for="email">Username:</label><input type="text" name="user" size="20"></p>
							<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
							<p>Stay Logged In: <input type="checkbox" name="staylogged"></p>
							<p><input type="submit" name="submit" value="Log In!" class="button--pill"></p>
						</form>';
				}
			}
			mysqli_close($dbc);
		} else {
			print '<p class="text--error">ERROR:</p><p> Missing field</p>';
			print '<form action="login.php" method="post" class="form--inline">
					<p><label for="email">Username:</label><input type="text" name="user" size="20"></p>
					<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
					<p>Stay Logged In: <input type="checkbox" name="staylogged"></p>
					<p><input type="submit" name="submit" value="Log In!" class="button--pill"></p>
				</form>';
		}
	} else {
		if(isset($_SESSION['id']) || isset($_COOKIE['staylogged'])) {
			print '<p class="text--error">ERROR:</p><p>You are already logged in.</p>';
		} else {
			print '<form action="login.php" method="post" class="form--inline">
					<p><label for="email">Username:</label><input type="text" name="user" size="20"></p>
					<p><label for="password">Password:</label><input type="password" name="password" size="20"></p>
					<p>Stay Logged In: <input type="checkbox" name="staylogged"></p>
					<p><input type="submit" name="submit" value="Log In!" class="button--pill"></p>
				</form>';
		}
	}

	include('templates/footer.html'); 
	?>