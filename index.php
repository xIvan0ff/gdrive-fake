<?php
if (isset($_GET['file'])) {
	echo (file_get_contents("randomstringbroidk/index_real.html"));
} else {
	echo (file_get_contents("randomstringbroidk/index_illusion.html"));
}
