<?php
ob_start();
$new_script = $_POST['new_script'];
$new_script = preg_replace("/\r\n/", "\n", $new_script); // DOS style newlines
$new_script = preg_replace("/\r/", "\n", $new_script); // Mac newlines for nostalgia
$file = $_POST['file'];
$dir = $_POST['dir'];
file_put_contents("$dir/$file", $new_script);
echo "$dir/$file";
header('Location: ./admin.php');
?>
