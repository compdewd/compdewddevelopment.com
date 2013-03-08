<?php
	function output_form($submitted, $chipset, $model, $project, $time_per_frame, $points_per_day, $overclocked, $clock_speed, $driver_version, $core, $core_version, $information_source)
	{
		echo "
		<form method=\"post\" action=\"add.php\">
			<input type=\"hidden\" name=\"submitted\" value=\"true\">
			<table cellspacing=\"4px\">
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"chipset\">GPU Chipset</label>
					</td>
					<td>
						<input type=\"text\" name=\"chipset\" value=\"";
		echo $chipset;
		echo "\">";
		if ($submitted == true && $chipset == "")
		{
			echo "<font color='red'><b>&nbsp;A chipset is required. (e.g. AMD, NVIDIA)</b></font>";
		}
		echo "
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"model\">GPU Model</label>
					</td>
					<td>
						<input type=\"text\" name=\"model\" value=\"";
		echo $model;
		echo "\">";
		if ($submitted == true && $model == "")
		{
			echo "<font color=\"red\"><b>&nbsp;A model name is required.</b></font>";
		}
		echo "
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"project\">Current Project</label>
					</td>
					<td>
						<input type=\"text\" name=\"project\" value=\"";
		echo $project;
		echo "\">";
		if ($submitted == true && $project == "")
		{
			echo "<font color=\"red\"><b>&nbsp;A project ID is required</b></font>";
		}
		echo "
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"time_per_frame\">TPF</label>
					</td>
					<td>
						<input type=\"text\" name=\"time_per_frame\" value=\"";
		echo $time_per_frame;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"points_per_day\">PPD</label>
					</td>
					<td>
						<input type=\"text\" name=\"points_per_day\" value=\"";
		echo $points_per_day;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"Overclocked\">Overclocked?</label>
					</td>
					<td>
		";
		if ($overclocked == "yes")
		{
			echo "<input type=\"radio\" name=\"overclocked\" value=\"yes\" checked=\"true\">Yes</input><br>";
		}
		else
		{
			echo "<input type=\"radio\" name=\"overclocked\" value=\"yes\">Yes</input><br>";
		}

		if ($overclocked == "no")
		{
			echo "<input type=\"radio\" name=\"overclocked\" value=\"no\" checked=\"true\">No</input><br>";
		}
		else
		{
			echo "<input type=\"radio\" name=\"overclocked\" value=\"no\">No</input><br>";
		}

		if ($overclocked == "unknown")
		{
			echo "<input type=\"radio\" name=\"overclocked\" value=\"unknown\" checked=\"true\">Unknown</input><br>";
		}
		else
		{
			echo "<input type=\"radio\" name=\"overclocked\" value=\"unknown\">Unknown</input><br>";
		}
		echo "
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"clock_speed\">Core Clock Speed</label>
					</td>
					<td>
						<input type=\"text\" name=\"clock_speed\" value=\"";
		echo $clock_speed;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"driver_version\">Driver Version</label>
					</td>
					<td>
						<input type=\"text\" name=\"driver_version\" value=\"";
		echo $driver_version;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"core\">FAH Core</label>
					</td>
					<td>
						<input type=\"text\" name=\"core\" value=\"";
		echo $core;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"core_version\">FAH Core Version</label>
					</td>
					<td>
						<input type=\"text\" name=\"core_version\" value=\"";
		echo $core_version;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"information_source\">Information Source</label>
					</td>
					<td>
						<input type=\"text\" name=\"information_source\" value=\"";
		echo $information_source;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
					</td>
					<td>
						<input type=\"submit\" value=\"Submit Data\">
					</td>
				</tr>
			</table>
		</form>
		";
	}
?>