<?php
	function create_header($primary_heading, $secondary_heading)
	{
		create_vertical_space("20px");
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
		create_vertical_space("20px");
	}
?>
