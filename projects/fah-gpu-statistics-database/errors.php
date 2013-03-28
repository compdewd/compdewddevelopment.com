<?php
	require_once "../../common.php";
	require_once "fah-gpu-database_functions.php";
	
	initialize($_SERVER);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			create_head("The Folding@Home GPU Statistics Database - Known Errors", "../../styles/default.css");
		?>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
		<?php
			create_header("The Folding@Home GPU Statistics Database", "Known Errors");
			create_vertical_space("20px");
		?>
		<div id="bodyer">
			<a href="../../redirect.php?target=fah-gpu-database">Return to the Database</a>
			<br>
			<br>
			<font style="font-size:small;">
			<?php
				function validate_statistics()
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
						
						$query = 
							"SELECT " .
								$intGpuStatisticsID . "," .
								$strChipset . "," .
								$strModel . "," .
								$intProject . "," .
								$intTimePerFrame . "," .
								$intPointsPerDay . "," .
								$chrOverclockChoiceAbbreviation . "," .
								$intCoreClockSpeed . "," .
								$intShaderClockSpeed . "," .
								$intMemoryClockSpeed . "," .
								$strDriverVersion . "," .
								$strCore . "," .
								$strCoreVersion . "," .
								$strInformationSource . "," .
								$dteDateSubmitted . " " .
							"FROM 
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
								INNER JOIN
									TOverclockChoices
								ON
									TOverclockChoices.intOverclockChoiceID = TGpuStatistics.intOverclockChoiceID
								INNER JOIN
									TDriverVersions
								ON
									TDriverVersions.intDriverVersionID = TGpuStatistics.intDriverVersionID
								INNER JOIN
									TCores
								ON
									TCores.intCoreID = TGpuStatistics.intCoreID
								INNER JOIN
									TCoreVersions
								ON
									TCoreVersions.intCoreVersionID = TGpuStatistics.intCoreVersionID
								INNER JOIN
									TInformationSources
								ON
									TInformationSources.intInformationSourceID = TGpuStatistics.intInformationSourceID
							ORDER BY
								 TChipsets.strChipset				DESC
								,TModels.strModel					ASC
								,TProjects.intProject				ASC
								,TCores.strCore						ASC
								,TCoreVersions.strCoreVersion		ASC
								,TGpuStatistics.dteDateSubmitted	ASC
						";
						
						$result_set = $connection->query($query);
						$num_errors = 0;
						$errors_exist = false;
						while ($row_statistics = $result_set->fetch_assoc())
						{
							$project = $row_statistics['intProject'];
							$result_set_projects = 
								$connection->query
								("
									SELECT
										 decBasePoints
										,decFinalDeadline
										,decKFactor
									FROM 
										TProjects
									WHERE
										intProject = '$project'
									;
								");
							if ($result_set_projects->num_rows > 0)
							{
								$result_set_projects->data_seek(0);
								$row_projects = $result_set_projects->fetch_assoc();
								
								$base_points = floatval($row_projects['decBasePoints']);
								$points_per_day = intval($row_statistics['intPointsPerDay']);
								$time_per_frame = intval($row_statistics['intTimePerFrame']);
								
								if ($time_per_frame == 0)
								{
									if ($points_per_day > 0)
									{
										$time_per_frame = round($base_points / $points_per_day * 864);
									
										$message = 
											"<font style=\"color:lime;\">There was a TPF calculation for record \"" .
											$row_statistics['intGpuStatisticsID'] . "\": " .
											$row_statistics['strChipset'] . " " .
											$row_statistics['strModel'] . " [Project: " .
											$row_statistics['intProject'] . ", TPF: " .
											$row_statistics['intTimePerFrame'] . ", PPD: " .
											$row_statistics['intPointsPerDay'] . "]. " .
											"The TPF calculated was: " .
											$time_per_frame .
											" seconds.</font>";
										
										echo $message;
										echo "<br>";
										
										++$num_errors;
										$errors_exist = true;
									}
								}
								else
								{
									// The amount the calculated PPD can be off before an error is reported
									$forgiveness = 5;
									// Calculate PPD
									$project_info =
										array
										(
											 "decBasePoints"		=>	$base_points
											,"decFinalDeadline"		=>	floatval($row_projects['decFinalDeadline'])
											,"decKFactor"			=>	floatval($row_projects['decKFactor'])
										);
									$points_per_day = calculate_points_per_day($time_per_frame, $project_info);
									// If the calculated PPD is out of the range of forgiveness
									if 
									(
											$points_per_day > $row_statistics['intPointsPerDay'] + $forgiveness 
										||
											$points_per_day < $row_statistics['intPointsPerDay'] - $forgiveness
									)
									{
										$message = 
											"<font style=\"color:red;\">There was an error found for record \"" .
											$row_statistics['intGpuStatisticsID'] . "\": " .
											$row_statistics['strChipset'] . " " .
											$row_statistics['strModel'] . " [Project: " .
											$row_statistics['intProject'] . ", TPF: " .
											$row_statistics['intTimePerFrame'] . 
											"] The correct PPD is: " .
											$points_per_day .
											" ( ";
										if ($points_per_day > $row_statistics['intPointsPerDay'] + $forgiveness)
										{
											$message .= 
												"+" .
												($points_per_day - $row_statistics['intPointsPerDay'] + $forgiveness);
										}
										else
										{
											$message .= 
												"-" .
												($row_statistics['intPointsPerDay'] + $forgiveness - $points_per_day);
										}
										$message .= " )</font>";
										
										echo $message;
										echo "<br>";
									
										++$num_errors;
										$errors_exist = true;
									}
								}
							}
						}
						
						if ($errors_exist == false)
						{
							if ($num_errors == 0)
							{
								echo "Validation Complete. There were no errors found in the database. If you know of an error, please email <a href=\"mailto:problems@compdewddevelopment.com\">problems@compdewddevelopment.com</a>.";
							}
							else
							{
								echo "The project information tables are empty (probably being updated) so no validation of the statistics could take place.<br>";
								echo "If you check back in a minute and you still receive this error, please email <a href=\"mailto:problems@compdewddevelopment.com\">problems@compdewddevelopment.com</a> to bring attention to the problem.";
							}
						}
						else
						{
							echo "<br>Validation Complete. There were <font style=\"color:red;\">";
							echo $num_errors;
							echo " errors</font> found in the database. If you know of an error that was not listed above, please email <a href=\"mailto:problems@compdewddevelopment.com\">problems@compdewddevelopment.com</a>.";
						}
						
						$connection->close();
					}
				}
				
				validate_statistics();
			?>
			</font>
		</div>
		<?php
			create_footer("www.compdewddevelopment.com/redirect.php?target=fah-gpu-database-errors");
		?>
	</body>
</html>