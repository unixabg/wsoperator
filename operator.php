<?php
if(!empty($_GET['mac'])) {
	#FIXME Sanitize
	#Unify mac format to use : and not -
	$mac = preg_replace('/-/',':',strtolower($_GET['mac']));
	#other_info is utility token for log info
	if (isset($_GET['other_info'])) {
		$other_info = filter_var($_GET['other_info'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	}
	$groups = scandir("./machines/");
	$count_groups = count($groups);
	$machine_sentry = 1;
	for ($x = 0; $x < $count_groups; $x++) {
		if ($groups[$x] != "." && $groups[$x] != "..") {
			if (is_dir("./machines/$groups[$x]/$mac")) {
				// Machine found toggle sentry.
				$machine_sentry = 0;
				$group_match = $groups[$x];
				//echo $group_match;
				$mac_scripts = scandir("./machines/$group_match/$mac");
				$count_scripts = count($mac_scripts);
				//echo $count_scripts;
				// Define scripts before we start appending values.
				$scripts = "";
				for ($i = 0; $i < $count_scripts; $i++) {
					if ($mac_scripts[$i] != "." && $mac_scripts[$i] != "..") {
						if ($mac_scripts[$i] != "info.txt" && $mac_scripts[$i] != "log.txt") {
							// Send the script name back to requester machine
							echo "$group_match/$mac/$mac_scripts[$i] ";
							$scripts .= " $mac_scripts[$i]";
						}
					}
				}
				$log = "./machines/$group_match/$mac/log.txt";
				if (!is_file($log)) {
					touch($log);
				}
				file_put_contents($log, "[".date("Y-m-d H:i:s")."]\tscripts: $scripts\n", FILE_APPEND);
				if (isset($other_info)) {
					file_put_contents($log, "[".date("Y-m-d H:i:s")."]\tscripts: $other_info\n", FILE_APPEND);
				}
				$linecount = count(file($log));
				if ($linecount > 250) {
					$file = file($log);
					unset($file[0]);
					file_put_contents($log, $file);
				}
			}
		}
	}
	// If machine_sentry has a value of 1, then machine was not found.
	if ($machine_sentry == "1") {
		// Test for enrollment structure for unknown workstations.
		if (!is_dir("./machines/Enroll")) {
			mkdir("./machines/Enroll");
		}
		if (!is_dir("./scripts/Enroll")) {
			mkdir("./scripts/Enroll");
		}
		mkdir("./machines/Enroll/$mac");
		file_put_contents("./machines/Enroll/$mac/info.txt", "$mac|FIXME|Auto Enroll");
	}
}
?>
