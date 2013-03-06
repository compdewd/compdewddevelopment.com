<?php
	require_once("../../common.php");
	
	function output_as_options($result_set, $column, $current_selected)
	{
		$num_rows = $result_set->num_rows;	
		for ($i = 0; $i < $num_rows; ++$i)
		{
			$row = $result_set->fetch_assoc();
			echo "
				<option name=\"" . $row[$column] . "\"
			";
			if ($current_selected == $row[$column])
			{
				echo " selected";
			}
			echo "
				>" . $row[$column] . "</option>
			";
		}
	}
	
	function output_chipsets($current_selected)
	{
		global $dbFahTables_host, $dbFahTables_user, $dbFahTables_password, $dbFahTables_name;
		
		$connection = new mysqli($dbFahTables_host, $dbFahTables_user, $dbFahTables_password, $dbFahTables_name);
		if ($connection)
		{
			$result_set = 
				$connection->query
				("
					SELECT
						 TModels.strChipset
					FROM
						 TStatistics
							INNER JOIN
						 TChipsets
							ON TStatistics.intModelID = TChipsets.intChipsetID
					ORDER BY
							TChipsets.strChipset
				");
			output_as_options($result_set, "strChipset", $current_selected);
			
			$connection->close();
		}
	}
	
	function output_models($current_selected)
	{
		global $dbFahTables_host, $dbFahTables_user, $dbFahTables_password, $dbFahTables_name;
		
		$connection = new mysqli($dbFahTables_host, $dbFahTables_user, $dbFahTables_password, $dbFahTables_name);
		if ($connection)
		{
			$result_set = 
				$connection->query
				("
					SELECT
						 TModels.strModel
					FROM
						 TStatistics
							INNER JOIN
						 TModels
							ON TStatistics.intModelID = TModels.intModelID
					ORDER BY
							TModels.strModel
				");
			output_as_options($result_set, "strModel", $current_selected);
			
			$connection->close();
		}
	}
	
	function output_projects($current_selected)
	{
		global $dbFahTables_host, $dbFahTables_user, $dbFahTables_password, $dbFahTables_name;
		
		$connection = new mysqli($dbFahTables_host, $dbFahTables_user, $dbFahTables_password, $dbFahTables_name);
		if ($connection)
		{
			$result_set = 
				$connection->query
				("
					SELECT
						 TProjects.intProject
					FROM
						 TStatistics
							INNER JOIN
						 TProjects
							ON TStatistics.intProjectID = TProjects.intProjectID
					ORDER BY
							TProjects.intProject
				");
			output_as_options($result_set, "intProject", $current_selected);
			
			$connection->close();
		}
	}
?>