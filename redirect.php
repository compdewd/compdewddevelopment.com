<?php
	include "common.php";
	
	if (isset($_GET['target']))
	{
		if ($_GET['target'] == "home")
		{
			echo '<meta http-equiv="refresh" content="0; URL=index.php">';
		}
		else if ($_GET['target'] == "about")
		{
			echo '<meta http-equiv="refresh" content="0; URL=comingsoon.php">';
		}
		else if ($_GET['target'] == "projects")
		{
			echo '<meta http-equiv="refresh" content="0; URL=comingsoon.php">';
		}
		else if ($_GET['target'] == "arcregenerator")
		{
			echo '<meta http-equiv="refresh" content="0; URL=comingsoon.php">';
		}
		else if ($_GET['target'] == "fah-gpu-database")
		{
			echo '<meta http-equiv="refresh" content="0; URL=projects/fah-gpu-statistics-database/index.php">';
		}
		else if ($_GET['target'] == "about-fah-gpu-database")
		{
			echo '<meta http-equiv="refresh" content="0; URL=projects/fah-gpu-statistics-database/about.php">';
		}
		else if ($_GET['target'] == "add-to-fah-gpu-database")
		{
			echo '<meta http-equiv="refresh" content="0; URL=projects/fah-gpu-statistics-database/add.php">';
		}
		else if ($_GET['target'] == "fah-gpu-database-errors")
		{
			echo '<meta http-equiv="refresh" content="0; URL=projects/fah-gpu-statistics-database/errors.php">';
		}
		else if ($_GET['target'] == "fah-gpu-database-disclaimer")
		{
			echo '<meta http-equiv="refresh" content="0; URL=projects/fah-gpu-statistics-database/disclaimer.php">';
		}
		else if ($_GET['target'] == "fah-tpf-calculator")
		{
			echo '<meta http-equiv="refresh" content="0; URL=comingsoon.php">';
		}
		else
		{
            initialize($_SERVER);
?>
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<?php
                        create_head("CompdewdDevelopment - The Redirection Page", "styles/default.css");
                    ?>
				</head>
				<body>
					<?php
                        create_header("CompdewdDevelopment", "The Redirection Page");
                    ?>
					<div id="bodyer">
						<h1 style="text-align:center;">Welcome to the Redirection Page!</h1>
						You are here because:
						<ul>
							<?php
								if ($_GET['target'] == "")
								{
									echo "<li>You were directed here from a link that did not have a target</li>";
									echo "<li>You typed this location into your browser without a target</li>";
								}
								else
								{
									echo "<li>You were directed here from a link that had an invalid target</li>";
									echo "<li>You typed this location into your browser with an invalid target</li>";
								}
							?>
						</ul>
						<br>
						If you were directed here from a link, please notify the entity in charge of the link of the problem link.<br>
						If you typed this location into your browser, you may stop trying to hack this site ;)
					</div>
					<?php
                        create_footer("www.compdewddevelopment.com/redirect.php");
                    ?>
				</body>
			</html>
<?php
		}
	}
?>