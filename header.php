<?php
/*
## Copyright (C) 2014 silverburd.com
## Copyright (C) 2014 Richard Nelson <unixabg@gmail.com>
##
## This program comes with ABSOLUTELY NO WARRANTY; for details see COPYING.
## This is free software, and you are welcome to redistribute it
## under certain conditions; see COPYING for details.
*/
?>
<!DOCTYPE html>
<html>
<script>
//if (window.location.protocol != "https:")
//    window.location.href = "https:" + window.location.href.substring(window.location.protocol.length);
</script>
<head>
	<title>LMIT</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="./jquery/jquery.js"></script>
	<script src="./jquery/edit_pop.js"></script>
	<script src="./jquery/drop_menu.js"></script>
</head>
<nav>
	<ul class="menu">
		<li><a href="index.php">View</a>
			<ul>
			<?php
			$mgroup = scandir('./machines/');
			$count = count($mgroup);
			for ($x = 0; $x < $count; $x++) {
				if ($mgroup[$x] != "." && $mgroup[$x] != "..") {
					echo "<li><a href=\"index.php?mgroup=$mgroup[$x]\">$mgroup[$x]</a></li>";
				}
			}
			?>
			</ul>
		</li>
		<li><a href="manage.php">Manage</a>
			<ul>
			<?php
			$mgroup = scandir('./machines/');
			$count = count($mgroup);
			for ($x = 0; $x < $count; $x++) {
				if ($mgroup[$x] != "." && $mgroup[$x] != "..") {
					echo "<li><a href=\"manage.php?mgroup=$mgroup[$x]\">$mgroup[$x]</a></li>";
				}
			}
			?>
			</ul>
		</li>
		<li><a href="admin.php">Administrative</a>
			<ul>
				<li><a href="admin.php?action=group">Group</a></li>
				<li><a href="admin.php">Library</a></li>
			</ul>
		</li>
	</ul>
	<ul class="search">
		<li>
			<form action="search.php" method="post">
				<input type="text" name="search" tabindex="1" autocomplete="off" placeholder="Search..">
			</form>
		</li>
	</ul>
</nav>
<?php
include "functions.php";
?>
