<?php
	require_once "../../common.php";
	
	initialize($_SERVER);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			create_head("Folding@Home GPU Statistics Database - Known Errors", "../../styles/default.css");
		?>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
		<?php
			create_header("Folding@Home GPU Statistics Database", "Known Errors");
			create_vertical_space("20px");
		?>
		<div id="bodyer">
			<font style="font-size:small;">
			<?php
				function validate_statistics()
				{
					$connection = new mysqli($dbFahTables_host, $dbFahTables_user, $dbFahTables_password, $dbFahTables_name);
					if ($connection)
					{
						$query = "
							SELECT 
								 TStatistics.intRecordID 					AS intRecordID
								,TChipsets.strChipset						AS strChipset
								,TModels.strModel							AS strModel
								,TProjects.intProject						AS intProject
								,TStatistics.intTimePerFrame				AS intTimePerFrame
								,TStatistics.intPointsPerDay				AS intPointsPerDay
								,TOverclockOptions.charOverclocked			AS charOverclocked
								,TStatistics.intClockSpeed					AS intClockSpeed
								,TCores.strCore								AS strCore
								,TCoreVersions.strCoreVersion				AS strCoreVersion
								,TInformationSources.strInformationSource	AS strInformationSource
								,TDatesSubmitted.dteDateSubmitted			AS dteDateSubmitted
							FROM
								 (
									TStatistics INNER JOIN TModels
										ON TStatistics.intModelID
										
										
										
										
										
						";
						$result_set = $connection->query($query);
						$num_errors = 0;
						$errors_exist = false;
						while ($row_statistics = $result_set->fetch_assoc())
						{
							$project = $row_statistics['strProject'];
							$result_set_projects = $connection->query("SELECT * FROM FahProjects WHERE Project = '$intProject'");
							if ($result_set_projects->num_rows > 0)
							{
								$result_set_projects->data_seek(0);
								$row_projects = $result_set_projects->fetch_assoc();
								
								$base_points = intval($row_projects['intBasePoints']);
								$points_per_day = intval($row_statistics['intPointsPerDay']);
								if ($points_per_day > 0)
								{
									$time_per_frame = $base_points / $points_per_day * 864;
								}
								else
								{
									$time_per_frame = 0;
								}
								
								if (!isset($row_statistics['intTimePerFrame']) || $row_statistics['intTimePerFrame'] == "")
								{
									$message = "<font style=\"color:lime;\">There was a TPF calculation for record \"" .
											   $row_statistics['intRecordID'] . "\": " .
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
								else
								{
									// The amount the calculated PPD can be off before an error is reported
									$forgiveness = 50;
									// Calculate PPD
									$completion_time = $time_per_frame * 864;
									$bonus_factor = ($row_projects['KFactor'] == 0) ? 1 : sqrt($row_projects['sngFinalDeadline']) / $row_projects['sngKFactor'] * $completion_time;
									$bonus_factor = ($bonus_factor < 1) ? 1 : $bonus_factor;
									$points_per_day = $bonus_factor * $base_points / $completion_time
									// If the calculated PPD is out of the range of forgiveness
									$message = "<font style=\"color:red;\">There was an error found for record " .
											   $row_statistics['intRecordID'] . ": " .
											   $row_statistics['strChipset'] . " " .
											   $row_statistics['strModel'] . " [Project: " .
											   $row_statistics['intProject'] . ", TPF: " .
											   $row_statistics['intTimePerFrame'] . 
											   "] The correct PPD is: " .
											   $points_per_day .
											   ".</font>";
									
									echo $message;
									echo "<br>";
									
									++$num_errors;
									$errors_exist = true;
								}
							}
						}
						
						if ($errors_exist == false)
						{
							echo "Validation Complete. There were no errors found in the database. If you know of an error, please email <a href=\"mailto:problems@compdewddevelopment.com\">problems@compdewddevelopment.com</a>.";
						}
						else
						{
							if ($num_errors == 0)
							{
								echo "The project information tables are empty (probably being updated) so no validation of the statistics could take place.<br>";
								echo "If you check back in a minute and you still receive this error, please email <a href=\"mailto:problems@compdewddevelopment.com\">problems@compdewddevelopment.com</a> to bring attention to the problem.";
							}
							else
							{
								echo "<br>Validation Complete. There were <font style=\"color:red;\">";
								echo $num_errors;
								echo " errors</font> found in the database. If you know of an error that was not listed above, please email <a href=\"mailto:problems@compdewddevelopment.com\">problems@compdewddevelopment.com</a>.";
							}
						}
						
						$connection->close();
					}
				}
				
				validateStatistics();
			?>
			</font>
		</div>
		<?php
			create_footer("www.compdewddevelopment.com/redirect.php?target=fah-gpu-database-errors");
		?>
	</body>
</html>