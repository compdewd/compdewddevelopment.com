<?php
	require_once "../../common.php";
	require_once "fah-gpu-database_functions.php";
	
	initialize($_SERVER);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			create_head("Folding@Home GPU Statistics Database", "../../styles/default.css");
		?>
		<link rel="stylesheet" type="text/css" href="fah-gpu-database-style.css">
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
	</head>
	<body>
		<div id="wrapper">
			<?php
				create_header("Folding@Home GPU Statistics Database", "View Database");
				create_vertical_space("20px");
			?>
			<div id="bodyer">
				<table id="database-links">
					<tr>
						<td class="firstLink">
							<a href="../../redirect.php?target=add-to-fah-gpu-database">
								<span id="addToDatabase">Add to the Database"</span>
							</a>
						</td>
						<td class="middleLink">
							<a href="../../redirect.php?target=about-fah-gpu-database">
								<span class="database-link">
									<img src="../../images/info-icon.png" class="database-link-icon">
									About the Database
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
				<div id="filterOptions">
					<form action="" method="get">
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
									<span class="label" onClick="selectElement('filterByNothing')">
										<input type="radio" name="filterBy" id="filterByNothing" value=""
											<?php
												if (!isset($_GET['filterBy']) || $_GET['filterBy'] == "")
												{
													echo " checked";
												}
											?>
										>
										No Data Filter
									</span>
									<br>
									<span class="label" onClick="selectElement('filterByChipset')">
										<input type="radio" name="filterBy" id="filterByChipset" value="chipset"
											<?php
												if (isset($_GET['filterBy']) && $_GET['filterBy'] == "chipset")
												{
													echo " checked";
												}
											?>
										>
										Filter by Chipset
									</span>
									<select name="chipset" id="chipset" onClick="selectElement('filterByChipset')">
										<option name=""></option>
										<?php
											output_chipsets($_GET['chipset']);
										?>
									</select>
									<br>
									<span class="label" onClick="selectElement('filterByModel')">
										<input type="radio" name="filterBy" id="filterByModel" value="model"
											<?php
												if (isset($_GET['filterBy']) && $_GET['filterBy'] == "model")
												{
													echo " checked";
												}
											?>
										>
										Filter by Model
									</span>
									<select name="model" id="model" onClick="selectElement('filterByModel')">
										<option name=""></option>
										<?php
											output_models($_GET['model']);
										?>
									</select>
									<br>
									<span class="label" onClick="selectElement('filterByProject')">
										<input type="radio" name="filterBy" id="filterByProject" value="project"
											<?php
												if (isset($_GET['filterBy']) && $_GET['filterBy'] == "project")
												{
													echo " checked";
												}
											?>
										>
										Filter by Project
									</span>
									<select name="project" id="project" onClick="selectElement('filterByProject')">
										<option name=""></option>
										<?php
											output_projects($_GET['project']);
										?>
									</select>
									<br>
									<span class="label" onClick="selectElement('filterByPpd')">
										<input type="radio" name="filterBy" id="filterByPpd" value="ppd"
											<?php
												if (isset($_GET['filterBy']) && $_GET['filterBy'] == "ppd")
												{
													echo " checked";
												}
											?>
										>
										Filter by PPD
										from
										<input type="text" name="ppdFrom" id="ppdFrom" value="
											<?php
												if (isset($_GET['ppdFrom']))
												{
													echo filter_var($_GET['ppdFrom'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
												}
											?>
										" size="4" onClick="selectElement('filterByPpd')">
										to
										<input type="text" name="ppdTo" id="ppdTo" value="
											<?php
												if (isset($_GET['ppdTo'])) 
												{ 
													echo filter_var($_GET['ppdTo'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); 
												}
											?>
										" size="4" onClick="selectElement('filterByPpd')">
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
										output_viewing_option("viewClockSpeed", "Clock Speed");
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
										output_additional_option("showOnlyActiveProjects", "Show Only Records with Active Projects");
										output_additional_option("sortByPpd", "Sort by PPD (highest to lowest)");
									?>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<input type="submit" value="Filter!" id="filter">
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div id="stats">
					<?php
						
					?>
				</div>
			</div>
			<?php
				create_footer("www.compdewddevelopment.com/redirect.php?target=fah-gpu-database");
			?>
		</div>
	</body>
</html>