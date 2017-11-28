<?php
include "header.php";
$scripts = scandir('./scripts/');
$count_scripts = count($scripts);
?>
<body>
	<div id="main_text">
		<?php
		$search = $_POST['search'];
		$group = scandir("./machines/");
		$group_count = count($group);

		for ($g = 2; $g < $group_count; $g++) {
			$dir = "./machines/$group[$g]/";
			$machine_array = scandir($dir);
			$machine_count = count($machine_array);
			for ($x = 0; $x < $machine_count; $x++) {
				if ($machine_array[$x] != "." && $machine_array[$x] != "..") {
					$info_file = "./machines/$group[$g]/$machine_array[$x]/info.txt";
					$file = file_get_contents($info_file);
					if (stristr($file, $search)) {
							// Stops loop once machine matches search
							$results = "true";
							break;
					} else {
							$results = "false";
					}
				}
			}
			// Stops loop for entire group and moves to next group
			if ($results == "true") {
				break;
			}
		}
		if ($results == "true") {
			echo "<h1>Seach results for \"$search\"</h1>";
			for ($g = 2; $g < $group_count; $g++) {
					echo "<h1><a class=\"a_h1\" href=\"manage.php?mgroup=$group[$g]\">$group[$g]</a></h1>";
					echo "<table>
						<tr>
							<th>Mac Address</th>
							<th>Machine ID</th>
							<th>Description</th>";
							scan_th("./scripts/$group[$g]/");
					echo "</tr>";
					$machine_group = scandir("./machines/$group[$g]/");
					$count = count($machine_group);
				for ($x = 0; $x < $count; $x++) {
					$file = "./machines/$group[$g]/$machine_group[$x]/info.txt";
					$file_content = file_get_contents($file);
					if (stristr($file_content, $search)) {
						$array = explode("|", $file_content);
						echo "<tr>
								<td>$array[0]</td>
								<td>$array[1]</td>
								<td>$array[2]</td>";
								check_box("./machines/$group[$g]/$machine_group[$x]", "./scripts/$group[$g]");
						echo"</tr>";
					}
				}
			echo "</table>";
			}
		} else {
			echo "<p class=\"search_no\">No results found for<br />\"$search\"</p>";
		}
		?>
	</div>
<?php
include "footer.php";
?>
