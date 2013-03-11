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
								This database is one of many third-party GPU databases for Folding@Home. You are free to choose whichever fits your needs. 
								I am not going to say that this is the database you should use and that it is better than the rest. No. However, what I
								will say is that this database strives to fulfill the needs of as many users as possible with as many features as possible
								so that the job for the user is easier. There are some things about this database that I find unique and that many will find
								attractive. I have not seen a GPU database like this one that offers the features and options that this one offers. I did 
								not create this database to compete or try to overtake the other databases. I saw the need for an organized database that
								offered information that people often asked about. I realized that I could use my skills to offer something to the world
								that helped others and I did it. It has been a great experience so far and I hope that others feel the same.
								<br>
								<br>
								You may be wondering what this database offers that other databases (as far as I've seen) do not. The primary feature is 
								interactive filtering of data. I believe any collection of data should have a simple way of organizing that data to be
								browsed through. If a collection of data is not presented with filtering options, it is just a bunch of data that can be
								intimidating if it is a large amount and that can be very disorganized for the user.
								<br>
								<br>
								<a href=\"index.php\">Check out the database</a> to see what I'm talking about!
								</ul>
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
								At this time, the only way to know if new data has been added is to keep up with the updates thread on the Folding@Home
								Support Forum which can be found <a href=\"http://foldingforum.org/viewtopic.php?f=14&t=22281\" target=\"_blank\">here</a>.
								<br>
								<br>
								There are plans for a way to notify users of updates if they decide they want to be notified. There are also plans of 
								a page that lists the updates to the database that users can check if they want to know if new updates have taken place.
								There is no time frame for this, however.
							"
						);
					?>
				</div>
				<div id="why_has_data_changed">
					<?php
						create_faq_answer
						(
							 $why_has_data_changed
							,"
								If you study the data in the database long enough, you may at times notice a change. This is because of an effort to 
								correct an error in the data. The error may result in an entry into the database that was not correct from the start
								and not fixed until later, or it may result from a change in the Folding@Home points calculation as a whole or for 
								individual projects.
							"
						);
					?>
				</div>
				<div id="why_has_data_been_deleted">
					<?php
						create_faq_answer
						(
							 $why_has_data_been_deleted
							,"
								The primary reason for data disappering from the database is because of an effort to maintain high data integrity. 
								One way of measuring data integrity of certain data is to measure its value to the database. A highly valued record
								in the database is one that contains as much information as possible and has significant meaning to a user. A lowly 
								valued record is one that has most information fields missing and that would not have significant meaning to a user.
								If a record is missing information that would prevent it from being used in the case of a points calculation change,
								that record is in danger of being deleted from the database.
								<br>
								<br>
								An example of a lowly valued record is one that is missing information about clock speed, if it is overclocked or not,
								and driver used for the GPU. Without this information, a user would have to assume things about the record. That record
								is not particularly useful to a user that is considering purchasing the same graphics card as the record. The user
								would not know what drivers produce the best output, how much they could potentially overclock, and if the 
								information contained in the record is from an overclocked card or not. This causes the user to look for more
								information which makes the user's job harder, which causes the user stress and frustration. I would like to avoid 
								that scenario and instead make the user happy. That's why I like valuable records in the database and not invaluable
								records.
							"
						);
					?>
				</div>
				<div id="how_to_contribute">
					<?php
						create_faq_answer
						(
							 $how_to_contribute
							,"
								If you would like to contribute to The Folding@Home GPU Statistics Database, you must first be a contributor to the
								Folding@Home project since the data contained in the database is performance data relative to the Folding@Home project.
								You must use a GPU to contribute if you would like to contribute to this database.
								<br>
								<br>
								Now that the prerequisites are covered, contribution to the database is easy. There are a few options you have to
								contribute to the database and whatever works for you works for me. Your options are:
								<ul>
									<li>
										Use the form found <a href=\"add.php\">here</a>. Make sure to include the chipset, model, project, and the 
										time per frame.
									</li>
									<li>
										Email <a href=\"mailto:admin@compdewddevelopment.com\" target=\"_blank\">admin@compdewddevelopment.com</a>.
										You may email two different things:
										<ul>
											<li>
												A list of your data
											</li>
											<li>
												If you are an HFM.NET user, you may email the \"WuHistory.db3\" file. Directions for finding the file
												can be found here.
											</li>
										</ul>
									</li>
								</ul>
							"
						);
					?>
				</div>
				<div id="where_is_my_contribution">
					<?php
						create_faq_answer
						(
							 $where_is_my_contribution
							,"
								If you used the form on this site to submit data, please be aware that your data is not immediately inserted into the
								database. In fact, your data is sent to another database to be manually filtered through and inserted into the main
								database. There are two reasons for doing this:
								<ul>
									<li>
										It ensures that the data in the main database is always of a high integrity:
										<ul>
											<li>There are no records of people laying their face on their keyboard.<li>
											<li>There are no records with misspellings or typing errors.</li>
											<li>All records follow the same format.</li>
										</ul>
									</li>
									<li>
										It ensures that if there is a vulnerability found in the code, that attackers cannot affect the main database,
										only the database of user submissions.
									</li>
								</ul>
								The database of user submissions is emptied once the records from it are inserted into the main database.
							"
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
							,"
								The data contained in this database is open for the public to copy and even to use in their own database.
								There are no restrictions on what you do with the data contained in this database. I would appreciate if you didn't
								copy the data just to have a competing database, but you do have that option, I suppose. Do note that there
								<em>is</em> a restriction on the code used to create the interactive filtering for the database. It is open source,
								however that does not mean that you can copy and use the code or even copy, modify, and then use the code.
								You may redistribute the code giving credit where credit is due. If you want to find the code used, it can be
								found on GitHub here.
							"
						);
					?>
				</div>
				<div id="are_there_more_databases">
					<?php
						create_faq_answer
						(
							 $are_there_more_databases
							,"
								At this time there are no other databases offered by Patrick and there are no plans for any.
								If you have an idea for a database, send an email to <a href=\"mailto:suggestionbox@compdewddevelopment.com\"
								target=\"_blank\">suggestionbox@compdewddevelopment.com</a>.
							"
						);
					?>
				</div>
				<div id="what_to_do_with_questions">
					<?php
						create_faq_answer
						(
							 $what_to_do_with_questions
							,"
								If you have a question that was not listed here or that was not answered to meet your satisfaction, send an
								email to <a href=\"mailto:support@compdewddevelopment.com\" target=\"_blank\">support@compdewddevelopment.com\"
								</a>.
							"
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