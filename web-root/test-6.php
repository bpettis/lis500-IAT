<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Test Part 2 - Image 3</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="stylesheet" href="css/style.css">
	
	<!--Import from Google Fonts: -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;1,300&family=Poppins&display=swap" rel="stylesheet">
  
	<link rel="favicon" href="images/favicon.png">
	
	<?php
		#Retrieve the user id so we can keep track of which results are related:
		$uid = $_REQUEST['uid'];
		if (!isset($uid)) { #Check if the uid has been set
			echo "<script type='text/javascript'> document.location = 'test-start.php';</script>"; #kick user to start if uid is not set
		}
		
		
		
		#Save the variables from the last page's REQUEST superglobal
		#I've tried to name the variables in a way that will be as semantic as possible for us
		$previoustime = $_REQUEST['previoustime'] ?? 'NULL';
		$selftime = $_REQUEST['selftime'] ?? 'NULL'; 
		$selfwordcount = $_REQUEST['selfwordcount'] ?? 'NULL';
		$lastsimilarity = $_REQUEST['similarity'] ?? 'NULL';
		$lastwordcount = $_REQUEST['formwordcount'] ?? 'NULL';
		$lastpersonid = $_REQUEST['personid'] ?? 'NULL';
		$lastverdict = $_REQUEST['verdict'] ?? 'NULL';
		$lastverdict_actual = $_REQUEST['actual_verdict'] ?? 'NULL';
		
		
		#Store the question answers from the first page into variables so we can pass those along to eventually save to the table
		$q1 = $_REQUEST['q1'];
		$q2 = $_REQUEST['q2'];
		$q3 = $_REQUEST['q3'];
		$q4 = $_REQUEST['q4'];
		$q5 = $_REQUEST['q5'];
		
		
		#Create a variable to identify which test question we are on. This will need to be stored as part of the results table
		#Be sure to save the last question's id before setting a new one (just put the mySQL query before this I think)
		
		$personid = 3;
		$actual_verdict = 'guilty';
		
		$starttime = hrtime(true); #record the start time
		$starttime = str_replace(".", "", $starttime); #remove the period
		$starttime = str_replace(" ", "", $starttime); #remove the space
		$starttime = (int) $starttime; #convert to int
		
		#calculate the difference in time (in nanoseconds)
		$timedelta = $starttime - $previoustime;
	?>
	
<!-- mySQL stuff -->
	<?php
	$db_host = 'localhost';
	$db_user = 'raroyst1_cfbd_cg';
	$db_password = 'W!SCsin2018';
	$db_db = 'raroyst1_raroystonorgmain';
	$db_port = 3306;


	$mysqli = new mysqli(
		$db_host,
		$db_user,
		$db_password,
		$db_db
	);
	
	if ($mysqli->connect_error) {
		echo 'Errno: '.$mysqli->connect_errno;
		echo '<br>';
		echo 'Error: '.$mysqli->connect_error;
		exit();
	} else {
		echo 'No mysqli connection errors';
	}
	
#Save all these php variables that we've been juggling into the mySQL table
	$query = 'INSERT INTO group8results (uid, selfwordcount, selftime, q1, q2, q3, q4, q5, photoid, timedelta, similarity_score, wordcount, verdict, verdict_actual) VALUES (' . $uid . ', ' . $selfwordcount . ', ' . $selftime .  ', ' . $q1 .  ', ' . $q2 .  ', ' . $q3 .  ', ' . $q4 .  ', ' . $q5 .  ', ' . $lastpersonid .  ', ' . $timedelta .  ', ' . $lastsimilarity .  ', ' . $lastwordcount . ', \'' . $lastverdict . '\' , \'' . $lastverdict_actual . '\')';
	$mysqli->query($query);
  
	?>
</head>

<body>
	<header>
		<h1>Test Part 2 - Image 3</h1>
	</header>
	<nav>
		At any point, you can <a href="index.php" title="Exit the test">click here</a> to exit the test.
		<hr />
	</nav>
	<main>
		<p>Please look at the person in this photo:</p>
		<img src="images/Antoine Jackson.jpg">

		<form method="POST" action="test-7.php">
			<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
			<input type="hidden" name="personid" value="<?php echo $personid; ?>" />
			<input type="hidden" name="previoustime" value="<?php echo $starttime; ?>" />
			<input type="hidden" name="selftime" value="<?php echo $selftime; ?>" />
			
			<input type="hidden" name="q1" value="<?php echo $q1; ?>" />
			<input type="hidden" name="q2" value="<?php echo $q2; ?>" />
			<input type="hidden" name="q3" value="<?php echo $q3; ?>" />
			<input type="hidden" name="q4" value="<?php echo $q4; ?>" />
			<input type="hidden" name="q5" value="<?php echo $q5; ?>" />
			
			<input type="hidden" name="selfwordcount" value="<?php echo $selfwordcount; ?>" />
			<input type="hidden" name="formwordcount" id="formwordcount" value="0" />
			<input type="hidden" name="actual_verdict" value="<?php echo $actual_verdict; ?>" />
			
			<p><i>A woman on a Red Line train was sexually assaulted and robbed</i><br />
			<p>Please indicate how much you agree with this statement:<br />
			<strong>The person in the photo looks similar to me</strong></p>
			
			<select name="similarity" id="similarity">
				<option value="5">I Strongly Agree</option>
				<option value="4">I Somewhat Agree</option>
				<option value="3" selected>Neither Agree nor Disagree</option>
				<option value="2">I Somewhat Disagree</option>
				<option value="1">I Strongly Disagree</option>
			</select>
			<div class="verdict">
			<p>The person in this photo is associated with a crime. Do you think they are innocent or guilty? </p>
			<label><input type="radio" name="verdict" value="innocent" required/>Innocent</label>
			<label><input type="radio" name="verdict" value="guilty" />Guilty </label>
            </div>
			
			<p>Please explain how you decided the person was innocent or guilty in approximately 25 words:</p>
			<p><textarea cols="40" rows="5" id="textbox"></textarea></p>
			<p>Word Count: <span id="wordcount">0</span></p>
			
			<input type="submit" value="Continue Test" />
		</form>
		
	</main>
	<footer>
		At any point, you can <a href="index.php" title="Exit the test">click here</a> to exit the test.
		<hr />
		&copy; <?php echo date('Y') ?>
		
		<!-- Word counter adapted from: https://stackoverflow.com/questions/20699509/adding-word-counter-to-html-form/20699544 -->
		<script src="js/wordcount.js" type="text/javascript"></script>
		
		
		<?php $mysqli->close(); ?>
	</footer>
</body>
</html>