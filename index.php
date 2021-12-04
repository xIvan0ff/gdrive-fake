<?php 
	if (isset($_GET['file'])) {
		echo(file_get_contents("index_temp.html"));
	} else {
		echo(file_get_contents("index_empty.html"));
	}

?>
