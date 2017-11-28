<?php
include "header.php";
echo "<script src=\"./jquery/checkall.js\"></script>
<script src=\"./jquery/code_pop.js\"></script>
<script src=\"./jquery/new_script.js\"></script>
<script src=\"./jquery/tabs.js\"></script>";
status();
if (!empty($_POST['tab'])) {
	$tab = $_POST['tab'];
	echo "<div class=\"test\" tabIndex=\"$tab\"></div>";
} else {
	echo "<div class=\"test\" tabIndex=\"1\"></div>";
}
?>
<body>
	<div id="main_text">
		<div id="script_pannel">
			<h3 class="pannel_head">Admin<br />Groups</h3>
			<ul>
				<li class="admin_li"><a class="admin_a" href="#new_group" tabIndex="0">New Group</a></li>
				<?php
				$group = scandir("./machines/");
				$count = count($group);
				for ($g = 0; $g < $count; $g++) {
					if ($group[$g] != "." && $group[$g] != "..") {
						echo "<li class=\"admin_li\"><a class=\"admin_a\" href=\"#$group[$g]\" tabIndex=\"$g\">$group[$g]</a></li>";
					}
				}
				?>
			</ul>
		</div>
		<div id="new_group" class="tabs">
			<div id="library">
				<h1>New Group</h1>
				<form action="group_changes.php" method="POST">
					<input type="text" name="group_name" placeholder="New Group Name">
					<input type="submit" name="submit" value="New Group">
				</form>
			</div>
		</div>
		<?php
		// scan machines folder for groups
		$group = scandir("./machines/");
		$group_count = count($group);
		// $x represents the array number for each group in library
		for ($g = 0; $g < $group_count; $g++) {
			$tab = $g;
			if ($group[$g] != "." && $group[$g] != "..") {
				echo "<div id=\"$group[$g]\" class=\"tabs\">
						<div id=\"library\">
							<h1>$group[$g]</h1>
							<form action=\"group_changes.php\" method=\"POST\">
								<input type=\"hidden\" name=\"old_group\" value=\"$group[$g]\">
								<input type=\"hidden\" name=\"tab\" value=\"$tab\">
								<table>
									<tr>
										<th class=\"check_th\"><input type=\"checkbox\" class=\"checkall\"></th>
										<th>Mac Address</th>
										<th>Machine Id</th>
										<th>Description</th>
									</tr>";
				// scan group folder in library to populate all possible scripts
				$machine = scandir("./machines/$group[$g]/");
				$machine_count = count($machine);
				for ($m = 0; $m < $machine_count; $m++) {
					if ($machine[$m] != "." && $machine[$m] != "..") {
						$info_txt = file("./machines/$group[$g]/$machine[$m]/info.txt");
						$info = explode("|", $info_txt[0]);
						echo "<tr>";
						echo "<td class=\"td_center\"><input type=\"checkbox\" name=\"$machine[$m]\" value=\"$machine[$m]\" class=\"checkbox1\" rowid=\"check[$g]\"></td>
								<td>$info[0]</td>
								<td>$info[1]</td>
								<td>$info[2]</td>
							</tr>";
					}
				}
				echo "</table>
						<select name=\"new_group\" class=\"left\">
							<option value=\"\">New Group</option>";
							$option = scandir("./machines/");
							for ($o = 0; $o < $group_count; $o++) {
								if ($option[$o] != "." && $option[$o] != "..") {
									echo "<option value=\"$option[$o]\">$option[$o]</option>";
								}
							}
						echo "</select>
						<input class=\"delete_group\" type=\"submit\" name=\"submit\" value=\"Delete Group\">
						<input class=\"left\" type=\"submit\" name=\"submit\" value=\"Move Machines\">
					</form>
				</div>
			</div>";
			// end of if statment that excludes . and ..
			}
		// end of library group scan
		}
		?>
<?php
include "footer.php";
?>
