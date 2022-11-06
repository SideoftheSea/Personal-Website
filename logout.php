<?php define('TITLE', 'Logout'); 
	include('includes/functions.php');
	include('templates/header.html'); ?>

<h2>Log Out</h2>
<p>You have successfully logged out, 
	<?php 
		if(logged_type() == 1) { 
			print $_SESSION['user'] . '!</p><br>';
			$_SESSION = []; 
			session_destroy();
		} elseif(logged_type() == 2) { 
			print $_COOKIE['user'] . '!</p><br>';
			setcookie('user', '', time()-7200);
			setcookie('email', '', time()-7200);
			setcookie('id', '', time()-7200);
			setcookie('administrator', '', time()-7200);
			setcookie('staff', '', time()-7200);
			setcookie('loggedin', '', time()-7200);
			setcookie('staylogged', '', time()-7200);
		}

		print '<a href="a_index.php">Home Page</a>';
	?>

<?php include('templates/footer.html') ?>