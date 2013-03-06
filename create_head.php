<?php
	function create_head($title, $path_to_stylesheet)
	{
		echo "
			<!--
				By: Patrick Rebsch
			-->
			
			<meta charset=\"utf-8\">
			<title>" . $title . "</title>
			<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $path_to_stylesheet . "\">
		";
	}
?>