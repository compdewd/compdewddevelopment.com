<?php
	require_once("../../common.php");
	
	function create_column_width($column, $width)
	{
		echo "." . $column . " { ";
		echo "min-width:" . $width . "; ";
		echo "max-width:" . $width . "; ";
		echo "width:" . $width . ";";
		echo " } ";
	}
	
	function create_filter_option($option_id, $option_value, $option_label)
	{
		echo 
			"<input type=\"checkbox\" name=\"" .
			$option_id . 
			"\" id=\"" . 
			$option_id . 
			"\" value=\"" .
			$option_value .
			"\""
		;
		if (isset($_GET[$option_id]) && $_GET[$option_id] == $option_value)
		{
			echo " checked";
		}
		echo 
			">
			<span class=\"label\" onClick=\"toggleElement('" .
			$option_id .
			"')\">" .
			$option_label .
			"</span>"
		;
	}
	
	function output_as_options($result_set, $column, $current_selected)
	{
		$num_rows = $result_set->num_rows;
		for ($i = 0; $i < $num_rows; ++$i)
		{
			$row = $result_set->fetch_assoc();
			echo "
				<option name=\"" . $row[$column] . "\"
			";
			if (isset($current_selected) && $current_selected == $row[$column])
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
		$var_array_dbGpuStatistics = get_vars_dbGpuStatistics();
		
		$connection = 
			new mysqli
			(
				 $var_array_dbGpuStatistics['host']
				,$var_array_dbGpuStatistics['user']
				,$var_array_dbGpuStatistics['password']
				,$var_array_dbGpuStatistics['name']
			);
		if ($connection)
		{
			$result_set = 
				$connection->query
				("
					SELECT DISTINCT
						TChipsets.strChipset
					FROM
							TGpuStatistics
						INNER JOIN
							TModels
						ON 
							TGpuStatistics.intModelID = TModels.intModelID
						INNER JOIN
							TChipsets
						ON TModels.intChipsetID = TChipsets.intChipsetID
					ORDER BY
						TChipsets.strChipset DESC
				");
			output_as_options($result_set, "strChipset", $current_selected);
			
			$connection->close();
		}
	}
	
	function output_models($current_selected)
	{
		$var_array_dbGpuStatistics = get_vars_dbGpuStatistics();
		
		$connection = 
			new mysqli
			(
				 $var_array_dbGpuStatistics['host']
				,$var_array_dbGpuStatistics['user']
				,$var_array_dbGpuStatistics['password']
				,$var_array_dbGpuStatistics['name']
			);
		if ($connection)
		{
			$result_set = 
				$connection->query
				("
					SELECT DISTINCT
						 TModels.strModel
					FROM
							TGpuStatistics
						INNER JOIN
							TModels
						ON
							TGpuStatistics.intModelID = TModels.intModelID
					ORDER BY
						TModels.intSortOrder ASC
				");
			output_as_options($result_set, "strModel", $current_selected);
			
			$connection->close();
		}
	}
	
	function output_projects($current_selected)
	{
		$var_array_dbGpuStatistics = get_vars_dbGpuStatistics();
		
		$connection = 
			new mysqli
			(
				 $var_array_dbGpuStatistics['host']
				,$var_array_dbGpuStatistics['user']
				,$var_array_dbGpuStatistics['password']
				,$var_array_dbGpuStatistics['name']
			);
		if ($connection)
		{
			$result_set = 
				$connection->query
				("
					SELECT DISTINCT
						 TProjects.intProject
					FROM
							TGpuStatistics
						INNER JOIN
							TProjects
						ON 
							TGpuStatistics.intProjectID = TProjects.intProjectID
					ORDER BY
						TProjects.intProject ASC
				");
			output_as_options($result_set, "intProject", $current_selected);
			
			$connection->close();
		}
	}
	
	function output_viewing_option($request_var, $output_var)
	{
		echo "
			<input type=\"checkbox\" name=\"" . $request_var . "\" id=\"" . $request_var . "\" value=\"false\"
		";
		if (isset($_GET[$request_var]) && $_GET[$request_var] == "false")
		{
			echo " checked";
		}
		echo "
			>
			<span class=\"label\" onClick=\"toggleElement('" . $request_var . "')\">
				Do Not Show \"" . $output_var . "\"
			</span>
			<br>
		";
	}
	
	function output_additional_option($request_var, $output_var)
	{
		echo "
			<input type=\"checkbox\" name=\"" . $request_var . "\" id=\"" . $request_var . "\" value=\"true\"
		";
		if (isset($_GET[$request_var]) && $_GET[$request_var] == "true")
		{
			echo " checked";
		}
		echo "
			>
			<span class=\"label\" onClick=\"toggleElement('" . $request_var . "')\">
				" . $output_var . "
			</span>
			<br>
		";
	}
	
	function get_view_array($get_vars)
	{
		$view_array = 
			array
			(	
				 "gpu_statistics_id"	=> true
				,"chipset"				=> true
				,"model"				=> true
				,"project"				=> true
				,"time_per_frame"		=> true
				,"points_per_day"		=> true
				,"overclocked" 			=> true
				,"core_clock_speed" 	=> true
				,"shader_clock_speed" 	=> true
				,"memory_clock_speed" 	=> true
				,"driver_version" 		=> true
				,"core" 				=> true
				,"core_version" 		=> true
				,"information_source" 	=> true
				,"date_submitted" 		=> true
			);
		
		if ((isset($get_vars['viewOverclocked']) && $get_vars['viewOverclocked'] == "false") || (isset($get_vars['show']) && $get_vars['show'] == "summary"))
			$view_array['overclocked'] = false;
			
		if ((isset($get_vars['viewCoreClockSpeed']) && $get_vars['viewCoreClockSpeed'] == "false") || (isset($get_vars['show']) && $get_vars['show'] == "summary"))
			$view_array['core_clock_speed'] = false;
		
		if ((isset($get_vars['viewShaderClockSpeed']) && $get_vars['viewShaderClockSpeed'] == "false") || (isset($get_vars['show']) && $get_vars['show'] == "summary"))
			$view_array['shader_clock_speed'] = false;
			
		if ((isset($get_vars['viewMemoryClockSpeed']) && $get_vars['viewMemoryClockSpeed'] == "false") || (isset($get_vars['show']) && $get_vars['show'] == "summary"))
			$view_array['memory_clock_speed'] = false;
			
		if ((isset($get_vars['viewDriverVersion']) && $get_vars['viewDriverVersion'] == "false") || (isset($get_vars['show']) && $get_vars['show'] == "summary"))
			$view_array['driver_version'] = false;
			
		if ((isset($get_vars['viewFahCore']) && $get_vars['viewFahCore'] == "false") || (isset($get_vars['show']) && $get_vars['show'] == "summary"))
			$view_array['core'] = false;
		
		if ((isset($get_vars['viewFahCoreVersion']) && $get_vars['viewFahCoreVersion'] == "false") || (isset($get_vars['show']) && $get_vars['show'] == "summary"))
			$view_array['core_version'] = false;
			
		if ((isset($get_vars['viewInfoSource']) && $get_vars['viewInfoSource'] == "false") || (isset($get_vars['show']) && $get_vars['show'] == "summary"))
			$view_array['information_source'] = false;
			
		if ((isset($get_vars['viewDateSubmitted']) && $get_vars['viewDateSubmitted'] == "false") || (isset($get_vars['show']) && $get_vars['show'] == "summary"))
			$view_array['date_submitted'] = false;
			
		return $view_array;
	}
	
	function output_table_header_all($get_vars)
	{
		echo 
			"
				<table cellspacing=\"0\" id=\"stats_table_header\">
					<tr>
						<th class=\"column_record_link\"><div></div></th>
						<th class=\"column_chipset\">GPU Chipset</th>
						<th class=\"column_model\">GPU Model</th>
						<th class=\"column_project\">Project</th>
						<th class=\"column_time_per_frame\">TPF</th>
						<th class=\"column_points_per_day\">PPD</th>
			";
		
		$view_array = get_view_array($get_vars);
		
		if (isset($view_array['overclocked']) && $view_array['overclocked'] == true)
		{
			echo "<th class=\"column_overclocked\">Overlocked?</th>";
		}
		if (isset($view_array['core_clock_speed']) && $view_array['core_clock_speed'] == true)
		{
			echo "<th class=\"column_core_clock_speed\">Core Clock Speed</th>";
		}
		if (isset($view_array['shader_clock_speed']) && $view_array['shader_clock_speed'] == true)
		{
			echo "<th class=\"column_shader_clock_speed\">Shader Clock Speed</th>";
		}
		if (isset($view_array['memory_clock_speed']) && $view_array['memory_clock_speed'] == true)
		{
			echo "<th class=\"column_memory_clock_speed\">Memory Clock Speed</th>";
		}
		if (isset($view_array['driver_version']) && $view_array['driver_version'] == true)
		{
			echo "<th class=\"column_driver_version\">Driver Version</th>";
		}
		if (isset($view_array['core']) && $view_array['core'] == true)
		{
			echo "<th class=\"column_core\">FAH Core</th>";
		}
		if (isset($view_array['core_version']) && $view_array['core_version'] == true)
		{
			echo "<th class=\"column_core_version\">FAH Core Version</th>";
		}
		if (isset($view_array['information_source']) && $view_array['information_source'] == true)
		{
			echo "<th class=\"column_information_source\">Information Source</th>";
		}
		if (isset($view_array['date_submitted']) && $view_array['date_submitted'] == true)
		{
			echo "<th class=\"column_date_submitted\">Date Submitted</th>";
		}
		
		echo 
			"
					</tr>
				</table>
			";
	}
	
	function output_table_header_summary()
	{
		echo 
			"
				<table cellspacing=\"0\" id=\"stats_table_header\">
					<tr>
						<th class=\"column_chipset\">GPU Chipset</th>
						<th class=\"column_model\">GPU Model</th>
						<th class=\"column_project\">Project</th>
						<th class=\"column_time_per_frame\">Average TPF</th>
						<th class=\"column_points_per_day\">Average PPD</th>
					</tr>
				</table>
			";
	}
	
	function output_table_header($get_vars)
	{
		if (isset($get_vars['show']) && $get_vars['show'] != "")
		{
			if ($get_vars['show'] == "summary")
			{
				output_table_header_summary();
			}
			else
			{
				output_table_header_all($get_vars);
			}
		}
		else
		{
			output_table_header_all($get_vars);
		}
	}
	
	function calculate_points_per_day($time_per_frame, $project_info)
	{
		$completion_days = $time_per_frame / 864.0;
		$bonus_factor = 
			($project_info['decKFactor'] == 0) ? 1 : sqrt($project_info['decFinalDeadline'] / $project_info['decKFactor'] * $completion_days);
		$bonus_factor = max(1, $bonus_factor);
		return $bonus_factor * $project_info['decBasePoints'] / $completion_days;
	}
	
	function sort_by_ppd($result_set)
	{
		$ppd_array = array();
		$sorted_result_set = array();
		for ($i = 0; $i < count($result_set); ++$i)
		{
			$key = strval($i);
			$ppd_array[$key] = $result_set[$i]['points_per_day'];
			arsort($ppd_array);
		}
		reset($ppd_array);
		for ($i = 0; $i < count($ppd_array); ++$i)
		{
			$j = intval(key($ppd_array));
			$sorted_result_set[$i] = $result_set[$j];
			next($ppd_array);
		}
		
		return $sorted_result_set;
	}
	
	function get_stats($get_vars, $view_array, $where_clause, $variable_array, $order_by_clause, $bind_param_types, $connection)
	{
		$gpu_statistics_id = "gpu_statistics_id";
		$chipset = "chipset";
		$model = "model";
		$project = "project";
		$time_per_frame = "time_per_frame";
		$points_per_day = "points_per_day";
		$overclocked = "overclocked";
		$core_clock_speed = "core_clock_speed";
		$shader_clock_speed = "shader_clock_speed";
		$memory_clock_speed = "memory_clock_speed";
		$driver_version = "driver_version";
		$core = "core";
		$core_version = "core_version";
		$information_source = "information_source";
		$date_submitted = "date_submitted";
		
		$intGpuStatisticsID = "TGpuStatistics.intGpuStatisticsID AS intGpuStatisticsID";
		$strChipset = "TChipsets.strChipset AS strChipset";
		$strModel = "TModels.strModel AS strModel";
		$intProject = "TProjects.intProject AS intProject";
		$intTimePerFrame = "TGpuStatistics.intTimePerFrame AS intTimePerFrame";
		$intPointsPerDay = "TGpuStatistics.intPointsPerDay AS intPointsPerDay";
		$chrOverclockChoiceAbbreviation = "TOverclockChoices.chrOverclockChoiceAbbreviation AS chrOverclockChoiceAbbreviation";
		$intCoreClockSpeed = "TGpuStatistics.intCoreClockSpeed AS intCoreClockSpeed";
		$intShaderClockSpeed = "TGpuStatistics.intShaderClockSpeed AS intShaderClockSpeed";
		$intMemoryClockSpeed = "TGpuStatistics.intMemoryClockSpeed AS intMemoryClockSpeed";
		$strDriverVersion = "TDriverVersions.strDriverVersion AS strDriverVersion";
		$strCore = "TCores.strCore AS strCore";
		$strCoreVersion = "TCoreVersions.strCoreVersion AS strCoreVersion";
		$strInformationSource = "TInformationSources.strInformationSource AS strInformationSource";
		$dteDateSubmitted = "TGpuStatistics.dteDateSubmitted AS dteDateSubmitted";
		
		if (isset($get_vars['show']) && $get_vars['show'] == "summary")
		{
			$okay = true;
			$result_set = array();
			$result_set_row = 0;
			$chipset_set = false;
			$model_set = false;
			$bind_param_eval = "";
			$prepared_query =
				"
					SELECT
						 TModels.intModelID			AS intModelID
						,TModels.strModel			AS strModel
						,TChipsets.intChipsetID		AS intChipsetID
						,TChipsets.strChipset		AS strChipset
					FROM
						TModels
						INNER JOIN
							TChipsets
						ON
							TModels.intChipsetID = TChipsets.intChipsetID
				";
			if (isset($get_vars['filterByChipset']) && $get_vars['filterByChipset'] == "true")
			{
				if (isset($get_vars['chipset']) && $get_vars['chipset'] != "")
				{
					$chipset_set = true;
				}
			}
			if (isset($get_vars['filterByModel']) && $get_vars['filterByModel'] == "true")
			{
				if (isset($get_vars['model']) && $get_vars['model'] != "")
				{
					$model_set = true;
				}
			}
			if ($chipset_set == true || $model_set == true)
			{
				$bind_param_eval = "\$statement->bind_param(\"";
				$prepared_query .= " WHERE ";
				if ($chipset_set == true)
				{
					$prepared_query .= " TChipsets.strChipset = ? ";
					$bind_param_eval .= "s";
					if ($model_set == true)
					{
						$prepared_query .= " AND ";
					}
				}
				if ($model_set == true)
				{
					$prepared_query .= " TModels.strModel = ? ";
					$bind_param_eval .= "s";
				}
				$bind_param_eval .= "\", ";
				if ($chipset_set == true)
				{
					$bind_param_eval .= "\$get_vars['chipset']";
					if ($model_set == true)
					{
						$bind_param_eval .= ", ";
					}
				}
				if ($model_set == true)
				{
					$bind_param_eval .= "\$get_vars['model']";
				}
				$bind_param_eval .= ");";
			}
			$prepared_query .=
				"
					ORDER BY
						TModels.intSortOrder	ASC
					;
				";
			$statement = $connection->prepare($prepared_query);
			eval($bind_param_eval);
			$statement->execute();
			$statement->store_result();
			$model_chipset_row = array();
			$statement->
				bind_result
				(
					 $model_id
					,$model
					,$chipset_id
					,$chipset
				);
			
			for ($i = 0; $i < $statement->num_rows; ++$i)
			{
				$statement->fetch();
				$query =
					"
						SELECT DISTINCT
							intProjectID
						FROM
							TGpuStatistics
						WHERE
							intModelID = '$model_id'
					";
				if (isset($get_vars['filterByProject']) && $get_vars['filterByProject'] == "true")
				{
					if (isset($get_vars['project']) && $get_vars['project'] != "")
					{
						$query .= " AND intProjectID = ";
						$get_vars_project = intval($get_vars['project']);
						$project_id_query = 
							"
								SELECT
									intProjectID
								FROM
									TProjects
								WHERE
									intProject = '$get_vars_project'
							";
						if 
						(
								(isset($get_vars['showOnlyAssignedProjects']) && $get_vars['showOnlyAssignedProjects'] == "true")
							||
								(isset($get_vars['showOnlyActiveProjects']) && $get_vars['showOnlyActiveProjects'] == "true")
						)
						{
							$project_id_query .=
								"
									AND blnCurrentlyAssigned = TRUE
								";
						}
						$project_id_query .=
							"
								LIMIT
									1
								;
							";
						$project_id_result_set = $connection->query($project_id_query);
						$project_id_row = $project_id_result_set->fetch_assoc();
						$query .= " '" . $project_id_row['intProjectID'] . "' ";
					}
				}
				$query .=
					"
						;
					";
				$project_result_set = $connection->query($query);
				for ($j = 0; $j < $project_result_set->num_rows; ++$j)
				{
					$project_row = $project_result_set->fetch_assoc();
					$project_id = $project_row['intProjectID'];
					$project_info_result_set =
						$connection->query
						("
							SELECT 
								 intProject
								,decBasePoints
								,decFinalDeadline
								,decKFactor
							FROM
								TProjects
							WHERE
								intProjectID = '$project_id'
							;
						");
					$project_info_row = $project_info_result_set->fetch_assoc();
					$project_info_row_project = $project_info_row['intProject'];
					$tpf_result_set =
						$connection->query
						("
							SELECT
								intTimePerFrame
							FROM
								TGpuStatistics
							WHERE
									intProjectID 	= 	'$project_id'
								AND	intModelID		=	'$model_id'
							;
						");
					$tpf_total = 0;
					for ($k = 0; $k < $tpf_result_set->num_rows; ++$k)
					{
						$tpf_row = $tpf_result_set->fetch_assoc();
						$tpf_total += intval($tpf_row['intTimePerFrame']);
					}
					$tpf_average = round($tpf_total / $tpf_result_set->num_rows);
					$ppd_average = round(calculate_points_per_day($tpf_average, $project_info_row));
					
					if (count($result_set) > 0 && $j > 0)
					{
						if (isset($get_vars['sortByPpd']) && $get_vars['sortByPpd'] == "true")
						{
							$chipset = $chipset;
							$model = $model;
						}
						else
						{
							$chipset = "";
							$model = "";
						}
					}
					
					if (isset($get_vars['filterByPpd']) && $get_vars['filterByPpd'] == "true")
					{
						if (isset($get_vars['ppdFrom']) && $get_vars['ppdFrom'] != "")
						{
							$ppdFrom = intval($get_vars['ppdFrom']);
							$ppdTo = 0;
							if (isset($get_vars['ppdTo']) && $get_vars['ppdTo'] != "")
							{
								$ppdTo = intval($get_vars['ppdTo']);
							}
							if ($ppd_average >= $ppdFrom)
							{
								if ($ppdTo == 0)
								{
									$okay = $okay;
								}
								else if ($ppd_average <= $ppdTo)
								{
									$okay = $okay;
								}
								else
								{
									$okay = false;
								}
							}
						}
						else
						{
							$okay = $okay;
						}
					}
					else
					{
						$okay = $okay;
					}
					
					if ($tpf_average == "" || $tpf_average == 0)
						$okay = false;
					else if ($ppd_average == "" || $ppd_average == 0)
						$okay = false;
					
					if ($okay == true)
					{
						$result_set[] = 
							array
							(
								 "chipset" 				=> 	$chipset
								,"model"				=>	$model
								,"project"				=>	$project_info_row_project
								,"time_per_frame"		=>	$tpf_average
								,"points_per_day"		=>	$ppd_average
							);
					}
					
					$project_info_result_set->data_seek(0);
					$tpf_result_set->data_seek(0);
				}
				
				$project_result_set->data_seek(0);
			}
			$statement->free_result();
			
			if (isset($get_vars['sortByPpd']) && $get_vars['sortByPpd'] == "true")
			{
				$result_set = sort_by_ppd($result_set);
			}
			
			return $result_set;
		}
		else
		{
			$view_array_trues = 0;
			foreach ($view_array as $value)
			{
				if ($value == true)
					++$view_array_trues;
			}
			
			$bound_variables = array();
			$bound_variable_count = 0;
			$bind_result_eval = "\$statement->bind_result(";
			
			$prepared_query = "SELECT ";
			
			$prepared_query .= $intGpuStatisticsID;
			$bound_variables[$gpu_statistics_id] = 0;
			$bind_result_eval .= "\$bound_variables[\$gpu_statistics_id]";
			if ($view_array_trues > 1) 
			{
				$prepared_query .= ",";
				$bind_result_eval .= ",";
			}
			--$view_array_trues;
			
			$prepared_query .= $strChipset;
			$bound_variables[$chipset] = 0;
			$bind_result_eval .= "\$bound_variables[\$chipset]";
			if ($view_array_trues > 1) 
			{
				$prepared_query .= ",";
				$bind_result_eval .= ",";
			}
			--$view_array_trues;
			
			$prepared_query .= $strModel;
			$bound_variables[$model] = 0;
			$bind_result_eval .= "\$bound_variables[\$model]";
			if ($view_array_trues > 1) 
			{
				$prepared_query .= ",";
				$bind_result_eval .= ",";
			}
			--$view_array_trues;
			
			$prepared_query .= $intProject;
			$bound_variables[$project] = 0;
			$bind_result_eval .= "\$bound_variables[\$project]";
			if ($view_array_trues > 1) 
			{
				$prepared_query .= ",";
				$bind_result_eval .= ",";
			}
			--$view_array_trues;
			
			$prepared_query .= $intTimePerFrame;
			$bound_variables[$time_per_frame] = 0;
			$bind_result_eval .= "\$bound_variables[\$time_per_frame]";
			if ($view_array_trues > 1) 
			{
				$prepared_query .= ",";
				$bind_result_eval .= ",";
			}
			--$view_array_trues;
			
			$prepared_query .= $intPointsPerDay;
			$bound_variables[$points_per_day] = 0;
			$bind_result_eval .= "\$bound_variables[\$points_per_day]";
			if ($view_array_trues > 1) 
			{
				$prepared_query .= ",";
				$bind_result_eval .= ",";
			}
			--$view_array_trues;
			
			if (isset($view_array['overclocked']) && $view_array['overclocked'] == true)
			{
				$prepared_query .= $chrOverclockChoiceAbbreviation;
				$bound_variables[$overclocked] = 0;
				$bind_result_eval .= "\$bound_variables[\$overclocked]";
				if ($view_array_trues > 1) 
				{
					$prepared_query .= ",";
					$bind_result_eval .= ",";
				}
				--$view_array_trues;
			}
			
			if (isset($view_array['core_clock_speed']) && $view_array['core_clock_speed'] == true)
			{
				$prepared_query .= $intCoreClockSpeed;
				$bound_variables[$core_clock_speed] = 0;
				$bind_result_eval .= "\$bound_variables[\$core_clock_speed]";
				if ($view_array_trues > 1) 
				{
					$prepared_query .= ",";
					$bind_result_eval .= ",";
				}
				--$view_array_trues;
			}
			
			if (isset($view_array['shader_clock_speed']) && $view_array['shader_clock_speed'] == true)
			{
				$prepared_query .= $intShaderClockSpeed;
				$bound_variables[$shader_clock_speed] = 0;
				$bind_result_eval .= "\$bound_variables[\$shader_clock_speed]";
				if ($view_array_trues > 1) 
				{
					$prepared_query .= ",";
					$bind_result_eval .= ",";
				}
				--$view_array_trues;
			}
			
			if (isset($view_array['memory_clock_speed']) && $view_array['memory_clock_speed'] == true)
			{
				$prepared_query .= $intMemoryClockSpeed;
				$bound_variables[$memory_clock_speed] = 0;
				$bind_result_eval .= "\$bound_variables[\$memory_clock_speed]";
				if ($view_array_trues > 1) 
				{
					$prepared_query .= ",";
					$bind_result_eval .= ",";
				}
				--$view_array_trues;
			}
			
			if (isset($view_array['driver_version']) && $view_array['driver_version'] == true)
			{
				$prepared_query .= $strDriverVersion;
				$bound_variables[$driver_version] = 0;
				$bind_result_eval .= "\$bound_variables[\$driver_version]";
				if ($view_array_trues > 1) 
				{
					$prepared_query .= ",";
					$bind_result_eval .= ",";
				}
				--$view_array_trues;
			}
			
			if (isset($view_array['core']) && $view_array['core'] == true)
			{
				$prepared_query .= $strCore;
				$bound_variables[$core] = 0;
				$bind_result_eval .= "\$bound_variables[\$core]";
				if ($view_array_trues > 1) 
				{
					$prepared_query .= ",";
					$bind_result_eval .= ",";
				}
				--$view_array_trues;
			}
			
			if (isset($view_array['core_version']) && $view_array['core_version'] == true)
			{
				$prepared_query .= $strCoreVersion;
				$bound_variables[$core_version] = 0;
				$bind_result_eval .= "\$bound_variables[\$core_version]";
				if ($view_array_trues > 1) 
				{
					$prepared_query .= ",";
					$bind_result_eval .= ",";
				}
				--$view_array_trues;
			}
			
			if (isset($view_array['information_source']) && $view_array['information_source'] == true)
			{
				$prepared_query .= $strInformationSource;
				$bound_variables[$information_source] = 0;
				$bind_result_eval .= "\$bound_variables[\$information_source]";
				if ($view_array_trues > 1) 
				{
					$prepared_query .= ",";
					$bind_result_eval .= ",";
				}
				--$view_array_trues;
			}
			
			if (isset($view_array['date_submitted']) && $view_array['date_submitted'] == true)
			{
				$prepared_query .= $dteDateSubmitted;
				$bound_variables[$date_submitted] = 0;
				$bind_result_eval .= "\$bound_variables[\$date_submitted]";
				if ($view_array_trues > 1) 
				{
					$prepared_query .= ",";
					$bind_result_eval .= ",";
				}
				--$view_array_trues;
			}
			
			$bind_result_eval .= ");";
			$prepared_query .= 
				"
					FROM
							TGpuStatistics
						INNER JOIN
							TModels
						ON
							TGpuStatistics.intModelID = TModels.intModelID
						INNER JOIN
							TChipsets
						ON
							TChipsets.intChipsetID = TModels.intChipsetID
						INNER JOIN
							TProjects
						ON
							TProjects.intProjectID = TGpuStatistics.intProjectID
				";
				
			if (isset($view_array['overclocked']) && $view_array['overclocked'] == true)
			{
				$prepared_query .= 
					"
						INNER JOIN
							TOverclockChoices
						ON
							TOverclockChoices.intOverclockChoiceID = TGpuStatistics.intOverclockChoiceID
					";
			}
			
			if (isset($view_array['driver_version']) && $view_array['driver_version'] == true)
			{
				$prepared_query .=
					"
						INNER JOIN
							TDriverVersions
						ON
							TDriverVersions.intDriverVersionID = TGpuStatistics.intDriverVersionID
					";
			}
			
			if (isset($view_array['core']) && $view_array['core'] == true)
			{
				$prepared_query .=
					"
						INNER JOIN
							TCores
						ON
							TCores.intCoreID = TGpuStatistics.intCoreID
					";
			}
			
			if (isset($view_array['core_version']) && $view_array['core_version'] == true)
			{
				$prepared_query .=
					"
						INNER JOIN
							TCoreVersions
						ON
							TCoreVersions.intCoreVersionID = TGpuStatistics.intCoreVersionID
					";
			}
			
			if (isset($view_array['information_source']) && $view_array['information_source'] == true)
			{
				$prepared_query .=
					"
						INNER JOIN
							TInformationSources
						ON
							TInformationSources.intInformationSourceID = TGpuStatistics.intInformationSourceID
					";
			}
			
			$prepared_query .= " " . $where_clause . " ";
			if (isset($get_vars['record']) && $get_vars['record'] != "")
			{
				$record = intval($get_vars['record']);
				
				if ($where_clause != "")
				{
					$prepared_query .= " AND intGpuStatisticsID = $record ";
				}
				else
				{
					$prepared_query .= " WHERE intGpuStatisticsID = $record ";
				}
			}

			$prepared_query .= " ORDER BY ";
			
			if ($order_by_clause != "")
			{
				$prepared_query .= $order_by_clause . ",";
			}
			
			$prepared_query .=
				"
						 TChipsets.strChipset				DESC
						,TModels.intSortOrder				ASC
						,TProjects.intProject				ASC
				";
			if (isset($view_array['core']) && $view_array['core'] == true)
			{
				$prepared_query .= 
					"
						,TCores.strCore						ASC
					";
			}
			
			if (isset($view_array['core_version']) && $view_array['core_version'] == true)
			{
				$prepared_query .=
					"
						,TCoreVersions.strCoreVersion		ASC
					";
			}
			
			if (isset($view_array['date_submitted']) && $view_array['date_submitted'] == true)
			{
				$prepared_query .=
					"
						,TGpuStatistics.dteDateSubmitted	ASC
					";
			}

			$prepared_query .= ";";
			$statement = $connection->prepare($prepared_query);
			if ($bind_param_types != "" || count($variable_array) != 0)
				call_user_func_array("mysqli_stmt_bind_param", array_merge(array($statement, $bind_param_types), return_refs($variable_array)));
			$statement->execute();
			$statement->store_result();
			eval($bind_result_eval);

			$result_set_rows = $statement->num_rows;
			if ($result_set_rows > 0)
				$result_set = array($result_set_rows);
			else
				$result_set = array();
			$bound_variable_count = count($bound_variables);
			for ($i = 0; $i < $result_set_rows; ++$i)
			{
				$statement->fetch();
				$result_set[$i] = array($bound_variable_count);
				foreach ($bound_variables as $key => $value)
				{
					$result_set[$i][$key] = $bound_variables[$key];
				}
			}
			
			$statement->free_result();
			
			if (isset($get_vars['sortByPpd']) && $get_vars['sortByPpd'] == "true")
			{
				$result_set = sort_by_ppd($result_set);
			}
		
			return $result_set;
		}
	}
	
	function output_stats_row($row)
	{
		echo "<table cellspacing=\"0\" class=\"record_table\">";
		
		if (isset($row['gpu_statistics_id']))
		{
			$gpu_statistics_id = $row['gpu_statistics_id'];
			echo "<tr class=\"record\" id=\"" . $gpu_statistics_id . "\">";
			echo 
				"
					<td class=\"column_record_link\">
						<a href=\"index.php?show=record&record=" . $gpu_statistics_id . "\">
							<div>
								&raquo;
							</div>
						</a>
					</td>
				";
		}
		else
		{
			echo "<tr>";
		}
		
		if (isset($row['chipset']))
		{
			echo "<td class=\"column_chipset\">";
			echo $row['chipset'];
			echo "</td>";
		}
		
		if (isset($row['model']))
		{
			echo "<td class=\"column_model\">";
			echo $row['model'];
			echo "</td>";
		}
		
		if (isset($row['project']))
		{
			echo "<td class=\"column_project\">";
			if ($row['project'] != 0) echo $row['project'];
			echo "</td>";
		}
		
		if (isset($row['time_per_frame']))
		{
			echo "<td class=\"column_time_per_frame\">";
			if ($row['time_per_frame'] != 0) 
			{
				$time_per_frame = $row['time_per_frame'];
				$minutes = intval($time_per_frame / 60);
				$seconds = $time_per_frame % 60;
				echo $minutes . ":";
				if ($seconds >= 10)
					echo $seconds;
				else if ($seconds < 10 && $seconds >= 0)
					echo "0" . $seconds;
			}
			echo "</td>";
		}
		
		if (isset($row['points_per_day']))
		{
			echo "<td class=\"column_points_per_day\">";
			if ($row['points_per_day'] != 0) echo $row['points_per_day'];
			echo "</td>";
		}
		
		if (isset($row['overclocked']))
		{
			echo "<td class=\"column_overclocked\">";
			
			if ($row['overclocked'] == "y")
				echo "yes";
			else if ($row['overclocked'] == "n")
				echo "no";
			else
				echo "?";
				
			echo "</td>";
		}
		
		if (isset($row['core_clock_speed']))
		{
			echo "<td class=\"column_core_clock_speed\">";
			if ($row['core_clock_speed'] != 0) echo $row['core_clock_speed'];
			else echo "?";
			echo "</td>";
		}
		
		if (isset($row['shader_clock_speed']))
		{
			echo "<td class=\"column_shader_clock_speed\">";
			if ($row['shader_clock_speed'] != 0) echo $row['shader_clock_speed'];
			else echo "?";
			echo "</td>";
		}
		
		if (isset($row['memory_clock_speed']))
		{
			echo "<td class=\"column_memory_clock_speed\">";
			if ($row['memory_clock_speed'] != 0) echo $row['memory_clock_speed'];
			else echo "?";
			echo "</td>";
		}
		
		if (isset($row['driver_version']))
		{
			echo "<td class=\"column_driver_version\">";
			if ($row['driver_version'] != "0") echo $row['driver_version'];
			else echo "?";
			echo "</td>";
		}
		
		if (isset($row['core']))
		{
			echo "<td class=\"column_core\">";
			if ($row['core'] != "") echo $row['core'];
			else echo "?";
			echo "</td>";
		}
		
		if (isset($row['core_version']))
		{
			echo "<td class=\"column_core_version\">";
			if ($row['core_version'] != 0) echo $row['core_version'];
			else echo "?";
			echo "</td>";
		}
		
		if (isset($row['information_source']))
		{
			echo "<td class=\"column_information_source\"><textarea class=\"textarea_information_source\">";
			if ($row['information_source'] != "") echo $row['information_source'];
			else echo "?";
			echo "</textarea></td>";
		}
		
		if (isset($row['date_submitted']))
		{
			echo "<td class=\"column_date_submitted\">";
			if ($row['date_submitted'] != "1991-01-01")
			{
				$year = substr($row['date_submitted'], 0, 4);
				$month = substr($row['date_submitted'], 5, 2);
				$day = strval(intval(substr($row['date_submitted'], 8, 2)));
				
				if ($month == "01")
					$month = "January";
				else if ($month == "02")
					$month = "February";
				else if ($month == "03")
					$month = "March";
				else if ($month == "04")
					$month = "April";
				else if ($month == "05")
					$month = "May";
				else if ($month == "06")
					$month = "June";
				else if ($month == "07")
					$month = "July";
				else if ($month == "08")
					$month = "August";
				else if ($month == "09")
					$month = "September";
				else if ($month == "10")
					$month = "October";
				else if ($month == "11")
					$month = "November";
				else if ($month == "12")
					$month = "December";
				else
					$month = "(?)";
					
				echo $month . " " . $day . ", " . $year;
			}
			else
			{
				echo "?";
			}
			echo "</td>";
		}
		
		echo "</tr>";
		echo 
			"
							</a>
						</td>
					</tr>
				</table>
			";
	}
	
	function output_stats_rows($result_set, $get_vars)
	{
		$result_set_rows = count($result_set, COUNT_NORMAL);
		
		if ($result_set_rows > 0)
		{
			output_table_header($get_vars);
			
			for ($i = 0; $i < $result_set_rows; ++$i)
			{
				output_stats_row($result_set[$i]);
			}
		}
		else
		{
			echo "<div class=\"error\">There were no records matching the specified criteria.</span>";
		}
	}
	
	function output_stats($get_vars)
	{
		$var_array_dbGpuStatistics = get_vars_dbGpuStatistics();
		
		$connection = 
			new mysqli
			(
				 $var_array_dbGpuStatistics['host']
				,$var_array_dbGpuStatistics['user']
				,$var_array_dbGpuStatistics['password']
				,$var_array_dbGpuStatistics['name']
			);
		if ($connection)
		{
			$where_clause_array = array();
			$variable_array = array();
			$where_clause = "";
			$order_by_clause = "";
			$bind_param_types = "";
			
			if (isset($get_vars['filterByChipset']) && $get_vars['filterByChipset'] == "true")
			{
				$where_clause_array[] = "strChipset = ?";
				$variable_array[] = $get_vars['chipset'];
				$bind_param_types .= "s";
			}
			if (isset($get_vars['filterByModel']) && $get_vars['filterByModel'] == "true")
			{
				$where_clause_array[] = "strModel = ?";
				$variable_array[] = $get_vars['model'];
				$bind_param_types .= "s";
			}
			if (isset($get_vars['filterByProject']) && $get_vars['filterByProject'] == "true")
			{
				$where_clause_array[] = "intProject = ?";
				$variable_array[] = $get_vars['project'];
				$bind_param_types .= "i";
			}
			if (isset($get_vars['filterByPpd']) && $get_vars['filterByPpd'] == "true")
			{
				$ppdFrom = intval($get_vars['ppdFrom']);
				$ppdTo = intval($get_vars['ppdTo']);
				
				$where_clause_array[] = "(intPointsPerDay >= '" . $ppdFrom . "' AND intPointsPerDay <= '" . $ppdTo . "')";
			}
			
			$where_clause_array_count = count($where_clause_array);
			if ($where_clause_array_count > 0)
			{
				$where_clause = "WHERE ";
			}
			for ($i = 0; $i < $where_clause_array_count; ++$i)
			{
				$where_clause .= $where_clause_array[$i];
				
				if ($i < $where_clause_array_count - 1)
				{
					$where_clause .= " AND ";
				}
			}
			
			output_stats_rows
			(
					get_stats
					(
						 $get_vars
						,get_view_array($get_vars)
						,$where_clause
						,$variable_array
						,$order_by_clause
						,$bind_param_types
						,$connection
					)
				,
					$get_vars
			);
			
			$connection->close();
		}
	}
?>