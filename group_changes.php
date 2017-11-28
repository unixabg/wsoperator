<?php
$submit = $_POST["submit"];
$old_group = $_POST["old_group"];
$tab = $_POST['tab'];
if ($submit == "Move Machines") {
	if (!empty($_POST['new_group'])) {
		$new_group = $_POST["new_group"];
		$file = scandir("./machines/$old_group/");
		foreach ($file as $mac) {
			if (isset($_POST[$mac])) {
				$mac = $_POST["$mac"];
				mkdir("./machines/$new_group/$mac/");
				copy("./machines/$old_group/$mac/info.txt", "./machines/$new_group/$mac/info.txt");
				$files = scandir("./machines/$old_group/$mac/");
				foreach ($files as $file) {
					unlink("./machines/$old_group/$mac/$file");
				}
				rmdir("./machines/$old_group/$mac/");
				$status = "Machines(s) successfully moved to $new_group.|green";
			}
		}
	} else {
		$status = "New group was not selected.|red";
	}
} elseif ($submit == "New Group") {
	$new_group = $_POST['group_name'];
	$new_group = str_replace(" ", "_", $new_group);
	if (!preg_match("/[^-A-Za-z0-9._ ]/", $new_group)) {
		mkdir("./machines/$new_group/");
		mkdir("./scripts/$new_group/");
		$status = "$new_group successfully created.|green";
	} else {
		$status = "Invalid Character on Group Name.|red";
	}
} elseif ($submit == "Delete Group") {
	if (count(scandir("./machines/$old_group/")) > 2 || count(scandir("./scripts/$old_group/")) > 2) {
		$status = "Group still contains file(s). Please go back and move or delete file(s).|red";
	} else {
		rmdir("./machines/$old_group/");
		rmdir("./scripts/$old_group/");
		$status = "$old_group successfully deleted.|green";
	}
} else {
	$status = "Action was not recognized \"$submit\".|red";
}
echo "<form id=\"form\" action=\"group.php\" method=\"POST\">
	<input type=\"hidden\" name=\"status\" value=\"$status\">
	<input type=\"hidden\" name=\"tab\" value=\"$tab\">
	</form>
	<script>document.getElementById(\"form\").submit();</script>";
?>
