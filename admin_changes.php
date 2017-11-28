<?php
$mgroup = $_POST['mgroup'];
$dir = "./library/";
$library = scandir($dir);
$count = count($library);
$submit = $_POST['submit'];
$tab = $_POST['tab'];
if ($submit == 'Submit') {
	for ($x = 0; $x < $count; $x++) {
		if ($library[$x] != "." && $library[$x] != "..") {
			$post = $_POST[$library[$x]];
			if (isset($post)) {
				// Step up two dirs from anticipated symlink target since we added groups.
				if (!is_link("./scripts/$mgroup/$library[$x]")) {
					symlink("../../library/$library[$x]", "./scripts/$mgroup/$library[$x]");
				}
				$enable_all = $_POST["$library[$x]enable_all"];
				if (isset($enable_all)) {
					$machine = scandir("./machines/$mgroup/");
					$machine_count = count($machine);
					for ($m = 0; $m < $machine_count; $m++) {
						if ($machine[$m] != "." && $machine[$m] != "..") {
							if (!is_link("./machines/$mgroup/$machine[$m]/$library[$x]")) {
								symlink("../../../scripts/$mgroup/$library[$x]", "./machines/$mgroup/$machine[$m]/$library[$x]");
							}
						}
					}
				}
			} elseif ($post != "1") {
				unlink("./scripts/$mgroup/$library[$x]");
				$machine = scandir("./machines/$mgroup/");
				$machine_count = count($machine);
				for ($m = 0; $m < $machine_count; $m++) {
					if ($machine[$m] != "." && $machine[$m] != "..") {
						unlink("./machines/$mgroup/$machine[$m]/$library[$x]");
					}
				}
			}
		}
	}
	$status = "Modified scripts in $mgroup.|green";
} elseif ($submit == 'Submit Changes') {
	$edit_file = $_POST['edit_file'];
	$edit_script = $_POST['edit_script'];
	$edit_script = preg_replace("/\r\n/", "\n", $edit_script); // DOS style newlines
	$edit_script = preg_replace("/\r/", "\n", $edit_script); // Mac newlines for nostalgia
	$machine = scandir("./machines/$mgroup/");
	$count_machines = count($machine);
	file_put_contents("./library/$edit_file", $edit_script);
	$status = "Script successfully updated.|green";
} elseif ($submit == 'Delete Script') {
	$machine = scandir("./machines/$mgroup/");
	$count_machines = count($machine);
	$edit_file = $_POST['edit_file'];
	unlink("./scripts/$mgroup/$edit_file");
	unlink("./library/$edit_file");
	for ($x = 0; $x < $count_machines; $x++) {
		if ($machine[$x] != "." && $machine[$x] != "..") {
			if (is_link("./machines/$mgroup/$machine[$x]/$edit_file")) {
				unlink("./machines/$mgroup/$machine[$x]/$edit_file");
			}
		}
	}
	$status = "Script successfully deleted.|green";
} else {
	$status = "Action was not recognized \"$submit\".|red";
}
echo "<form id=\"form\" action=\"admin.php\" method=\"POST\">
	<input type=\"hidden\" name=\"status\" value=\"$status\">
	<input type=\"hidden\" name=\"tab\" value=\"$tab\">
	</form>
	<script>document.getElementById(\"form\").submit();</script>";
	// echo "<a href=\"admin.php\">Back</a>";
?>
