<?php
	require_once "../../common.php";
	require_once "fah-gpu-database_functions.php";
	
	initialize($_SERVER);
	
	if (!isset($_GET['chipset']))
		$_GET['chipset'] = "";
	if (!isset($_GET['model']))
		$_GET['model'] = "";
	if (!isset($_GET['project']))
		$_GET['project'] = "";
	if (!isset($_GET['ppdFrom']))
		$_GET['ppdFrom'] = "";
	if (!isset($_GET['ppdTo']))
		$_GET['ppdTo'] = "";
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			create_head("The Folding@Home GPU Statistics Database", "../../styles/default.css");
		?>
		<link rel="stylesheet" type="text/css" href="fah-gpu-statistics-database.css">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<script type="text/javascript">
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
		</script>
		
		<style type="text/css">
			<?php
				create_column_width("column_record_link", "24px");
				create_column_width("column_chipset", "84px");
				create_column_width("column_model", "90px");
				create_column_width("column_project", "80px");
				create_column_width("column_time_per_frame", "68px");
				create_column_width("column_points_per_day", "68px");
				create_column_width("column_overclocked", "110px");
				create_column_width("column_core_clock_speed", "95px");
				create_column_width("column_shader_clock_speed", "108px");
				create_column_width("column_memory_clock_speed", "108px");
				create_column_width("column_driver_version", "70px");
				create_column_width("column_core", "52px");
				create_column_width("column_core_version", "88px");
				create_column_width("column_information_source", "120px");
				create_column_width("column_date_submitted", "94px");
			?>
		</style>
	</head>
	<body>
		<div id="wrapper">
			<?php
				create_header("The Folding@Home GPU Statistics Database", "View Database");
			?>
			<div id="bodyer">
				<table id="database-links">
					<tr>
						<td class="firstLink">
							<a href="../../redirect.php?target=add-to-fah-gpu-database">
								<span id="addToDatabase">Add to the Database</span>
							</a>
						</td>
						<td class="middleLink">
							<a href="../../redirect.php?target=fah-gpu-database-faq">
								<span class="database-link">
									<img src="../../images/info-icon.png" class="database-link-icon">
									Database FAQ
								</span>
							</a>
						</td>
						<td class="middleLink">
							<a href="../../redirect.php?target=fah-gpu-database-errors">
								<span class="database-link">
									<img src="../../images/red-warning-icon.png" class="database-link-icon">
									Known Database Errors
								</span>
							</a>
						</td>
						<td class="lastLink">
							<a href="../../redirect.php?target=fah-gpu-database-disclaimer">
								<span class="database-link">
									Database Disclaimer
								</span>
							</a>
						</td>
					</tr>
				</table>
				<?php
					create_vertical_space("20px");
				?>
				<div id="filterOptions">
					<form action="index.php" method="get">
						<table id="database-filter-options">
							<tr>
								<td colspan="4" id="heading-filtering-options">
									Filtering Options
								</td>
								<td colspan="1" id="heading-viewing-options">
									Viewing Options
								</td>
							</tr>
							<tr>
								<td class="filtering-options">
									<span class="label" onClick="selectElement('showAll')">
										<input type="radio" name="show" id="showAll" value="all"
											<?php
												if (!isset($_GET['show']) || $_GET['show'] == "all")
												{
													echo " checked";
												}
											?>
										>
										Show All Stats Entries
									</span>
									<br>
									<span class="label" onClick="selectElement('showSummary')">
										<input type="radio" name="show" id="showSummary" value="summary"
											<?php
												if (isset($_GET['show']) && $_GET['show'] == "summary")
												{
													echo " checked";
												}
											?>
										>
										Show Summary of Stats
									</span>
								</td>
								<td>
									<?php
										create_horizontal_space("10px");
									?>
								</td>
								<td class="filtering-options">
									<?php
										create_filter_option("filterByChipset", "true", "Filter By Chipset");
									?>
									<select name="chipset" id="chipset" onClick="selectElement('filterByChipset')">
										<option name=""></option>
										<?php
											output_chipsets($_GET['chipset']);
										?>
									</select>
									<br>
									<?php
										create_filter_option("filterByModel", "true", "Filter By Model");
									?>
									<select name="model" id="model" onClick="selectElement('filterByModel')">
										<option name=""></option>
										<?php
											output_models($_GET['model']);
										?>
									</select>
									<br>
									<?php
										create_filter_option("filterByProject", "true", "Filter By Project");
									?>
									<select name="project" id="project" onClick="selectElement('filterByProject')">
										<option name=""></option>
										<?php
											output_projects($_GET['project']);
										?>
									</select>
									<br>
									<?php
										create_filter_option("filterByPpd", "true", "Filter By PPD");
									?>
									<span class="label" onClick="selectElement('filterByPpd')">
										<input type="text" name="ppdFrom" id="ppdFrom" value=
										"<?php
											if (isset($_GET['ppdFrom']))
											{
												echo filter_var($_GET['ppdFrom'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
											}
										?>" size="4" onClick="selectElement('filterByPpd')">
										to
										<input type="text" name="ppdTo" id="ppdTo" value=
										"<?php
											if (isset($_GET['ppdTo'])) 
											{ 
												echo filter_var($_GET['ppdTo'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); 
											}
										?>" size="4" onClick="selectElement('filterByPpd')">
									</span>
								</td>
								<td>
									<?php
										create_horizontal_space("10px");
									?>
								</td>
								<td class="viewing-options">
									<?php
										output_viewing_option("viewOverclocked", "Overclocked?");
										output_viewing_option("viewCoreClockSpeed", "Core Clock Speed");
										output_viewing_option("viewShaderClockSpeed", "Shader Clock Speed");
										output_viewing_option("viewMemoryClockSpeed", "Memory Clock Speed");
										output_viewing_option("viewDriverVersion", "Driver Version");
										output_viewing_option("viewFahCore", "FAH Core");
										output_viewing_option("viewFahCoreVersion", "FAH Core Version");
										output_viewing_option("viewInfoSource", "Info Source");
										output_viewing_option("viewDateSubmitted", "Date Submitted");
									?>
								</td>
							</tr>
							<tr>
								<td colspan="3" id="heading-additional-options">
									Additional Options
								</td>
								<td colspan="2">
								</td>
							</tr>
							<tr>
								<td colspan="5" class="additional-options">
									<?php
										output_additional_option("showOnlyAssignedProjects", "Show Only Records of Currently Assigned Projects");
										output_additional_option("sortByPpd", "Sort by PPD (highest to lowest)");
									?>
								</td>
							</tr>
							<tr>
								<td style="text-align:center;" colspan="5">
									<input type="submit" value="Filter!" id="filter-button">
								</td>
							</tr>
						</table>
					</form>
				</div>
				<?php
					create_vertical_space("10px");
				?>
				<div id="stats">
					<table id="stats-table">
						<tr>
							<td>
								<?php
									output_stats($_GET);
								?>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<?php
				create_footer("www.compdewddevelopment.com/redirect.php?target=fah-gpu-database");
			?>
		</div>
	</body>
</html>