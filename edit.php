<?php
include "header.php";
?>
<body>
	<div id="main_text">
		<h1>Edit Machine</h1>
		<?php
		$mgroup = $_POST['mgroup'];
		$scripts = scandir("./scripts/$mgroup/");
		$count_scripts = count($scripts);

		$mac = strtolower($_POST['mac']);
		$id = strtoupper($_POST['id']);
		$description = $_POST['description'];
		$custom = isset($_POST['custom']) ? $_POST['custom'] : '';
		$submit = $_POST['submit'];
		$file = $_POST['file'];
		if ($submit == "Edit") {
			if (!preg_match('/^(?:[0-9a-fA-F]{2}[:;.]?){6}$/', $mac)) {
				echo "<h2><font color=\"red\">Invalid Mac address</font></h2>";
			} else {
				echo "<form action=\"save_changes.php\" method=\"POST\">
						<div id=\"text_input\">
						<input type=\"hidden\" name=\"mgroup\" value=\"$mgroup\">
						<input type=\"hidden\" name=\"old_mac\" value=\"$mac\">
						Mac:<input class=\"input_mac\" type=\"text\" name=\"mac_edit\" maxlength=\"17\" value=\"$mac\">
						ID:<input class=\"input_id\" type=\"text\" name=\"id_edit\" value=\"$id\">
						Description:<input type=\"text\" name=\"description_edit\" value=\"$description\"></div>";
				echo "<div id=\"checkbox_script\">";
				for ($x = 0; $x < $count_scripts; $x++) {
					if ($scripts[$x] != "." && $scripts[$x] != "..") {
						if(is_link("./machines/$mgroup/$mac/".$scripts[$x])) {
							echo $scripts[$x].":<input type='checkbox' name='".$scripts[$x]."' value='1' checked>";
						} elseif ($scripts[$x] == 'custom') {
							echo "<button class='custom'>Custom</button>";
						} else {
							echo $scripts[$x].":<input type='checkbox' name='".$scripts[$x]."' value='1'>";
						}
					}
				}
				echo "</div>";
				echo "<input type=\"hidden\" name=\"file\" value=\"$file/info.txt\">
						<input class='save' type=\"submit\" name='submit' value=\"Save\">
			</form>";
			}
		} elseif ($submit =="X") {
			$dir = scandir($file);
			$count = count($dir);
			echo $count;
			echo "<br />";
			echo "$file/$dir[2]";
			echo "<br />";
			for ($i = 0; $i < $count; $i++) {
				if ($dir[$i] != "." && $dir[$i] != "..") {
					echo $dir[$i];
					if(!unlink("$file/".$dir[$i])) {
						echo "Couldn't delete file.";
					} else {
						unlink("$file/$dir[$i]");
					}
				}
			}
			if(!rmdir($file)) {
				echo "Couldn't delete dir";
			} else {
				header('Location: ./manage.php');
			}
		}
		if (is_file("./machines/$mgroup/$mac/custom")) {
			$custom = file_get_contents("./machines/$mgroup/$mac/custom");
		}
	echo "</div>
	<div id=\"edit_wrap\">
		<div class=\"edit\">
			<h1 class=\"custom_h1\">Custom Script</h1>
			<form action=\"custom.php\" method=\"POST\">
					<input type=\"hidden\" name=\"mac\" value=\"$mac\">
					<input type=\"hidden\" name=\"mgroup\" value=\"$mgroup\">
					<textarea name=\"custom\" rows=\"24\" cols=\"83\">$custom</textarea>
					<input class=\"submit\" type=\"submit\" name=\"submit\" value=\"Submit\">
					<input class=\"delete\" type=\"submit\" name=\"submit\" value=\"Delete Script\">
					<button class='cancel'>Cancel</button>
			</form>
		</div>";
include "footer.php";
?>
