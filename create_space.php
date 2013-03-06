<?php
	function create_vertical_space($measurement)
	{
		echo "
			<div style=\"height:" . $measurement . ";\"></div>
		";
	}
	
	function create_horizontal_space($measurement)
	{
		echo "
			<div style=\"width:" . $measurement . ";\"></div>
		";
	}
?>