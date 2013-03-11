<?php
	require_once("../../common.php");
	
	initialize($_SERVER);
	
	$what_is_fah = "What is Folding@Home?";
	$what_is_the_database = "What is The Folding@Home GPU Statistics Database?";
	$who_runs_the_database = "Who runs the database?";
	$how_accurate_is_the_database = "How accurate is the data in the database?";
	$what_to_do_with_errors = "I found an error in the database. What should I do?";
	$why_use_this_database = "There are other GPU databases for Folding@Home. Why should I use this one?";
	$when_will_new_data_appear = "How will I know when there is new data to look through?";
	$why_has_data_changed = "I saw data here before that has been changed. What happened?";
	$what_has_data_been_deleted = "I saw data here before that is now gone. What happened?";
	$how_to_contribute = "How can I contribute?";
	$where_is_my_contribution = "I submitted data to the database, but I don't see it. What happened?";
	$how_to_link_to_set_of_records = "How do I link to a set of records in the database?";
	$how_to_link_to_a_record = "How do I link to a particular record in the database?";
	$how_many_users = "How many people use the database?";
	$rules_of_data_copying = "May I copy the data from the database?";
	$are_there_more_databases = "Are there other databases here?";
	$what_to_do_with_questions = "I have a question that isn't listed here. What should I do?";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			create_head("The Folding@Home GPU Statistics Database - FAQ", "../../styles/default.css");
		?>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
	</head>
	<body>
		<div id="wrapper">
			<?php
				create_header("The Folding@Home GPU Statistics Database", "Frequently Asked Questions");
			?>
			<div id="bodyer">
				<div id="navigation">
					<ul id="faq_links">
						<li>
							<a href="#what_is_fah">
								<?php
									echo $what_is_fah;
								?>
							</a>
						</li>
						<li>
							<a href="#what_is_the_database">
								<?php
									echo $what_is_the_database;
								?>
							</a>
						</li>
						<li>
							<a href="#who_runs_the_database">
								<?php
									echo $who_runs_the_database;
								?>
							</a>
						</li>
						<li>
							<a href="#how_accurate_is_the_database">
								<?php
									echo $how_accurate_is_the_database;
								?>
							</a>
						</li>
						<li>
							<a href="#what_to_do_with_errors">
								<?php
									echo $what_to_do_with_errors;
								?>
							</a>
						</li>
						<li>
							<a href="#why_use_this_database">
								<?php
									echo $why_use_this_database;
								?>
							</a>
						</li>
						<li>
							<a href="#when_will_new_data_appear">
								<?php
									echo $when_will_new_data_appear;
								?>
							</a>
						</li>
						<li>
							<a href="#why_has_data_changed">
								<?php
									echo $why_has_data_changed;
								?>
							</a>
						</li>
						<li>
							<a href="#why_has_data_been_deleted">
								<?php
									echo $why_has_data_been_deleted;
								?>
							</a>
						</li>
						<li>
							<a href="#how_to_contribute">
								<?php
									echo $how_to_contribute;
								?>
							</a>
						</li>
						<li>
							<a href="#where_is_my_contribution">
								<?php
									echo $where_is_my_contribution;
								?>
							</a>
						</li>
						<li>
							<a href="#how_to_link_to_set_of_records">
								<?php
									echo $how_to_link_to_set_of_records;
								?>
							</a>
						</li>
						<li>
							<a href="#how_to_link_to_a_record">
								<?php
									echo $how_to_link_to_a_record;
								?>
							</a>
						</li>
						<li>
							<a href="#how_many_users">
								<?php
									echo $how_many_users;
								?>
							</a>
						</li>
						<li>
							<a href="#rules_of_data_copying">
								<?php
									echo $rules_of_data_copying;
								?>
							</a>
						</li>
						<li>
							<a href="#are_there_more_databases">
								<?php
									echo $are_there_more_databases;
								?>
							</a>
						</li>
						<li>
							<a href="#what_to_do_with_questions">
								<?php
									echo $what_to_do_with_questions;
								?>
							</a>
						</li>
					</ul>
				</div>
				<div id="what_is_fah">
					<?php
						create_faq_answer
						(
							 $what_is_fah
							,"
								Folding@Home is a great research project that strives to understand the reason why diseases form. 
								It does this by studying protein \"folding\" with computer simulations run at your own home on your computer.
								There are many dedicated people who are part of this project who I admire greatly.
								I highly encourage anyone interested to learn more about it. Here are a few links to help you get started:
								<ul>
									<li>
										<a href=\"http://folding.stanford.edu/\" target=\"_blank\">
											The Folding@Home Home Page
										</a>
									</li>
									<li>
										<a href=\"http://en.wikipedia.org/wiki/Folding@home\" target=\"_blank\">
											The Folding@Home Wikipedia Page
										</a>
									</li>
									<li>
										If you have any questions that you can't seem to find, head over to 
										<a href=\"http://foldingforum.org/index.php\" target=\"_blank\">
											The Folding@Home Support Forum
										</a>
									</li>
								</ul>
							"
						);
					?>
				</div>
				<div id="what_is_the_database">
					<?php
						create_faq_answer
						(
							 $what_is_the_database
							,"
								The Folding@Home GPU Statistics Database is a collection of data from Folding@Home donors whom were willing
								to take a few minutes to submit their graphic cards' statistics to the database.
								<br>
								<br>
								The database was begun on August 18, 2012. It started out as a few records imported from other third-party databases and has grown to
								be what it is today thanks to the growing number of contributions made by the Folding@Home community.
								<br>
								<br>
								Also, note that the database is a third-party project that is not affiliated with the Pande Group or its partners.
							"
						);
					?>
				</div>
				<div id="who_runs_the_database">
					<?php
						create_faq_answer
						(
							 $who_runs_the_database
							,"
								The Folding@Home GPU Statistics Database is managed, developed, and maintained solely by Patrick Rebsch.
								However, the credit truly belongs to the database's generous contributors. The database would be nothing without them.
							"
						);
					?>
				</div>
				<div id="how_accurate_is_the_database">
					<?php
						create_faq_answer
						(
							 $how_accurate_is_the_database
							,"
								The Folding@Home GPU Statistics Database is composed of data from many sources. These sources could all be correct or incorect
								at any point in time. The database attempts to either remove incorrect data or repair incorrect data. This procedure is not
								guaranteed to purge the database of incorrect data or artificial records.
								<br>
								<br>
								If you are basing a purchase off of the data found in this database, please be aware that the database is not responsible for
								any \"regret purchases\". There are numerous variables to consider when purchasing a piece of hardware. This database
								is meant to help guide you in a direction, but it should not not be relied upon and certainly should not be the only source of
								information.
							"
						);
					?>
				</div>
				<div id="what_to_do_with_errors">
					<?php
						create_faq_answer
						(
							 $what_to_do_with_errors
							,"
								If you find an error in the database, please first check the <a href=\"errors.php\">known database errors page</a> for the error.
								If you do not find the error listed there, please email <a href=\"mailto:problems@compdewddevelopment.com\" target=\"_blank\">
								problems@compdewddevelopment.com</a>.
							"
						);
					?>
				</div>
				<div id="why_use_this_database">
					<?php
						create_faq_answer
						(
							 $why_use_this_database
							,"
								This database is
							"
						);
					?>
				</div>
				<div id="when_will_new_data_appear">
					<?php
						create_faq_answer
						(
							 $when_will_new_data_appear
							,"
								
							"
						);
					?>
				</div>
				<div id="why_has_data_changed">
					<?php
						create_faq_answer
						(
							 $why_has_data_changed
							,""
						);
					?>
				</div>
				<div id="why_has_data_been_deleted">
					<?php
						create_faq_answer
						(
							 $why_has_data_been_deleted
							,""
						);
					?>
				</div>
				<div id="how_to_contribute">
					<?php
						create_faq_answer
						(
							 $how_to_contribute
							,""
						);
					?>
				</div>
				<div id="where_is_my_contribution">
					<?php
						create_faq_answer
						(
							 $where_is_my_contribution
							,""
						);
					?>
				</div>
				<div id="how_to_link_to_set_of_records">
					<?php
						create_faq_answer
						(
							 $how_to_link_to_set_of_records
							,""
						);
					?>
				</div>
				<div id="how_to_link_to_a_record">
					<?php
						create_faq_answer
						(
							 $how_to_link_to_a_record
							,""
						);
					?>
				</div>
				<div id="how_many_users">
					<?php
						create_faq_answer
						(
							 $how_many_users
							,""
						);
					?>
				</div>
				<div id="rules_of_data_copying">
					<?php
						create_faq_answer
						(
							 $rules_of_data_copying
							,""
						);
					?>
				</div>
				<div id="are_there_more_databases">
					<?php
						create_faq_answer
						(
							 $are_there_more_databases
							,""
						);
					?>
				</div>
				<div id="what_to_do_with_questions">
					<?php
						create_faq_answer
						(
							 $what_to_do_with_questions
							,""
						);
					?>
				</div>
			</div>
			<?php
				create_footer("www.compdewddevelopment.com/redirect.php?target=fah-gpu-database-faq");
			?>
		</div>
	</body>
</html>