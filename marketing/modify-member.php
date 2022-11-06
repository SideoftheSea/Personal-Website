<?php
	define('TITLE', 'Modify Marketing Staff');
	include('includes/functions.php');
	include('templates/header.html');
	
	print '<h2>Modify Marketing Staff</h2>';

	if(is_administrator()) {
		include('includes/mysqli_connect.php');
		$query = 'SELECT * FROM m_roster ORDER BY id ASC';

		if($r = mysqli_query($dbc, $query)) {
			while($row = mysqli_fetch_array($r)) {
				$projects = $row['projects'];
				switch($row['role']) {
					case 1:
						$role = 'Director of Marketing Relations';
						break;
					case 2:
						$role = 'Assistant Executive of Marketing Relations';
						break;
					case 3:
						$role = 'Marketing Strategies Manager';
						break;
					case 4:
						$role = 'Marketing Research Manager';
						break;
					case 5:
						$role = 'Marketing Strategies Staff';
						break;
					case 6:
						$role = 'Marketing Research Staff';
						break;
				}
				print '<div><b>' . $row['name'] . '</b><p style="color:purple;"><b>' . $role . '</b></p><p style="color:blue;"><i>' . $projects . ' finished projects</i></p>';
				print "<p><a href=\"edit-member.php?id={$row['id']}\">Edit Member</a> | <a href=\"remove-member.php?id={$row['id']}\">Remove Member</a></p></div><hr>";
			}
			include('templates/footer.html');
		}
	} else {
		print '<p class="text--error">ERROR:</p><p>You are not authorized to access this page.</p>';
		include('templates/footer.html');
	}
?>