<?php
	function create_header($primary_heading, $secondary_heading)
	{
		echo "
			<div id=\"header\">
				<h1> 
					" . $primary_heading . "
				</h1>
				<h3>
					" . $secondary_heading . "
				</h3>
			</div>
		";
	}
?>
