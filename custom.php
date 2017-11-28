<?php
$mac = $_POST['mac'];
$custom = $_POST['custom'];
$submit = $_POST['submit'];
$mgroup = $_POST['mgroup'];

if ($submit == "Submit") {
	$fp = fopen("./machines/$mgroup/$mac/custom", 'w');
	fwrite($fp, $custom);
	fclose($fp);
} elseif ($submit == "Delete Script") {
	unlink("./machines/$mgroup/$mac/custom");
} else {
	echo "The value of \"$submit\" was unrecognized";
}
	header("Location: ./manage.php?mgroup=$mgroup");
?>
