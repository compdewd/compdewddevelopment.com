<?php
	require_once("../../common.php");

	$connection = new mysqli($dbFahTables_host, $dbFahTables_user, $dbFahTables_password, $dbFahTables_name);
	if ($connection)
	{
		$connection->query("TRUNCATE TABLE TProjects");
		
		$psummary = file_get_contents("http://fah-web.stanford.edu/psummary.html");
		$psummary_columns = 12;
		$psummary_column_project_id = 0;
		$psummary_column_final_deadline = 5;
		$psummary_column_base_points = 6;
		$psummary_column_k_factor = 11;
		
		// Shrink the size of $psummary
		$table_index_beg = strpos($psummary, "<table>");
		$table_index_end = strpos($psummary, "</table>");
		$psummary = substr($psummary, $table_index_beg, $table_index_end - $table_index_beg);
		
		$tr_syntax_beg = "<tr ";
		$td_syntax_beg = "<td>";
		$td_syntax_end = "</td>";
		$project_data = array($psummary_columns);
		while (strpos($psummary, $tr_syntax_beg) > -1 && strpos($psummary, $td_syntax_beg) > -1)
		{
			$pos_current_field = 0;
			while ($pos_current_field < $psummary_columns)
			{
				$pos_td_syntax_beg = strpos($psummary, $td_syntax_beg);
				$pos_td_syntax_end = strpos($psummary, $td_syntax_end, $pos_td_syntax_beg);
				$len_field = $pos_td_syntax_end - ($pos_td_syntax_beg + strlen($td_syntax_beg));
				$pos_field_beg = $pos_td_syntax_beg + strlen($td_syntax_beg);
				$content_field = substr($psummary, $pos_field_beg, $len_field);
				$project_data[$pos_current_field] = $content_field;
				$psummary = substr($psummary, $pos_td_syntax_end);
				++$pos_current_field;
			}
			
			$project_id = intval($project_data[$psummary_column_project_id]);
			$final_deadline = floatval($project_data[$psummary_column_final_deadline]);
			$base_points = intval($project_data[$psummary_column_base_points]);
			$k_factor = floatval($project_data[$psummary_column_k_factor]);
			$statement = $connection->prepare("INSERT INTO TProjects VALUES (?,?,?,?);");
			$statement->bind_param("iidd", $project_id, $base_points, $final_deadline, $k_factor);
			$statement->execute();
		}
		
		echo "Project Update Completed Successfully.";
		
		$connection->close();
	}
?>