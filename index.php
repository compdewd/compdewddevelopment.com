<?php
	require_once "common.php";
    
    initialize($_SERVER);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
            create_head("CompdewdDevelopment - Home", "styles/default.css");
        ?>
		<link rel="stylesheet" type="text/css" href="index.css">
	</head>
	<body>
		<div id="wrapper">
			<?php
				create_header("CompdewdDevelopment", "Home");
			?>
			<div id="bodyer">
				<div id="navigation">
					<table>
						<tr>
							<td>
								<a href=""><span id="navigationButton_Home"></span></a>
							</td>
						</tr>
					</table>
				</div>
				<div id="content">
					<table id="homeTable" cellspacing="0px">
						<tr>
							<td>
								<h2>About</h2>
								<i>Compdewd Development</i> is a set of software and database projects by Patrick Rebsch (compdewd).<br><br>
								All projects are provided to the public for free. It is Patrick's intent to learn from the projects and have other people learn from them as well.<br><br>
								So check out the projects and enjoy!
							</td>
						</tr>
						<tr>
							<td>
								<h2>Projects</h2>
								<table id="projects">
									<tr>
										<td style="text-align:right;">
											<img src="images/idle-development.png" alt="Idle Development" height="20" width="80">
										</td>
										<td style="text-align:center;">
											<a href="http://sourceforge.net/projects/arcregenerator/" target="_blank">The Almost Redundant Code Regenerator</a>
										</td>
									</tr>
									<tr>
										<td style="text-align:right;">
											<img src="images/active-development.png" alt="Active Development" height="20" width="80">
										</td>
										<td style="text-align:center;">
											<a href="redirect.php?target=fah-gpu-database">
											<img src="images/database-icon.png" height="16px" width="16px">
											Folding@Home GPU Statistics Database</a>
										</td>
									</tr>
									<tr>
										<td style="text-align:right;">
											<img src="images/active-development.png" alt="Active Development" height="20" width="80">
										</td>
										<td style="text-align:center;">
											<a href="">CompdewdDevelopment.com</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<h2>Contact</h2>
								<ul>
									<li><a href="mailto:support@compdewddevelopment.com" target="_blank">support@compdewddevelopment.com</a> - For help with the site or help with a project. General questions may go here too.</li>
									<li><a href="mailto:suggestionbox@compdewddevelopment.com" target="_blank">suggestionbox@compdewddevelopment.com</a> - For suggestions for the site or for a project.</li>
									<li><a href="mailto:problems@compdewddevelopment.com" target="_blank">problems@compdewddevelopment.com</a> - For problems with the site or with a project.</li>
									<li><a href="mailto:admin@compdewddevelopment.com" target="_blank">admin@compdewddevelopment.com</a> - For matters that do not fall into the other categories.</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td>
								<img src="images/blue-transparent-plus.png" alt="" style="padding-bottom:2px;">
							</td>
							<td>
								<h2>Important Notes</h2>
								Since this site is still young and is morphing quite frequently, locations of pages may be changing frequently. If you link to a page using just the URL found in the address bar, the link may be broken within minutes.<br>
								To solve this problem this site has made a redirect.php page. At the bottom of each page on this site, there will be a URI that will always get you to the page you're on. Please use that URI to link to. Thank you.<br><br>
								Fun Fact: This site also uses the redirect.php page for all of it's links so that if a page changes paths, all that will need to be changed is the redirect.php page rather than all the pages that happen to link to the page that changed paths. Cool, right?!
							</td>
						</tr>
						<tr>
							<td>
								<h2>Side Notes</h2>
								<td>
									<img src="images/blue-transparent-plus.png" alt="" style="padding-bottom:2px;">
								</td>
								<td style="text-align:left;">
									To developers or geeks: If you would like to know the source code for any page on the site, simply visit <a href="https://github.com/compdewd/compdewddevelopment.com/" target="_blank">this GitHub repository</a>.
								</td>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<?php
				create_footer("www.compdewddevelopment.com");
			?>
		</div>
	</body>
</html>
