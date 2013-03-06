<?php
	function output_form($submitted, $chipset, $model, $project, $time_per_frame, $points_per_day, $overclocked, $clock_speed, $driver_version, $core, $core_version, $information_source)
	{
		echo "
		<form method=\"post\" action=\"add.php\">
			<input type=\"hidden\" name=\"submitted\" value=\"true\">
			<table cellspacing=\"4px\">
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"Chipset\">GPU Chipset</label>
					</td>
					<td>
						<input type=\"text\" name=\"Chipset\" value=\"";
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
						<label for=\"Model\">GPU Model</label>
					</td>
					<td>
						<input type=\"text\" name=\"Model\" value=\"";
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
						<label for=\"Project\">Current Project</label>
					</td>
					<td>
						<input type=\"text\" name=\"Project\" value=\"";
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
						<label for=\"TPF\">TPF</label>
					</td>
					<td>
						<input type=\"text\" name=\"TPF\" value=\"";
		echo $time_per_frame;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"PPD\">PPD</label>
					</td>
					<td>
						<input type=\"text\" name=\"PPD\" value=\"";
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
			echo "<input type=\"radio\" name=\"Overclocked\" value=\"yes\" checked=\"true\">Yes</input><br>";
		}
		else
		{
			echo "<input type=\"radio\" name=\"Overclocked\" value=\"yes\">Yes</input><br>";
		}

		if ($overclocked == "no")
		{
			echo "<input type=\"radio\" name=\"Overclocked\" value=\"no\" checked=\"true\">No</input><br>";
		}
		else
		{
			echo "<input type=\"radio\" name=\"Overclocked\" value=\"no\">No</input><br>";
		}

		if ($overclocked == "")
		{
			echo "<input type=\"radio\" name=\"Overclocked\" value=\"unknown\" checked=\"true\">Unknown</input><br>";
		}
		else
		{
			echo "<input type=\"radio\" name=\"Overclocked\" value=\"unknown\">Unknown</input><br>";
		}
		echo "
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"Clock_Speed\">Core Clock Speed</label>
					</td>
					<td>
						<input type=\"text\" name=\"Clock_Speed\" value=\"";
		echo $clock_speed;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"Driver_Version\">Driver Version</label>
					</td>
					<td>
						<input type=\"text\" name=\"Driver_Version\" value=\"";
		echo $driver_version;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"FAH_Core\">FAH Core</label>
					</td>
					<td>
						<input type=\"text\" name=\"FAH_Core\" value=\"";
		echo $core;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"FAH_Core_Version\">FAH Core Version</label>
					</td>
					<td>
						<input type=\"text\" name=\"FAH_Core_Version\" value=\"";
		echo $core_version;
		echo "\">
					</td>
				</tr>
				<tr>
					<td style=\"text-align:right;\">
						<label for=\"Information_Source\">Information Source</label>
					</td>
					<td>
						<input type=\"text\" name=\"Information_Source\" value=\"";
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