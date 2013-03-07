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
						<tr class="topmost">
							<td class="leftmost">
								<h2>About</h2>
							</td>
							<td class="middlemost">
								<h2>Projects</h2>
							</td>
							<td class="rightmost">
								<h2>Contact</h2>
							</td>
						</tr>
						<tr class="middlemost">
							<td class="leftmost" style="min-width:215px;">
								<i>Compdewd Development</i> is a set of software and database projects by Patrick Rebsch (compdewd).<br><br>
								All projects are provided to the public for free. It is Patrick's intent to learn from the projects and have other people learn from them as well.<br><br>
								So check out the projects and enjoy!
							</td>
							<td class="middlemost" style="min-width:215px;">
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
							<td class="rightmost" style="min-width:215px;">
								Contact information is as follows:
								<ul>
									<li><a href="mailto:support@compdewddevelopment.com" target="_blank">support@compdewddevelopment.com</a> - For help with the site or help with a project. General questions may go here too.</li>
									<li><a href="mailto:suggestionbox@compdewddevelopment.com" target="_blank">suggestionbox@compdewddevelopment.com</a> - For suggestions for the site or for a project.</li>
									<li><a href="mailto:problems@compdewddevelopment.com" target="_blank">problems@compdewddevelopment.com</a> - For problems with the site or with a project.</li>
									<li><a href="mailto:admin@compdewddevelopment.com" target="_blank">admin@compdewddevelopment.com</a> - For matters that do not fall into the other categories.</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td colspan="5">
								<?php
									create_vertical_space("15px");
								?>
							</td>
						</tr>
						<tr class="middlemost">
							<td colspan="3" class="topmost">
								<table>
									<tr>
										<td colspan="2" style="text-align:center;">
											<h2>Important Notes</h2>
										</td>
									</tr>
									<tr>
										<td style="vertical-align:top; width:8px;">
											<img src="images/blue-transparent-plus.png" alt="" style="padding-bottom:2px;">
										</td>
										<td style="text-align:left;">
											Since this site is still young and is morphing quite frequently, locations of pages may be changing frequently. If you link to a page using just the URL found in the address bar, the link may be broken within minutes.<br>
											To solve this problem this site has made a redirect.php page. At the bottom of each page on this site, there will be a URL that will always get you to the page you're on. Please use that URI to link to. Thank you.<br><br>
											Fun Fact: This site also uses the redirect.php page for all of it's links so that if a page changes paths, all that will need to be changed is the redirect.php page rather than all the pages that happen to link to the page that changed paths. Cool, right?!
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="5">
								<?php
									create_vertical_space("15px");
								?>
							</td>
						</tr>
						<tr class="bottommost">
							<td colspan="3" class="bottommost">
								<table>
									<tr>
										<td colspan="2" style="text-align:center;">
											<h2>Side Notes</h2>
										</td>
									</tr>
									<tr>
										<td style="vertical-align:top; width:8px;">
											<img src="images/blue-transparent-plus.png" alt="" style="padding-bottom:2px;">
										</td>
										<td style="text-align:left;">
											To developers or geeks: If you would like to know the PHP source code for any page on the site, simply send an email request to <a href="mailto:admin@compdewddevelopment.com" target="_blank">admin@compdewddevelopment.com</a> with the URL of the corresponding page included (can be either the address bar URL or the corresponding redirect page URL, just as long as I know what you're talking about).<br>
											The release of the code is at the site owner's discretion, so some code (such as database queries) may not be given for security reasons. If this is the case, the omitted code will be replaced with some kind of pseudo-code or an explanation.
										</td>
									</tr>
								</table>
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