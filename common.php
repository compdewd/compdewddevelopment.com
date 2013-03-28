<?php
    require_once("error_handler.php");
    require_once("database_connect.php");
	require_once("create_head.php");
	require_once("create_space.php");
    require_once("create_header.php");
    require_once("create_footer.php");
	
	function return_refs($array)
	{
		$ref_array = array();
		foreach ($array as $array_key => $array_element)
		{
			$ref_array[$array_key] = &$array[$array_key];
		}
		return $ref_array;
	}
?>
    