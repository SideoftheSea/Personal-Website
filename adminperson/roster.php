<?php
	define('TITLE', 'Official Administrative Roster');
	include('includes/functions.php');
	include('templates/header.html');
	include('includes/mysqli_connect.php');

	$query = "SELECT * FROM ap_roster";

	if($r = mysqli_query($dbc, $query)) {
		print '<table style="border: 1px hidden;margin-left: auto;margin-right: auto;">
				<tr>
					<th style="border: 1px hidden;"><h3 style="text-align: center;">Official Administrative Roster</h3></th>
				</tr>
				<tr>';
		if(mysqli_num_rows($r) > 0) {
			while($row = mysqli_fetch_array($r))
			{
				if($row['rank'] == 1) {
					print '<td style="border:1px hidden;">';
					$name = $row['name'];
					$position = 'Community Directors';
					$s_task = $row['s_task'];
					$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $s_task . ' finished projects.</p>';
					print $string;
					print '</td>';
				}
			}
			print '</tr>';
			while($row = mysqli_fetch_array($r))
			{
				if($row['rank'] == 2) {
					print '<td style="border: 1px hidden;">';
					$name = $row['name'];
					$position = 'Executive Administrators';
					$s_task = $row['s_task'];
					$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $s_task . ' finished projects.</p>';
					print $string;
					print '</td>';
				}
			}
			print '</tr>';
			while($row = mysqli_fetch_array($r))
			{
				if($row['rank'] == 3) {
					print '<td style="border: 1px hidden;">';
					$name = $row['name'];
					$position = 'Head Administrators';
					$s_task = $row['s_task'];
					$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $s_task . ' finished projects.</p>';
					print $string;
					print '</td>';
				}
			}
			print '</tr>';
			while($row = mysqli_fetch_array($r))
			{
				if($row['rank'] == 4) {
					print '<td style="border: 1px hidden;">';
					$name = $row['name'];
					$position = 'Senior Administrators';
					$s_task = $row['s_task'];
					$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $s_task . ' finished projects.</p>';
					print $string;
					print '</td>';
				}
			}
			print '</tr>';
			while($row = mysqli_fetch_array($r))
			{
				if($row['rank'] == 5) {
					print '<td style="border: 1px hidden;">';
					$name = $row['name'];
					$position = 'General Administrators';
					$s_task = $row['s_task'];
					$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $s_task . ' finished projects.</p>';
					print $string;
					print '</td>';
				}
			}
			print '</tr>';
			while($row = mysqli_fetch_array($r))
			{
				if($row['rank'] == 6) {
					print '<td style="border: 1px hidden;">';
					$name = $row['name'];
					$position = 'Junior Administrators';
					$s_task = $row['s_task'];
					$string = '<h4 style="text-align: center;">' . $name . '</h3><h5 style="text-align: center;color: purple;">' . $position . '</h5><p style="text-align: center;color:blue;">' . $s_task . ' finished projects.</p>';
					print $string;
					print '</td>';
				}
			}
		}
		print '</tr></table>';
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