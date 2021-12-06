<?php
$domain = $_SERVER['SERVER_NAME'];
if (isset($_GET['file']) or substr($domain, 0, 6) === "google") {
	echo (file_get_contents("randomstringbroidk/index_real.html"));
} else {
	echo (file_get_contents("randomstringbroidk/index_illusion.html"));
}
