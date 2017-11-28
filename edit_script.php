<?php
$file = $_POST['file'];
$new_script = $_POST['script'];
$new_script = preg_replace("/\r\n/", "\n", $new_script); // DOS style newlines
$new_script = preg_replace("/\r/", "\n", $new_script); // Mac newlines for nostalgia
$submit = $_POST['submit'];
$machine = scandir("./machines/$mgroup/");
$count_machines = count($machine);
if ($submit == "Submit") {
	file_put_contents("./library/$file", $new_script);
} else {
	unlink("./library/$file");
	if (is_link("./scripts/$mgroup/$file")) {
		unlink("./scripts/$mgroup/$file");
	}
	for ($x = 0; $x < $count_machines; $x++) {
		if ($machine[$x] != "." && $machine[$x] != "..") {
			if (is_link("./machines/$mgroup/$machine[$x]/$file")) {
				unlink("./machines/$mgroup/$machine[$x]/$file");
			}
		}
	}
}
header('Location: ./admin.php');
?>
