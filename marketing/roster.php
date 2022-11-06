<?php
	define('TITLE', 'Marketing Relations Official Roster');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	$query = "SELECT * FROM m_roster";

	if($r = mysqli_query($dbc, $query)) {
		if(mysqli_num_rows($r) > 0) {
			print '<table style="border: 1px hidden;margin-left: auto;margin-right: auto;">
					<tr>
						<th style="border: 1px hidden;"><h3 style="text-align: center;">Official Marketing Relations Roster</h3></th>
					</tr>
					<tr>
						<td style="border: 1px hidden;">';
			while($row = mysqli_fetch_array($r))
			{
				if($row['role'] == 1) {
					$name = $row['name'];
					$position = 'Director of Marketing Relations';
					$projects = $row['projects'];
					$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $projects . ' finished projects.</p>';
					print $string;
					break;
				}
			}
			print 		'</td>
					<tr>
						
						<td style="border: 1px hidden;">';
		}
	}
	if($r = mysqli_query($dbc, $query)) {
		if(mysqli_num_rows($r) > 0) {
			while($row = mysqli_fetch_array($r))
			{
				if($row['role'] == 2) {
					$name = $row['name'];
					$position = 'Assistant Executive of Marketing Relations';
					$projects = $row['projects'];
					$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $projects . ' finished projects.</p>';
					print $string;
					break;
				} //else { print $row['name'] . '|'; continue; }
			}
			print 		'</td></tr></table>';

			print '<div style="display:flex;margin-left:-5px;margin-right:-5px;">';

			$query = "SELECT * FROM m_roster WHERE role=3";
			if($r = mysqli_query($dbc, $query)) {
				if(mysqli_num_rows($r) > 0)
				{							
					print '<div style="flex:50%;padding:5px;">';
					print '<table style="border: 1px hidden;margin-right:auto;">';
					while($row = mysqli_fetch_array($r)) {
						print '<tr>
									<td style="border: 1px hidden;">';
						$name = $row['name'];
						$position = 'Marketing Strategies Manager';
						$projects = $row['projects'];
						$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $projects . ' finished projects.</p>';
						print $string;
						print '</td></tr>';
					}
					print '</table>';
					print '</div>';
				}
			}

			$query = "SELECT * FROM m_roster WHERE role=4";
			if($r = mysqli_query($dbc, $query)) {
				if(mysqli_num_rows($r) > 0)
				{							
					print '<div style="flex:50%;padding:5px;">';
					print '<table style="border: 1px hidden;margin-left:auto;">';
					while($row = mysqli_fetch_array($r)) {
						print '<tr>
									<td style="border: 1px hidden;">';
						$name = $row['name'];
						$position = 'Marketing Research Manager';
						$projects = $row['projects'];
						$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $projects . ' finished projects.</p>';
						print $string;
						print '</td></tr>';
					}
					print '</table>';
					print '</div>';
				}
			}

			print '</div>';
			print '<div style="display:flex;margin-left:-5px;margin-right:-5px;">';

			$query = "SELECT * FROM m_roster WHERE role=5";
			if($r = mysqli_query($dbc, $query)) {
				if(mysqli_num_rows($r) > 0)
				{							
					print '<div style="flex:50%;padding:5px;">';
					print '<table style="border: 1px hidden;margin-right:auto;">';
					while($row = mysqli_fetch_array($r)) {
						print '<tr>
									<td style="border: 1px hidden;">';
						$name = $row['name'];
						$position = 'Marketing Strategies Staff';
						$projects = $row['projects'];
						$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $projects . ' finished projects.</p>';
						print $string;
						print '</td></tr>';
					}
					print '</table>';
					print '</div>';
				}
			}

			$query = "SELECT * FROM m_roster WHERE role= 6";
			if($r = mysqli_query($dbc, $query)) {
				if(mysqli_num_rows($r) > 0) {
					print '<div style="flex:50%;padding:5px;">';
					print '<table style="border: 1px hidden;margin-left:auto;">';
					while($row = mysqli_fetch_array($r)) {
						print '<tr>
									<td style="border: 1px hidden;">';
						$name = $row['name'];
						$position = 'Marketing Research Staff';
						$projects = $row['projects'];
						$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $projects . ' finished projects.</p>';
						print $string;
						print '</td></tr>';
					}
					print '</table>';
					print '</div>';
				}
			}

			print '</div>';
		}
	}

	if(is_administrator()) {
		print '<hr><form action="add-member.php" method="post" class="form--inline">
				<input type="submit" name="submit" value="Add Member" class="button--pill">
				</form>
				<form action="modify-member.php" method="post" class="form--inline">
				<input type="submit" name="response" value="Modify Member" class="button--pill">
				</form>';
	}

	include('templates/footer.html');
?>