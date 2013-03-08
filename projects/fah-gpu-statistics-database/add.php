<?php
	require_once "../../common.php";
	require_once "output_form.php";
	
	initialize($_SERVER);
?>
<!DOCTYPE html>
<html lang="en">
	<head>		
		<?php 
			create_head("Folding@Home GPU Statistics Database - Add", "../../styles/default.css");
		?>
		
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<style type="text/css">
			input[type="text"]
			{
				border: 1px solid #c0c0c0;
			}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<?php
				create_header("Folding@Home GPU Statistics Database", "Add");
				create_vertical_space("20px");
			?>
			<div id="bodyer">
				Please note that your information will not be directly added to the main database primarily for security reasons.<br>
				Your submission will be added to a secondary database that will be manually filtered.<br>
				Therefore it may take a while for your data to appear, however it should not be long!
				<br><br>
				If you use <a href="http://www.hfm-net.com/Home.aspx" target="_blank">HFM.NET</a>, you may email the work unit history database file to <a href="mailto:admin@compdewddevelopment.com" target="_blank">admin@compdewddevelopment.com</a>. 
				To find the database file, go in the program to "Help" in the menu bar, then select the option "View HFM.NET Data Files" and an explorer window will show. The "WuHistory.db3" file is the HFM.NET Work Unit History Database file.<br>
				The data is saved in that file according to your Folding@Home slot names so be sure to include the relation between slot name and GPU in your email.<br>
				Attach the database file in your email, give yourself credit in the email body if you don't want to remain anonymous, and that is all you must do!<br>
				If you have any questions about the procedure, just send an email and I'll be happy to give directions.
				<br><br>
				<a href="../../redirect.php?target=fah-gpu-database">Return to Browsing the Database</a>
				<br><br>
				<?php
					$chipset = "";
					$model = "";
					$project = "";
					$time_per_frame = "";
					$points_per_day = "";
					$overclocked = "";
					$clock_speed = "";
					$driver_version = "";
					$core = "";
					$core_version = "";
					$information_source = "";
					$date_submitted = date("F j, Y");
					
					if (isset($_POST['submitted']) && $_POST['submitted'] != "")
					{
						$required_is_set = true;
						
						if (isset($_POST['chipset']) && trim($_POST['chipset']) != "")
							$chipset = filter_var(trim($_POST['chipset']), FILTER_SANITIZE_STRING, array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH));
						else
							$required_is_set = false;
						if (isset($_POST['model']) && trim($_POST['model']) != "")
							$model = filter_var(trim($_POST['model']), FILTER_SANITIZE_STRING, array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH));
						else
							$required_is_set = false;
						if (isset($_POST['project']) && trim($_POST['project']) != "")
							$project = filter_var(trim($_POST['project']), FILTER_SANITIZE_NUMBER_INT);
						else
							$required_is_set = false;
						if (isset($_POST['time_per_frame']))
							$time_per_frame = filter_var(trim($_POST['time_per_frame']), FILTER_SANITIZE_STRING, array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH));
						if (isset($_POST['points_per_day']))
							$points_per_day = filter_var(trim($_POST['points_per_day']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
						if (isset($_POST['overclocked']))
							$overclocked = filter_var(trim($_POST['overclocked']), FILTER_SANITIZE_STRING, array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH));
						if (isset($_POST['clock_speed']))
							$clock_speed = filter_var(trim($_POST['clock_speed']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
						if (isset($_POST['driver_version']))
							$driver_version = filter_var(trim($_POST['driver_version']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
						if (isset($_POST['core']))
							$core = filter_var(trim($_POST['core']), FILTER_SANITIZE_STRING, array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH));
						if (isset($_POST['core_version']))
							$core_version = filter_var(trim($_POST['core_version']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
						if (isset($_POST['information_source']))
							$information_source = filter_var(trim($_POST['information_source']), FILTER_SANITIZE_STRING, array(FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH));
						
						if ($required_is_set == true)
						{
							$connection = new mysqli($dbGpuStatistics_host, $dbGpuStatistics_user, $dbGpuStatistics_password, $dbGpuStatistics_name);
							if ($connection)
							{
								$statement = $connection->prepare
									("
										INSERT INTO TUserSubmissions 
											(strChipset, strModel, strProject, strTimePerFrame, strPointsPerDay, strOverclocked, strClockSpeed, strDriverVersion, strCore, strCoreVersion, strInformationSource, dtmDateSubmitted)
										VALUES
											(?,?,?,?,?,?,?,?,?,?,?,NOW())
										;
									");
								$statement->bind_param("sssssssssss", $chipset, $model, $project, $time_per_frame, $points_per_day, $overclocked, $clock_speed, $driver_version, $core, $core_version, $information_source);
								$statement->execute();
								$connection->close();
								
								echo "Thank You for taking the time to submit your data!<br>Would you like to <a href=\"add.php\">contribute more</a>?<br>";
							}
							else
							{
								echo "<font style=\"color:red;\">There was an error connecting to the database. Please contact the site administrator at <a href=\"mailto:problems@compdewddevelopment.com\">problems@compdewddevelopment.com</a>.</font>";
							}
						}
						else
						{
							echo "<p style=\"font-size:small;\">Did all or part of your entry disappear? If so, the reason for this is when you click \"Submit\", your data is filtered on the server before it is recorded or given back to you in an attempt to prevent attackers from doing something called \"<a href=\"http://www.google.com/search?q=code+injection\" target=\"_blank\">code injecting</a>\".<br></p>";
							output_form(true, $chipset, $model, $project, $time_per_frame, $points_per_day, $overclocked, $clock_speed, $driver_version, $core, $core_version, $information_source);
						}
					}
					else
					{
						output_form(false, "", "", "", "", "", "unknown", "", "", "", "", "");
					}
				?>
			</div>
			<?php
				create_footer("www.compdewddevelopment.com/redirect.php?target=add-to-fah-gpu-database");
			?>
		</div>
	</body>
</html>