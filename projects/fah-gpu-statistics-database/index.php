<?php
	include "../../error_handler.php";
	
	initialize($_SERVER);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			create_head("Folding@Home GPU Statistics Database", "../../styles/mainStyle.css");
		?>
		<link rel="stylesheet" type="text/css" href="fah-gpu-database-style.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<script type="text/javascript">
			var gpuStatsTableHeader_pixelsFromTop = 380;
			
			function enableElement(elementId)
			{
				document.getElementById(elementId).disabled = false;
			}
			function disableElement(elementId)
			{
				document.getElementById(elementId).disabled = true;
			}
			function selectElement(elementId)
			{
				document.getElementById(elementId).checked = true;
			}
			function toggleElement(elementId)
			{
				if (document.getElementById(elementId).checked == true)
				{
					document.getElementById(elementId).checked = false;
				}
				else
				{
					document.getElementById(elementId).checked = true;
				}
			}
			function fix_table_header()
			{
				var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
				if (scrollTop > gpuStatsTableHeader_pixelsFromTop && document.getElementById("gpuStatsTableHeader").className == "gpuStatsTableHeader")
				{
					document.getElementById("gpuStatsTableHeader").className = "gpuStatsTableHeader_fixed";
				}
				else if (scrollTop < gpuStatsTableHeader_pixelsFromTop && document.getElementById("gpuStatsTableHeader").className == "gpuStatsTableHeader_fixed")
				{
					document.getElementById("gpuStatsTableHeader").className = "gpuStatsTableHeader";
				}
			}
			function bodyOnLoadProcedure()
			{
				//window.addEventListener("scroll", fix_table_header, false);
			}
		</script>
	</head>
	<body onLoad="bodyOnLoadProcedure()">
		<?php
			create_header("Folding@Home GPU Statistics Database", "View Database");
			create_vertical_space("20px");
		?>
		<div id="bodyer">
			<table cellspacing="0px">
				<tr>
					<td style="border-right:1px solid white; padding:10px;">
						<a href="../../redirect.php?target=add-to-fah-gpu-database"><span id="addToDatabase">Add to The Database</span></a>
					</td>
					<td style="border-right:1px solid white; padding:10px;">
						<a href="../../redirect.php?target=about-fah-gpu-database"><span style="display:inline-block;"><img src="../../images/info-icon.png" width="15px" height="15px" style="margin-right:5px;">About The Database</span></a>
					</td>
					<td style="border-right:1px solid white; padding:10px;">
						<a href="../../redirect.php?target=fah-gpu-database-errors"><span style="display:inline-block;"><img src="../../images/red-warning-icon.png" width="15px" height="15px" style="margin-right:5px;">Known Database Errors</span></a>
					</td>
					<td style="padding:10px;">
						<a href="../../redirect.php?target=fah-gpu-database-disclaimer"><span style="display:inline-block;">Database Disclaimer</span></a>
					</td>
				</tr>
			</table>
			<div id="filterOptions">
				<form action="" method="get">
					<table>
						<tr>
							<td colspan="4">
								<b>Filtering Options:</b>
							</td>
							<td colspan="1">
								<b>Viewing Options:</b>
							</td>
						</tr>
						<tr>
							<td style="vertical-align:top;">
								<span class="label" onClick="selectElement('showAll')"><input type="radio" name="show" id="showAll" value="all"<?php if (!isset($_GET['show']) || $_GET['show'] == "all") echo " checked"; ?>>Show All Stats Entries</span>
								<br>
								<span class="label" onClick="selectElement('showSummary')"><input type="radio" name="show" id="showSummary" value="summary"<?php if (isset($_GET['show']) && $_GET['show'] == "summary") echo " checked"; ?>>Show Summary of Stats</span>
							</td>
							<td style="width:10px;">
							</td>
							<td style="vertical-align:top;">
								<span class="label" onClick="selectElement('filterByNothing')"><input type="radio" name="filterBy" id="filterByNothing" value=""<?php if (!isset($_GET['filterBy']) || $_GET['filterBy'] == "") echo " checked"; ?>>No Data Filter</span>
								<br>
								<span class="label" onClick="selectElement('filterByChipset')"><input type="radio" name="filterBy" id="filterByChipset" value="chipset"<?php if (isset($_GET['filterBy']) && $_GET['filterBy'] == "chipset") echo " checked"; ?>>Filter by Chipset</span>
								<select name="chipset" id="chipset" onClick="selectElement('filterByChipset')">
									<option name=""></option>
									<?php
										$connection = new mysqli($dbFahTables_host, $dbFahTables_user, $dbFahTables_password, $dbFahTables_name);
										if ($connection)
										{
											$distinctChipsets = $connection->query("SELECT DISTINCT Chipset FROM GpuStatisticsDatabase");
											while ($currentChipsetRow = $distinctChipsets->fetch_assoc())
											{
												echo "<option name=\"" . $currentChipsetRow['Chipset'] . "\"";
												if (isset($_GET['chipset']))
												{
													if ($_GET['chipset'] == $currentChipsetRow['Chipset'])
													{
														echo " selected";
													}
												}
												echo ">" . $currentChipsetRow['Chipset'] . "</option><br>";
											}
											
											$connection->close();
										}
									?>
								</select>
								<br>
								<span class="label" onClick="selectElement('filterByModel')"><input type="radio" name="filterBy" id="filterByModel" value="model"<?php if (isset($_GET['filterBy']) && $_GET['filterBy'] == "model") echo " checked"; ?>>Filter by Model</span>
								<select name="model" id="model" onClick="selectElement('filterByModel')">
									<option name=""></option>
									<?php
										$connection = new mysqli("FahTables.db.10182641.hostedresource.com","FahTables","Kaf%ohQ@C!RZ0","FahTables");
										if ($connection)
										{
											$distinctModels = $connection->query("SELECT DISTINCT Model FROM GpuStatisticsDatabase");
											while ($currentModelRow = $distinctModels->fetch_assoc())
											{
												echo "<option name=\"" . $currentModelRow['Model'] . "\"";
												if (isset($_GET['model']))
												{
													if ($_GET['model'] == $currentModelRow['Model'])
													{
														echo " selected";
													}
												}
												echo ">" . $currentModelRow['Model'] . "</option><br>";
											}
											
											$connection->close();
										}
									?>
								</select>
								<br>
								<span class="label" onClick="selectElement('filterByProject')"><input type="radio" name="filterBy" id="filterByProject" value="project"<?php if (isset($_GET['filterBy']) && $_GET['filterBy'] == "project") echo " checked"; ?>>Filter by Project</span>
								<select name="project" id="project" onClick="selectElement('filterByProject')">
									<option name=""></option>
									<?php
										$connection = new mysqli("FahTables.db.10182641.hostedresource.com","FahTables","Kaf%ohQ@C!RZ0","FahTables");
										if ($connection)
										{
											$distinctProjectsFromDatabase = $connection->query("SELECT DISTINCT Project FROM GpuStatisticsDatabase");
											$distinctProjectsFromPSummary = $connection->query("SELECT DISTINCT Project FROM FahProjects");
											$arrayOfDistinctProjectsFromDatabase = array($distinctProjectsFromDatabase->num_rows);
											for ($i = 0; $i < $distinctProjectsFromDatabase->num_rows; ++$i)
											{
												$currentRow = $distinctProjectsFromDatabase->fetch_assoc();
												$arrayOfDistinctProjectsFromDatabase[$i] = $currentRow['Project'];
											}
											$distinctProjectsToList = array();
											for ($i = 0, $j = 0; $i < $distinctProjectsFromPSummary->num_rows; ++$i)
											{
												$currentPSummaryProjectsRow = $distinctProjectsFromPSummary->fetch_assoc();
												if (in_array($currentPSummaryProjectsRow['Project'], $arrayOfDistinctProjectsFromDatabase) == true)
												{
													$distinctProjectsToList[$j] = $currentPSummaryProjectsRow['Project'];
													++$j;
												}
											}
											$projectList = array(count($distinctProjectsToList));
											for ($i = 0; $i < count($distinctProjectsToList); ++$i)
											{
												$projectList[$i] = intval($distinctProjectsToList[$i]);
											}
											for ($i = 0; $i < count($projectList); ++$i)
											{
												$minimumProject = min($projectList);
												$maximumProject = max($projectList);
												$projectListFoundIndex = array_search($minimumProject, $projectList);
												$projectList[$projectListFoundIndex] = $maximumProject + 1;
												
												if ($minimumProject != 0)
												{
													echo "<option name=\"" . $minimumProject . "\"";
													if (isset($_GET['project']))
													{
														if ($_GET['project'] == strval($minimumProject))
														{
															echo " selected";
														}
													}
													echo ">" . $minimumProject . "</option><br>";
												}
											}
											
											$connection->close();
										}
									?>
								</select>
								<br>
								<span class="label" onClick="selectElement('filterByPpd')"><input type="radio" name="filterBy" id="filterByPpd" value="ppd"<?php if (isset($_GET['filterBy']) && $_GET['filterBy'] == "ppd") echo " checked"; ?>>Filter by PPD
								from <input type="text" name="ppdFrom" id="ppdFrom" value="<?php if (isset($_GET['ppdFrom'])) { echo filter_var($_GET['ppdFrom'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); } ?>" size="4" onClick="selectElement('filterByPpd')"> to <input type="text" name="ppdTo" id="ppdTo" value="<?php if (isset($_GET['ppdTo'])) { echo filter_var($_GET['ppdTo'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); } ?>" size="4" onClick="selectElement('filterByPpd')"></span>
							</td>
							<td style="width:10px;">
							</td>
							<td style="vertical-align:top;">
								<input type="checkbox" name="viewOverclocked" id="viewOverclocked" value="false"<?php if (isset($_GET['viewOverclocked']) && $_GET['viewOverclocked'] == "false") echo " checked"; ?>><span class="label" onClick="toggleElement('viewOverclocked')">Do Not Show "Overclocked?"</span>
								<br>
								<input type="checkbox" name="viewClockSpeed" id="viewClockSpeed" value="false"<?php if (isset($_GET['viewClockSpeed']) && $_GET['viewClockSpeed'] == "false") echo " checked"; ?>><span class="label" onClick="toggleElement('viewClockSpeed')">Do Not Show "Clock Speed"</span>
								<br>
								<input type="checkbox" name="viewDriverVersion" id="viewDriverVersion" value="false"<?php if (isset($_GET['viewDriverVersion']) && $_GET['viewDriverVersion'] == "false") echo " checked"; ?>><span class="label" onClick="toggleElement('viewDriverVersion')">Do Not Show "Driver Version"</span>
								<br>
								<input type="checkbox" name="viewFahCore" id="viewFahCore" value="false"<?php if (isset($_GET['viewFahCore']) && $_GET['viewFahCore'] == "false") echo " checked"; ?>><span class="label" onClick="toggleElement('viewFahCore')">Do Not Show "FAH Core"</span>
								<br>
								<input type="checkbox" name="viewFahCoreVersion" id="viewFahCoreVersion" value="false"<?php if (isset($_GET['viewFahCoreVersion']) && $_GET['viewFahCoreVersion'] == "false") echo " checked"; ?>><span class="label" onClick="toggleElement('viewFahCoreVersion')">Do Not Show "FAH Core Version"</span>
								<br>
								<input type="checkbox" name="viewInfoSource" id="viewInfoSource" value="false"<?php if (isset($_GET['viewInfoSource']) && $_GET['viewInfoSource'] == "false") echo " checked"; ?>><span class="label" onClick="toggleElement('viewInfoSource')">Do Not Show "Info Source"</span>
								<br>
								<input type="checkbox" name="viewDateSubmitted" id="viewDateSubmitted" value="false"<?php if (isset($_GET['viewDateSubmitted']) && $_GET['viewDateSubmitted'] == "false") echo " checked"; ?>><span class="label" onClick="toggleElement('viewDateSubmitted')">Do Not Show "Date Submitted"</span>
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<b>Additional Options:</b>
							</td>
						</tr>
						<tr>
							<td style="vertical-align:top;" colspan="5">
								<input type="checkbox" name="showOnlyActiveProjects" id="showOnlyActiveProjects" value="true"
									<?php if (isset($_GET['showOnlyActiveProjects']) && $_GET['showOnlyActiveProjects'] == "true") echo " checked"; ?>
								>
								<span class="label" onClick="toggleElement('showOnlyActiveProjects')">
									Show Only Records w/ Active Projects
								</span>
								<br>
								<input type="checkbox" name="sortByPpd" id="sortByPpd" value="true"<?php if (isset($_GET['sortByPpd']) && $_GET['sortByPpd'] == "true") echo " checked"; ?>><span class="label" onClick="toggleElement('sortByPpd')">Sort by PPD (highest to lowest)</span>
							</td>
						</tr>
						<tr>
							<td colspan="5">
								<input type="submit" value="Filter!" id="submit" style="display:block; margin-left:auto; margin-right:auto; width:75px; height:25px;">
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div id="stats">
				<?php
					$numOfSummaryColumns = 5;
					$COLUMN_Chipset = 0;
					$COLUMN_Model = 1;
					$COLUMN_Project = 2;
					$COLUMN_TPF = 3;
					$COLUMN_PPD = 4;
					$COLUMN_Overclocked = 5;
					$COLUMN_ClockSpeed = 6;
					$COLUMN_DriverVersion = 7;
					$COLUMN_FahCore = 8;
					$COLUMN_FahCoreVersion = 9;
					$COLUMN_InfoSource = 10;
					$COLUMN_DateSubmitted = 11;
				
					function outputTableHeader()
					{
						echo "
							<tr id=\"gpuStatsTableHeader\" class=\"gpuStatsTableHeader\">
								<th class=\"column_chipset\">GPU Chipset</th>
								<th class=\"column_model\">GPU Model</th>
								<th class=\"column_project\">Project</th>
								<th class=\"column_tpf\">TPF</th>
								<th class=\"column_ppd\">PPD</th>
						";
						if (isset($_GET['viewOverclocked']) && $_GET['viewOverclocked'] == "false")
						{
							// do nothing
						}
						else
						{
							echo "<th class=\"column_overclocked\">Overclocked?</th>";
						}
						if (isset($_GET['viewClockSpeed']) && $_GET['viewClockSpeed'] == "false")
						{
							// do nothing
						}
						else
						{
							echo "<th class=\"column_clockSpeed\">Clock Speed</th>";
						}
						if (isset($_GET['viewDriverVersion']) && $_GET['viewDriverVersion'] == "false")
						{
							// do nothing
						}
						else
						{
							echo "<th class=\"column_driverVersion\">Driver Version</th>";
						}
						if (isset($_GET['viewFahCore']) && $_GET['viewFahCore'] == "false")
						{
							// do nothing
						}
						else
						{
							echo "<th class=\"column_fahCore\">FAH Core</th>";
						}
						if (isset($_GET['viewFahCoreVersion']) && $_GET['viewFahCoreVersion'] == "false")
						{
							// do nothing
						}
						else
						{
							echo "<th class=\"column_fahCoreVersion\">FAH Core Version</th>";
						}
						if (isset($_GET['viewInfoSource']) && $_GET['viewInfoSource'] == "false")
						{
							// do nothing
						}
						else
						{
							echo "<th class=\"column_infoSource\">Information Source</th>";
						}
						if (isset($_GET['viewDateSubmitted']) && $_GET['viewDateSubmitted'] == "false")
						{
							// do nothing
						}
						else
						{
							echo "<th class=\"column_dateSubmitted\">Date Submitted</th>";
						}
						echo "</tr>";
					}
					function outputTableSummaryHeader()
					{
						echo "
							<tr id=\"gpuStatsTableHeader\" class=\"gpuStatsTableHeader\">
								<th class=\"column_chipset\">GPU Chipset</th>
								<th class=\"column_model\">GPU Model</th>
								<th class=\"column_project\">Project</th>
								<th class=\"column_tpf\">Average TPF</th>
								<th class=\"column_ppd\">Average PPD</th>
							</tr>
						";
					}
					function output($output, $numOfRows, $numOfColumns, $projectIds)
					{
						global $COLUMN_Chipset;
						global $COLUMN_Model;
						global $COLUMN_Project;
						global $COLUMN_TPF;
						global $COLUMN_PPD;
						global $COLUMN_Overclocked;
						global $COLUMN_ClockSpeed;
						global $COLUMN_DriverVersion;
						global $COLUMN_FahCore;
						global $COLUMN_FahCoreVersion;
						global $COLUMN_InfoSource;
						global $COLUMN_DateSubmitted;
						
						if ($numOfRows == 0 || count($output) == 0)
						{
							echo "<font style=\"color:red;\">There were no database records found with the specified criteria.</font>";
						}
						else
						{
							global $numOfSummaryColumns;
							if ($numOfColumns > $numOfSummaryColumns)
							{
								if (isset($_GET['sortByPpd']) && $_GET['sortByPpd'] == "true")
								{
									$newOutput = array($numOfRows);
									$ppd = array($numOfRows);
									for ($i = 0; $i < $numOfRows; ++$i)
									{
										if ($output[$i][$COLUMN_PPD] != "")
										{
											$ppd[$i] = intval($output[$i][$COLUMN_PPD]);
										}
										else
										{
											$ppd[$i] = 0;
										}
									}
									rsort($ppd);
									for ($i = 0; $i < $numOfRows; ++$i)
									{
										$found = false;
										$j = 0;
										while ($found == false && $j < $numOfRows)
										{
											$row = array('Chipset' => $output[$j][$COLUMN_Chipset], 'Model' => $output[$j][$COLUMN_Model], 'Project' => $output[$j][$COLUMN_Project], 'TPF' => $output[$j][$COLUMN_TPF], 'PPD' => $output[$j][$COLUMN_PPD], 'Overclocked' => $output[$j][$COLUMN_Overclocked], 'ClockSpeed' => $output[$j][$COLUMN_ClockSpeed], 'DriverVersion' => $output[$j][$COLUMN_DriverVersion], 'FahCore' => $output[$j][$COLUMN_FahCore], 'FahCoreVersion' => $output[$j][$COLUMN_FahCoreVersion], 'InfoSource' => $output[$j][$COLUMN_InfoSource], 'DateSubmitted' => $output[$j][$COLUMN_DateSubmitted]);
											if (intval($row['PPD']) == $ppd[$i])
											{
												$newOutput[$i] = array_values($row);
												$output[$j][$COLUMN_PPD] = "-1";
												$found = true;
											}
											++$j;
										}
									}
									for ($i = 0; $i < $numOfRows; ++$i)
									{
										$output[$i] = array_values($newOutput[$i]);
									}
								}
							
								outputTableHeader();
								for ($i = 0; $i < $numOfRows; ++$i)
								{
									$outputRow = array('Chipset' => $output[$i][$COLUMN_Chipset], 'Model' => $output[$i][$COLUMN_Model], 'Project' => $output[$i][$COLUMN_Project], 'TPF' => $output[$i][$COLUMN_TPF], 'PPD' => $output[$i][$COLUMN_PPD], 'Overclocked' => $output[$i][$COLUMN_Overclocked], 'ClockSpeed' => $output[$i][$COLUMN_ClockSpeed], 'DriverVersion' => $output[$i][$COLUMN_DriverVersion], 'FahCore' => $output[$i][$COLUMN_FahCore], 'FahCoreVersion' => $output[$i][$COLUMN_FahCoreVersion], 'InfoSource' => $output[$i][$COLUMN_InfoSource], 'DateSubmitted' => $output[$i][$COLUMN_DateSubmitted]);
									
									echo "
										<tr>
											<td class=\"column_chipset\">" . $outputRow['Chipset'] . "</td>
											<td class=\"column_model\">" . $outputRow['Model'] . "</td>
									";
									if (in_array($outputRow['Project'], $projectIds) == true)
									{
										echo "<td class=\"column_project\"><a href=\"http://fah-web.stanford.edu/cgi-bin/fahproject.overusingIPswillbebanned?p=" . $outputRow['Project'] . "\" target=\"_blank\">" . $outputRow['Project'] . "</a></td>";
									}
									else
									{
										echo "<td class=\"column_project\">" . $outputRow['Project'] . "</td>";
									}
									echo "
											<td class=\"column_tpf\">" . $outputRow['TPF'] . "</td>
											<td class=\"column_ppd\">" . $outputRow['PPD'] . "</td>
									";
									if (isset($_GET['viewOverclocked']) && $_GET['viewOverclocked'] == "false")
									{
										// do nothing
									}
									else
									{
										echo "<td class=\"column_overclocked\">" . $outputRow['Overclocked'] . "</td>";
									}
									if (isset($_GET['viewClockSpeed']) && $_GET['viewClockSpeed'] == "false")
									{
										// do nothing
									}
									else
									{
										echo "<td class=\"column_clockSpeed\">" . $outputRow['ClockSpeed'] . "</td>";
									}
									if (isset($_GET['viewDriverVersion']) && $_GET['viewDriverVersion'] == "false")
									{
										// do nothing
									}
									else
									{
										echo "<td class=\"column_driverVersion\">" . $outputRow['DriverVersion'] . "</td>";
									}
									if (isset($_GET['viewFahCore']) && $_GET['viewFahCore'] == "false")
									{
										// do nothing
									}
									else
									{
										echo "<td class=\"column_fahCore\">" . $outputRow['FahCore'] . "</td>";
									}
									if (isset($_GET['viewFahCoreVersion']) && $_GET['viewFahCoreVersion'] == "false")
									{
										// do nothing
									}
									else
									{
										echo "<td class=\"column_fahCoreVersion\">" . $outputRow['FahCoreVersion'] . "</td>";
									}
									if (isset($_GET['viewInfoSource']) && $_GET['viewInfoSource'] == "false")
									{
										// do nothing
									}
									else
									{
										echo "<td class=\"column_infoSource\"><textarea>" . $outputRow['InfoSource'] . "</textarea></td>";
									}
									if (isset($_GET['viewDateSubmitted']) && $_GET['viewDateSubmitted'] == "false")
									{
										// do nothing
									}
									else
									{
										echo "<td class=\"column_dateSubmitted\">" . $outputRow['DateSubmitted'] . "</td>";
									}
									echo "
										</tr>
									";
								}
							}
							else if ($numOfColumns == $numOfSummaryColumns)
							{
								if (isset($_GET['sortByPpd']) && $_GET['sortByPpd'] == "true")
								{
									$newOutput = array($numOfRows);
									$ppd = array($numOfRows);
									for ($i = 0; $i < $numOfRows; ++$i)
									{
										if ($output[$i][$COLUMN_PPD] != "")
										{
											$ppd[$i] = intval($output[$i][$COLUMN_PPD]);
										}
										else
										{
											$ppd[$i] = 0;
										}
									}
									rsort($ppd);
									for ($i = 0; $i < $numOfRows; ++$i)
									{
										$found = false;
										$j = 0;
										while ($found == false && $j < $numOfRows)
										{
											$row = array('Chipset' => $output[$j][$COLUMN_Chipset], 'Model' => $output[$j][$COLUMN_Model], 'Project' => $output[$j][$COLUMN_Project], 'TPF' => $output[$j][$COLUMN_TPF], 'PPD' => $output[$j][$COLUMN_PPD]);
											if (intval($row['PPD']) == $ppd[$i])
											{
												$newOutput[$i] = array_values($row);
												$output[$j][$COLUMN_PPD] = "-1";
												$found = true;
											}
											++$j;
										}
									}
									for ($i = 0; $i < $numOfRows; ++$i)
									{
										$output[$i] = array_values($newOutput[$i]);
									}
								}
								
								outputTableSummaryHeader();
								for ($i = 0; $i < $numOfRows; ++$i)
								{
									$outputRow = array('Chipset' => $output[$i][0], 'Model' => $output[$i][1], 'Project' => $output[$i][2], 'TPF' => $output[$i][3], 'PPD' => $output[$i][4]);
									
									echo "
										<tr>
											<td class=\"column_chipset\">" . $outputRow['Chipset'] . "</td>
											<td class=\"column_model\">" . $outputRow['Model'] . "</td>
									";
									if (in_array($outputRow['Project'], $projectIds) == true)
									{
										echo "<td class=\"column_project\"><a href=\"http://fah-web.stanford.edu/cgi-bin/fahproject.overusingIPswillbebanned?p=" . $outputRow['Project'] . "\" target=\"_blank\">" . $outputRow['Project'] . "</td>";
									}
									else
									{
										echo "<td class=\"column_project\">" . $outputRow['Project'] . "</td>";
									}
									echo "
											<td class=\"column_tpf\">" . $outputRow['TPF'] . "</td>
											<td class=\"column_ppd\">" . $outputRow['PPD'] . "</td>
										</tr>
									";
								}
							}
						}
					}
					function preOutput($connection, $result)
					{
						$result2 = $connection->query("SELECT Project FROM FahProjects");
						$projectIds = array($result2->num_rows);
						for ($i = 0; $i < $result2->num_rows; ++$i)
						{
							$projectRow = $result2->fetch_assoc();
							$projectIds[$i] = $projectRow['Project'];
						}
						
						$numOfRows = 0;
						$numOfColumns = $result->field_count;
						if (isset($_GET['showOnlyActiveProjects']) && strtolower($_GET['showOnlyActiveProjects']) == "true")
						{
							while ($currentRow = $result->fetch_assoc())
							{
								if (in_array($currentRow['Project'], $projectIds) == true)
								{
									++$numOfRows;
								}
							}
						}
						else
						{
							$numOfRows = $result->num_rows;
						}
						$result->data_seek(0);
						$output = array($numOfRows);
						$i = 0;
						if (isset($_GET['showOnlyActiveProjects']) && strtolower($_GET['showOnlyActiveProjects']) == "true")
						{
							while ($currentRow = $result->fetch_array())
							{
								if (in_array($currentRow['Project'], $projectIds) == true)
								{
									$output[$i] = array($numOfColumns);
									for ($j = 0; $j < $numOfColumns; ++$j)
									{
										$output[$i][$j] = $currentRow[$j];
									}
									++$i;
								}
							}
						}
						else
						{
							while ($currentRow = $result->fetch_array())
							{
								$output[$i] = array($numOfColumns);
								for ($j = 0; $j < $numOfColumns; ++$j)
								{
									$output[$i][$j] = $currentRow[$j];
								}
								++$i;
							}
						}
						
						output($output, $numOfRows, $numOfColumns, $projectIds);
					}
					function outputSummary($connection, $firstQuerySupplement, $secondQuerySupplement, $thirdQuerySupplement)
					{
						global $numOfSummaryColumns;
						$distinctModelsResult = $connection->query("SELECT DISTINCT Model FROM GpuStatisticsDatabase" . $firstQuerySupplement);
						$numberOfDistinctRows = $distinctModelsResult->num_rows;
						while ($currentModelRow = $distinctModelsResult->fetch_assoc())
						{
							$currentModel = $currentModelRow['Model'];
							$distinctProjectsPerModelResult = $connection->query("SELECT DISTINCT Project FROM GpuStatisticsDatabase WHERE Model = '$currentModel'" . $secondQuerySupplement);
							$numberOfDistinctRows += $distinctProjectsPerModelResult->num_rows + 1;
						}
						
						$previousModel = "NULL";
						$previousProject = "NULL";
						$result = $connection->query("SELECT * FROM GpuStatisticsDatabase" . $thirdQuerySupplement);
						$result2 = $connection->query("SELECT Project FROM FahProjects");
						$projectIds = array($result2->num_rows);
						for ($i = 0; $i < $result2->num_rows; ++$i)
						{
							$projectRow = $result2->fetch_assoc();
							$projectIds[$i] = $projectRow['Project'];
						}
						$output = array();
						$numOfRows = 0;
						$i = 0;
						if (isset($_GET['showOnlyActiveProjects']) && strtolower($_GET['showOnlyActiveProjects']) == "true")
						{
							$outputRow = array("Chipset" => "", "Model" => "", "Project" => "", "TPF" => "", "PPD" => "");
							
							while ($currentRow = $result->fetch_assoc())
							{
								if (in_array($currentRow['Project'], $projectIds) == true)
								{
									if ($currentRow['Model'] != $previousModel || $currentRow['Project'] != $previousProject)
									{
										++$numOfRows;
										$previousModel = $currentRow['Model'];
										$previousProject = $currentRow['Project'];
									}
								}
							}
							$previousModel = "NULL";
							$previousProject = "NULL";
							$output = array($numOfRows);
							$result->data_seek(0);
							while ($currentRow = $result->fetch_assoc())
							{
								if (in_array($currentRow['Project'], $projectIds) == true)
								{
									if ($currentRow['Model'] != $previousModel || $currentRow['Project'] != $previousProject)
									{
										$currentModel = $currentRow['Model'];
										$currentProject = $currentRow['Project'];
										
										if (isset($_GET['sortByPpd']) && $_GET['sortByPpd'])
										{
											$outputRow['Chipset'] = $currentRow['Chipset'];
											$outputRow['Model'] = $currentRow['Model'];
										}
										else
										{
											if ($currentRow['Model'] != $previousModel)
											{
												$outputRow['Chipset'] = $currentRow['Chipset'];
												$outputRow['Model'] = $currentRow['Model'];
											}
											else
											{
												$outputRow['Chipset'] = "";
												$outputRow['Model'] = "";
											}
										}
										
										if ($currentRow['Project'] != "")
										{
											$outputRow['Project'] = "<a href=\"http://fah-web.stanford.edu/cgi-bin/fahproject.overusingIPswillbebanned?p=" . $currentRow['Project'] . "\" target=\"_blank\">" . $currentRow['Project'] . "</a>";
										}
										else
										{
											$outputRow['Project'] = "<font style=\"font-size:x-small;\">unspecified</font>";
										}
										
										$tpfResult = $connection->query("SELECT TPF FROM GpuStatisticsDatabase WHERE Model = '$currentModel' AND Project = '$currentProject'");
										$tpfArray = array($tpfResult->num_rows);
										$j = 0;
										while ($currentTpfRow = $tpfResult->fetch_assoc())
										{
											if ($currentTpfRow['TPF'] != "")
											{
												$tpfArray[$j] = $currentTpfRow['TPF'];
												++$j;
											}
										}
										$averageTpf = averageTimes($tpfArray);
										if ($averageTpf != "0:00")
										{
											$outputRow['TPF'] = $averageTpf;
										}
										else
										{
											$outputRow['TPF'] = "";
										}
										
										$ppdResult = $connection->query("SELECT PPD FROM GpuStatisticsDatabase WHERE Model = '$currentModel' AND Project = '$currentProject'");
										$ppdArray = array($ppdResult->num_rows);
										$j = 0;
										while ($currentPpdRow = $ppdResult->fetch_assoc())
										{
											$ppdArray[$j] = $currentPpdRow['PPD'];
											++$j;
										}
										$averagePpd = averageNumbers($ppdArray);
										if ($averagePpd != "0")
										{
											$outputRow['PPD'] = $averagePpd;
										}
										else
										{
											$outputRow['PPD'] = "";
										}
										
										$output[$i] = array_values($outputRow);
										++$i;
									}
									$previousModel = $currentRow['Model'];
									$previousProject = $currentRow['Project'];
								}
							}
						}
						else
						{
							$outputRow = array("Chipset" => "", "Model" => "", "Project" => "", "TPF" => "", "PPD" => "");

							while ($currentRow = $result->fetch_assoc())
							{
								if ($currentRow['Model'] != $previousModel || $currentRow['Project'] != $previousProject)
								{
									++$numOfRows;
									$previousModel = $currentRow['Model'];
									$previousProject = $currentRow['Project'];
								}
							}
							$previousModel = "NULL";
							$previousProject = "NULL";
							$output = array($numOfRows);
							$result->data_seek(0);
							while ($currentRow = $result->fetch_assoc())
							{
								if ($currentRow['Model'] != $previousModel || $currentRow['Project'] != $previousProject)
								{
									$currentModel = $currentRow['Model'];
									$currentProject = $currentRow['Project'];
									
									if (isset($_GET['sortByPpd']) && $_GET['sortByPpd'])
									{
										$outputRow['Chipset'] = $currentRow['Chipset'];
										$outputRow['Model'] = $currentRow['Model'];
									}
									else
									{
										if ($currentRow['Model'] != $previousModel)
										{
											$outputRow['Chipset'] = $currentRow['Chipset'];
											$outputRow['Model'] = $currentRow['Model'];
										}
										else
										{
											$outputRow['Chipset'] = "";
											$outputRow['Model'] = "";
										}
									}
									
									if ($currentRow['Project'] != "")
									{
										if (in_array($currentRow['Project'], $projectIds) == true)
										{
											$outputRow['Project'] = "<a href=\"http://fah-web.stanford.edu/cgi-bin/fahproject.overusingIPswillbebanned?p=" . $currentRow['Project'] . "\" target=\"_blank\">" . $currentRow['Project'] . "</a>";
										}
										else
										{
											$outputRow['Project'] = $currentRow['Project'];
										}
									}
									else
									{
										$outputRow['Project'] = "<font style=\"font-size:x-small;\">unspecified</font>";
									}
									
									$tpfResult = $connection->query("SELECT DISTINCT TPF FROM GpuStatisticsDatabase WHERE Model = '$currentModel' AND Project = '$currentProject'");
									$tpfArray = array($tpfResult->num_rows);
									$j = 0;
									while ($currentTpfRow = $tpfResult->fetch_assoc())
									{
										if ($currentTpfRow['TPF'] != "")
										{
											$tpfArray[$j] = $currentTpfRow['TPF'];
											++$j;
										}
									}
									$averageTpf = averageTimes($tpfArray);
									if ($averageTpf != "0:00")
									{
										$outputRow['TPF'] = $averageTpf;
									}
									else
									{
										$outputRow['TPF'] = "";
									}
									
									$ppdResult = $connection->query("SELECT DISTINCT PPD FROM GpuStatisticsDatabase WHERE Model = '$currentModel' AND Project = '$currentProject'");
									$ppdArray = array($ppdResult->num_rows);
									$j = 0;
									while ($currentPpdRow = $ppdResult->fetch_assoc())
									{
										$ppdArray[$j] = $currentPpdRow['PPD'];
									}
									$averagePpd = averageNumbers($ppdArray);
									if ($averagePpd != "0")
									{
										$outputRow['PPD'] = $averagePpd;
									}
									else
									{
										$outputRow['PPD'] = "";
									}
									
									$output[$i] = array_values($outputRow);
									++$i;
								}
								$previousModel = $currentRow['Model'];
								$previousProject = $currentRow['Project'];
							}
						}
						
						output($output, $numOfRows, $numOfSummaryColumns, $projectIds);
					}
					
					$connection = new mysqli("FahTables.db.10182641.hostedresource.com","FahTables","Kaf%ohQ@C!RZ0","FahTables");
					if ($connection)
					{
						$result = $connection->query("SELECT * FROM GpuStatisticsDatabase LIMIT 1");
						if ($result->num_rows < 1)
						{
							die("<font style=\"color:red;\">The Database is currently being updated. Please check back in a minute.</font>");
						}
						else
						{
							echo "<table id=\"gpuStatsTable\">";
							
							if (!isset($_GET['show']))
							{
								$_GET['show'] = "all";
							}
							
							if (strtolower($_GET['show']) == "all")
							{
								if (!isset($_GET['filterBy']))
								{
									$_GET['filterBy'] = "";
								}
								
								switch (strtolower($_GET['filterBy']))
								{
									case "":
									{
										$result = $connection->query("SELECT * FROM GpuStatisticsDatabase");
										preOutput($connection, $result);
										
										break;
									}
									case "chipset":
									{
										if (isset($_GET['chipset']))
										{
											if ($_GET['chipset'] != "")
											{
												$result = $connection->query("SELECT DISTINCT Chipset FROM GpuStatisticsDatabase");
												$chipset = "";
												$i = 0;
												$numOfResultRows = $result->num_rows;
												for (; $i < $numOfResultRows; ++$i)
												{
													$currentRow = $result->fetch_assoc();
													if ($_GET['chipset'] == $currentRow['Chipset'])
													{
														$chipset = $currentRow['Chipset'];
														break;
													}
												}
												if ($i == $numOfResultRows)
												{
													echo "<font style=\"color:red;\">The chipset that was specified in the database query does not exist in the database.</font>";
													break;
												}
												
												$result = $connection->query("SELECT * FROM GpuStatisticsDatabase WHERE Chipset = '$chipset'");
												preOutput($connection, $result);
											}
											else
											{
												echo "<font style=\"color:red;\">The query to filter by chipset was sent to the database but there was no chipset specified.</font>";
												break;
											}
										}
										else
										{
											echo "<font style=\"color:red;\">The query to filter by chipset was sent to the database but there was no chipset specified.</font>";
											break;
										}
										
										break;
									}
									case "model":
									{
										if (isset($_GET['model']))
										{
											if ($_GET['model'] != "")
											{
												$result = $connection->query("SELECT DISTINCT Model FROM GpuStatisticsDatabase");
												$model = "";
												$i = 0;
												$numOfResultRows = $result->num_rows;
												for (; $i < $numOfResultRows; ++$i)
												{
													$currentRow = $result->fetch_assoc();
													if ($_GET['model'] == $currentRow['Model'])
													{
														$model = $currentRow['Model'];
														break;
													}
												}
												if ($i == $numOfResultRows)
												{
													echo "<font style=\"color:red;\">The model that was specified in the database query does not exist in the database.</font>";
													break;
												}
												
												$result = $connection->query("SELECT * FROM GpuStatisticsDatabase WHERE Model = '$model'");
												preOutput($connection, $result);
											}
											else
											{
												echo "<font style=\"color:red;\">The query to filter by model was sent to the database but there was no model specified.</font>";
												break;
											}
										}
										else
										{
											echo "<font style=\"color:red;\">The query to filter by model was sent to the database but there was no model specified.</font>";
											break;
										}
										
										break;
									}
									case "project":
									{
										if (isset($_GET['project']) && $_GET['project'] != "")
										{
											$projectSpecified = filter_var($_GET['project'], FILTER_SANITIZE_NUMBER_INT);
											
											$statement = $connection->prepare("SELECT * FROM GpuStatisticsDatabase WHERE Project = ?");
											$statement->bind_param("s", $projectSpecified);
											$statement->execute();
											$statement->store_result();
											$statement->bind_result($chipset, $model, $project, $tpf, $ppd, $overclocked, $clockSpeed, $driverVersion, $fahCore, $fahCoreVersion, $infoSource, $dateSubmitted);
											if ($statement->num_rows > 0)
											{
												$result2 = $connection->query("SELECT Project FROM FahProjects");
												$projectIds = array($result2->num_rows);
												for ($i = 0; $i < $result2->num_rows; ++$i)
												{
													$projectRow = $result2->fetch_assoc();
													$projectIds[$i] = $projectRow['Project'];
												}
												$numOfRows = 0;
												$numOfColumns = $statement->field_count;
												while ($statement->fetch())
												{
													++$numOfRows;
												}
												$output = array($numOfRows);
												$statement->data_seek(0);
												$i = 0;
												while ($statement->fetch())
												{
													$output[$i] = array($chipset, $model, $project, $tpf, $ppd, $overclocked, $clockSpeed, $driverVersion, $fahCore, $fahCoreVersion, $infoSource, $dateSubmitted);
													++$i;
												}
												output($output, $numOfRows, $numOfColumns, $projectIds);
											}
											else
											{
												echo "<font style=\"color:red;\">There were no database records with projects matching the specified project.</font>";
												break;
											}
										}
										else
										{
											echo "<font style=\"color:red;\">The query to filter by project was sent to the database but there was no project specified.</font>";
											break;
										}
										
										break;
									}
									case "ppd":
									{
										if (isset($_GET['ppdFrom']))
										{
											if ($_GET['ppdFrom'] != "")
											{
												$output = array();
												$numOfRows = 0;
												$result = $connection->query("SELECT * FROM GpuStatisticsDatabase");
												$numOfColumns = $result->field_count;
												$result2 = $connection->query("SELECT Project FROM FahProjects");
												$projectIds = array($result2->num_rows);
												for ($i = 0; $i < $result2->num_rows; ++$i)
												{
													$projectRow = $result2->fetch_assoc();
													$projectIds[$i] = $projectRow['Project'];
												}
												
												if (!isset($_GET['ppdTo']) || $_GET['ppdTo'] == "")
												{
													$ppdFrom = intval($_GET['ppdFrom']);
													if (isset($_GET['showOnlyActiveProjects']) && strtolower($_GET['showOnlyActiveProjects']) == "true")
													{
														while ($currentRow = $result->fetch_assoc())
														{
															if (intval($currentRow['PPD']) >= $ppdFrom && in_array($currentRow['Project'], $projectIds) == true)
															{
																++$numOfRows;
															}
														}
														$output = array($numOfRows);
														$result->data_seek(0);
														$i = 0;
														while ($currentRow = $result->fetch_assoc())
														{
															if (intval($currentRow['PPD']) >= $ppdFrom && in_array($currentRow['Project'], $projectIds) == true)
															{
																$output[$i] = array_values($currentRow);
																++$i;
															}
														}
													}
													else
													{
														while ($currentRow = $result->fetch_assoc())
														{
															if (intval($currentRow['PPD']) >= $ppdFrom)
															{
																++$numOfRows;
															}
														}
														$output = array($numOfRows);
														$result->data_seek(0);
														$i = 0;
														while ($currentRow = $result->fetch_assoc())
														{
															if (intval($currentRow['PPD']) >= $ppdFrom)
															{
																$output[$i] = array_values($currentRow);
																++$i;
															}
														}
													}
												}
												else
												{
													$ppdFrom = intval($_GET['ppdFrom']);
													$ppdTo = intval($_GET['ppdTo']);
													if (isset($_GET['showOnlyActiveProjects']) && strtolower($_GET['showOnlyActiveProjects']) == "true")
													{
														while ($currentRow = $result->fetch_assoc())
														{
															$currentRowPpd = intval($currentRow['PPD']);
															if ($currentRowPpd >= $ppdFrom && $currentRowPpd <= $ppdTo)
															{
																if (in_array($currentRow['Project'], $projectIds) == true)
																{
																	++$numOfRows;
																}
															}
														}
														$output = array($numOfRows);
														$result->data_seek(0);
														$i = 0;
														while ($currentRow = $result->fetch_assoc())
														{
															$currentRowPpd = intval($currentRow['PPD']);
															if ($currentRowPpd >= $ppdFrom && $currentRowPpd <= $ppdTo)
															{
																if (in_array($currentRow['Project'], $projectIds) == true)
																{
																	$output[$i] = array_values($currentRow);
																	++$i;
																}
															}
														}
													}
													else
													{
														while ($currentRow = $result->fetch_assoc())
														{
															$currentRowPpd = intval($currentRow['PPD']);
															if ($currentRowPpd >= $ppdFrom && $currentRowPpd <= $ppdTo)
															{
																++$numOfRows;
															}
														}
														$output = array($numOfRows);
														$result->data_seek(0);
														$i = 0;
														while ($currentRow = $result->fetch_assoc())
														{
															$currentRowPpd = intval($currentRow['PPD']);
															if ($currentRowPpd >= $ppdFrom && $currentRowPpd <= $ppdTo)
															{
																$output[$i] = array_values($currentRow);
																++$i;
															}
														}
													}
												}
												
												output($output, $numOfRows, $numOfColumns, $projectIds);
											}
											else
											{
												echo "<font style=\"color:red;\">The query to filter by PPD was sent to the database but there was no minimum PPD specified.</font>";
												break;
											}
										}
										else
										{
											echo "<font style=\"color:red;\">The query to filter by PPD was sent to the database but there was no minimum PPD specified.</font>";
											break;
										}
										
										break;
									}
									default:
									{
										echo "<font style=\"color:red;\">The \"filter by\" setting specified was not recognized.</font>";
										break;
									}
								}
							}
							else if (strtolower($_GET['show']) == "summary")
							{
								require "averageTimes.php";
								require "averageNumbers.php";
								
								if (!isset($_GET['filterBy']))
								{
									$_GET['filterBy'] = "";
								}
								
								switch (strtolower($_GET['filterBy']))
								{
									case "":
									{
										outputSummary($connection,
													  "", 
													  "",
													  "");
										
										break;
									}
									case "chipset":
									{
										if (isset($_GET['chipset']))
										{
											if ($_GET['chipset'] != "")
											{
												$result = $connection->query("SELECT DISTINCT Chipset FROM GpuStatisticsDatabase");
												$chipset = "";
												$i = 0;
												$numOfResultRows = $result->num_rows;
												for (; $i < $numOfResultRows; ++$i)
												{
													$currentRow = $result->fetch_assoc();
													if ($_GET['chipset'] == $currentRow['Chipset'])
													{
														$chipset = $currentRow['Chipset'];
														break;
													}
												}
												if ($i == $numOfResultRows)
												{
													echo "<font style=\"color:red;\">The chipset that was specified in the database query does not exist in the database.</font>";
													break;
												}
												
												outputSummary($connection,
															  " WHERE Chipset = '$chipset'",
															  " AND Chipset = '$chipset'",
															  " WHERE Chipset = '$chipset'");
											}
											else
											{
												echo "<font style=\"color:red;\">The query to filter by chipset was sent to the database but there was no chipset specified.</font>";
												break;
											}
										}
										else
										{
											echo "<font style=\"color:red;\">The query to filter by chipset was sent to the database but there was no chipset specified.</font>";
											break;
										}
										
										break;
									}
									case "model":
									{
										if (isset($_GET['model']))
										{
											if ($_GET['model'] != "")
											{
												$result = $connection->query("SELECT DISTINCT Model FROM GpuStatisticsDatabase");
												$model = "";
												$i = 0;
												$numOfResultRows = $result->num_rows;
												for (; $i < $numOfResultRows; ++$i)
												{
													$currentRow = $result->fetch_assoc();
													if ($_GET['model'] == $currentRow['Model'])
													{
														$model = $currentRow['Model'];
														break;
													}
												}
												if ($i == $numOfResultRows)
												{
													echo "<font style=\"color:red;\">The model that was specified in the database query does not exist in the database.</font>";
													break;
												}
												
												outputSummary($connection,
															  " WHERE Model = '$model'",
															  "",
															  " WHERE Model = '$model'");
											}
											else
											{
												echo "<font style=\"color:red;\">The query to filter by model was sent to the database but there was no model specified.</font>";
												break;
											}
										}
										else
										{
											echo "<font style=\"color:red;\">The query to filter by model was sent to the database but there was no model specified.</font>";
											break;
										}
									
										break;
									}
									case "project":
									{
										if (isset($_GET['project']) && $_GET['project'] != "")
										{
											global $numOfSummaryColumns;
											$projectSpecified = filter_var($_GET['project'], FILTER_SANITIZE_NUMBER_INT);
											
											$statement = $connection->prepare("SELECT * FROM GpuStatisticsDatabase WHERE Project = ?");
											$statement->bind_param("s", $projectSpecified);
											$statement->execute();
											$statement->store_result();
											$statement->bind_result($chipset, $model, $project, $tpf, $ppd, $overclocked, $clockSpeed, $driverVersion, $fahCore, $fahCoreVersion, $infoSource, $dateSubmitted);
											if ($statement->num_rows > 0)
											{
												$result2 = $connection->query("SELECT Project FROM FahProjects");
												$projectIds = array($result2->num_rows);
												for ($i = 0; $i < $result2->num_rows; ++$i)
												{
													$projectRow = $result2->fetch_assoc();
													$projectIds[$i] = $projectRow['Project'];
												}
												
												$numOfRows = 0;
												$outputRow = array("Chipset" => "", "Model" => "", "Project" => "", "TPF" => "", "PPD" => "");
												$previousModel = "NULL";
												$previousProject = "NULL";
												while ($statement->fetch())
												{
													if ($model != $previousModel || $project != $previousProject)
													{
														++$numOfRows;
														$previousModel = $model;
														$previousProject = $project;
													}
												}
												$output = array($numOfRows);
												$previousModel = "NULL";
												$previousProject = "NULL";
												$statement->data_seek(0);
												$j = 0;
												while ($statement->fetch())
												{
													if ($model != $previousModel || $project != $previousProject)
													{
														if (isset($_GET['sortByPpd']) && $_GET['sortByPpd'])
														{
															$outputRow['Chipset'] = $chipset;
															$outputRow['Model'] = $model;
														}
														else
														{
															if ($model != $previousModel)
															{
																$outputRow['Chipset'] = $chipset;
																$outputRow['Model'] = $model;
															}
															else
															{
																$outputRow['Chipset'] = "";
																$outputRow['Model'] = "";
															}
														}
														
														$outputRow['Project'] = "<a href=\"http://fah-web.stanford.edu/cgi-bin/fahproject.overusingIPswillbebanned?p=" . $project . "\" target=\"_blank\">" . $project . "</a>";
														
														$tpfResult = $connection->query("SELECT TPF FROM GpuStatisticsDatabase WHERE Model = '$model' AND Project = '$project'");
														$tpfArray = array($tpfResult->num_rows);
														$i = 0;
														while ($currentTpfRow = $tpfResult->fetch_assoc())
														{
															if ($currentTpfRow['TPF'] != "")
															{
																$tpfArray[$i] = $currentTpfRow['TPF'];
																++$i;
															}
														}
														$averageTpf = averageTimes($tpfArray);
														if ($averageTpf != "0:00")
														{
															$outputRow['TPF'] = $averageTpf;
														}
														else
														{
															$outputRow['TPF'] = "";
														}
														
														$ppdResult = $connection->query("SELECT PPD FROM GpuStatisticsDatabase WHERE Model = '$model' AND Project = '$project'");
														$ppdArray = array($ppdResult->num_rows);
														$i = 0;
														while ($currentPpdRow = $ppdResult->fetch_assoc())
														{
															$ppdArray[$i] = $currentPpdRow['PPD'];
															++$i;
														}
														$averagePpd = averageNumbers($ppdArray);
														if ($averagePpd != "0")
														{
															$outputRow['PPD'] = $averagePpd;
														}
														else
														{
															$outputRow['PPD'] = "";
														}
														
														$output[$j] = array_values($outputRow);
														++$j;
													}
													$previousModel = $model;
													$previousProject = $project;
												}
												
												output($output, $numOfRows, $numOfSummaryColumns, $projectIds);
											}
											else
											{
												echo "<font style=\"color:red;\">There were no database records with projects matching the specified project.</font>";
												break;
											}
										}
										else
										{
											echo "<font style=\"color:red;\">The query to filter by project was sent to the database but there was no project specified.</font>";
											break;
										}
										
										break;
									}
									case "ppd":
									{
										if (isset($_GET['ppdFrom']))
										{
											if ($_GET['ppdFrom'] != "")
											{
												global $numOfSummaryColumns;
												$output = array();
												$outputRow = array("Chipset" => "", "Model" => "", "Project" => "", "TPF" => "", "PPD" => "");
												$maxNumOfRows = 0;
												$j = 0;
												$previousModel = "NULL";
												$previousProject = "NULL";
												$result = $connection->query("SELECT * FROM GpuStatisticsDatabase");
												$numOfColumns = $result->field_count;
												$result2 = $connection->query("SELECT Project FROM FahProjects");
												$projectIds = array($result2->num_rows);
												for ($i = 0; $i < $result2->num_rows; ++$i)
												{
													$projectRow = $result2->fetch_assoc();
													$projectIds[$i] = $projectRow['Project'];
												}
												
												if (isset($_GET['showOnlyActiveProjects']) && strtolower($_GET['showOnlyActiveProjects']) == "true")
												{
													while ($currentRow = $result->fetch_assoc())
													{
														if (in_array($currentRow['Project'], $projectIds) == true)
														{
															if ($currentRow['Model'] != $previousModel || $currentRow['Project'] != $previousProject)
															{
																++$maxNumOfRows;
																$previousModel = $currentRow['Model'];
																$previousProject = $currentRow['Project'];
															}
														}
													}
													$previousModel = "NULL";
													$previousProject = "NULL";
													$output = array($maxNumOfRows);
													$result->data_seek(0);
													while ($currentRow = $result->fetch_assoc())
													{
														if (in_array($currentRow['Project'], $projectIds) == true)
														{
															if ($currentRow['Model'] != $previousModel || $currentRow['Project'] != $previousProject)
															{
																$currentModel = $currentRow['Model'];
																$currentProject = $currentRow['Project'];
																
																if (isset($_GET['sortByPpd']) && $_GET['sortByPpd'])
																{
																	$outputRow['Chipset'] = $currentRow['Chipset'];
																	$outputRow['Model'] = $currentRow['Model'];
																}
																else
																{
																	if ($currentRow['Model'] != $previousModel)
																	{
																		$outputRow['Chipset'] = $currentRow['Chipset'];
																		$outputRow['Model'] = $currentRow['Model'];
																	}
																	else
																	{
																		$outputRow['Chipset'] = "";
																		$outputRow['Model'] = "";
																	}
																}
																
																if (in_array($currentRow['Project'], $projectIds) == true)
																{
																	$outputRow['Project'] = "<a href=\"http://fah-web.stanford.edu/cgi-bin/fahproject.overusingIPswillbebanned?p=" . $currentRow['Project'] . "\" target=\"_blank\">" . $currentRow['Project'] . "</a>";
																}
																else
																{
																	$outputRow['Project'] = "<font style=\"font-size:x-small;\">unspecified</font>";
																}
																
																$tpfResult = $connection->query("SELECT DISTINCT TPF FROM GpuStatisticsDatabase WHERE Model = '$currentModel' AND Project = '$currentProject'");
																$tpfArray = array($tpfResult->num_rows);
																$i = 0;
																while ($currentTpfRow = $tpfResult->fetch_assoc())
																{
																	if ($currentTpfRow['TPF'] != "")
																	{
																		$tpfArray[$i] = $currentTpfRow['TPF'];
																		++$i;
																	}
																}
																$averageTpf = averageTimes($tpfArray);
																if ($averageTpf != "0:00")
																{
																	$outputRow['TPF'] = $averageTpf;
																}
																else
																{
																	$outputRow['TPF'] = "";
																}
																
																$ppdResult = $connection->query("SELECT DISTINCT PPD FROM GpuStatisticsDatabase WHERE Model = '$currentModel' AND Project = '$currentProject'");
																$ppdArray = array($ppdResult->num_rows);
																$i = 0;
																while ($currentPpdRow = $ppdResult->fetch_assoc())
																{
																	$ppdArray[$i] = $currentPpdRow['PPD'];
																	++$i;
																}
																$averagePpd = averageNumbers($ppdArray);
																if ($averagePpd != "0")
																{
																	$outputRow['PPD'] = $averagePpd;
																}
																else
																{
																	$outputRow['PPD'] = "";
																}
																
																if (!isset($_GET['ppdTo']) || $_GET['ppdTo'] == "")
																{
																	if ($averagePpd >= intval($_GET['ppdFrom']))
																	{
																		$output[$j] = array_values($outputRow);
																		++$j;
																		$previousModel = $currentRow['Model'];
																		$previousProject = $currentRow['Project'];
																	}
																}
																else
																{
																	if ($averagePpd >= intval($_GET['ppdFrom']) && $averagePpd <= intval($_GET['ppdTo']))
																	{
																		$output[$j] = array_values($outputRow);
																		++$j;
																		$previousModel = $currentRow['Model'];
																		$previousProject = $currentRow['Project'];
																	}
																}
															}
														}
													}
												}
												else
												{
													while ($currentRow = $result->fetch_assoc())
													{
														if ($currentRow['Model'] != $previousModel || $currentRow['Project'] != $previousProject)
														{
															++$maxNumOfRows;
															$previousModel = $currentRow['Model'];
															$previousProject = $currentRow['Project'];
														}
													}
													$previousModel = "NULL";
													$previousProject = "NULL";
													$output = array($maxNumOfRows);
													$result->data_seek(0);
													while ($currentRow = $result->fetch_assoc())
													{
														if ($currentRow['Model'] != $previousModel || $currentRow['Project'] != $previousProject)
														{
															$currentModel = $currentRow['Model'];
															$currentProject = $currentRow['Project'];
															
															if (isset($_GET['sortByPpd']) && $_GET['sortByPpd'])
															{
																$outputRow['Chipset'] = $currentRow['Chipset'];
																$outputRow['Model'] = $currentRow['Model'];
															}
															else
															{
																if ($currentRow['Model'] != $previousModel)
																{
																	$outputRow['Chipset'] = $currentRow['Chipset'];
																	$outputRow['Model'] = $currentRow['Model'];
																}
																else
																{
																	$outputRow['Chipset'] = "";
																	$outputRow['Model'] = "";
																}
															}
															
															if (in_array($currentRow['Project'], $projectIds) == true)
															{
																$outputRow['Project'] = "<a href=\"http://fah-web.stanford.edu/cgi-bin/fahproject.overusingIPswillbebanned?p=" . $currentRow['Project'] . "\" target=\"_blank\">" . $currentRow['Project'] . "</a>";
															}
															else
															{
																$outputRow['Project'] = "<font style=\"font-size:x-small;\">unspecified</font>";
															}
															
															$tpfResult = $connection->query("SELECT DISTINCT TPF FROM GpuStatisticsDatabase WHERE Model = '$currentModel' AND Project = '$currentProject'");
															$tpfArray = array($tpfResult->num_rows);
															$i = 0;
															while ($currentTpfRow = $tpfResult->fetch_assoc())
															{
																if ($currentTpfRow['TPF'] != "")
																{
																	$tpfArray[$i] = $currentTpfRow['TPF'];
																	++$i;
																}
															}
															$averageTpf = averageTimes($tpfArray);
															if ($averageTpf != "0:00")
															{
																$outputRow['TPF'] = $averageTpf;
															}
															else
															{
																$outputRow['TPF'] = "";
															}
															
															$ppdResult = $connection->query("SELECT DISTINCT PPD FROM GpuStatisticsDatabase WHERE Model = '$currentModel' AND Project = '$currentProject'");
															$ppdArray = array($ppdResult->num_rows);
															$i = 0;
															while ($currentPpdRow = $ppdResult->fetch_assoc())
															{
																$ppdArray[$i] = $currentPpdRow['PPD'];
																++$i;
															}
															$averagePpd = averageNumbers($ppdArray);
															if ($averagePpd != "0")
															{
																$outputRow['PPD'] = $averagePpd;
															}
															else
															{
																$outputRow['PPD'] = "";
															}
															
															if (!isset($_GET['ppdTo']) || $_GET['ppdTo'] == "")
															{
																if ($averagePpd >= intval($_GET['ppdFrom']))
																{
																	$output[$j] = array_values($outputRow);
																	++$j;
																	$previousModel = $currentRow['Model'];
																	$previousProject = $currentRow['Project'];
																}
															}
															else
															{
																if ($averagePpd >= intval($_GET['ppdFrom']) && $averagePpd <= intval($_GET['ppdTo']))
																{
																	$output[$j] = array_values($outputRow);
																	++$j;
																	$previousModel = $currentRow['Model'];
																	$previousProject = $currentRow['Project'];
																}
															}
														}
													}
												}
												
												output($output, $j, $numOfSummaryColumns, $projectIds);
											}
											else
											{
												echo "<font style=\"color:red;\">The query to filter by PPD was sent to the database but there was no minimum PPD specified.</font>";
												break;
											}
										}
										else
										{
											echo "<font style=\"color:red;\">The query to filter by PPD was sent to the database but there was no minimum PPD specified.</font>";
											break;
										}
										
										break;
									}
									default:
									{
										echo "<font style=\"color:red;\">The \"filter by\" setting specified was not recognized.</font>";
										break;
									}
								}
							}
							else
							{
								echo "<font style=\"color:red;\">The setting for \"show\" must be either \"summary\" or \"all\".</font>";
							}
							
							echo "</table>";
						}
						
						$connection->close();
					}
					else
					{
						echo "A connection to the database could not be established. Please contact the website administrator.";
					}
				?>
			</div>
		</div>
		<div id="footer">
			compdewddevelopment.com/redirect.php?target=fah-gpu-database
		</div>
	</body>
</html>