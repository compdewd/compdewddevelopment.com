<?php
	function average_numbers($number_array)
	{		
		$total = array_sum($number_array);
		$num_items = count($number_array);
		$average = 0;
		
		if ($num_items > 0)
		{
			$average = strval(intval($total / $num_items));
		}
		
		return $average;
	}
?>