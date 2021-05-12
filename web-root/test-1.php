<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Test Page 1</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="stylesheet" href="css/style.css">

	<!--Import from Google Fonts: -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;1,300&family=Poppins&display=swap" rel="stylesheet">

	<link rel="favicon" href="images/favicon.png">

	<?php
		$uid = $_REQUEST['uid'];
		if (!isset($uid)) { #Check if the uid has been set
			header('Location: test-start.php'); #kick the user back to the test start page if it wasn't
		}

		$starttime = hrtime(true); #record the start time
		$starttime = str_replace(".", "", $starttime); #remove the period
		$starttime = str_replace(" ", "", $starttime); #remove the space
		$starttime = (int) $starttime; #convert to int
	?>

</head>

<body>
	<header>
		<h1>Test Part 1 - Self-Description</h1>
	</header>
	<nav>
		At any point, you can <a href="index.php" title="Exit the test">click here</a> to exit the test.
		<hr />
	</nav>
	<main>
	    <desc>
		<h3>Self-Assessment</h3>
		<p>In this section, you will be provided a series of statements about how you might describe yourself. For each statement, please indicate how much you agree with the statement.</p>
        </desc>
        
		<form method="POST" action="test-2.php">
			<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
			<input type="hidden" name="previoustime" value="<?php echo $starttime; ?>" />
			<input type="hidden" name="formwordcount" id="formwordcount" value="0" />


			<p class="question-text">1. I consider myself to be an impulsive person.</p>

			<select name="q-1" id="q-2">
				<option value="5">I Strongly Agree</option>
				<option value="4">I Somewhat Agree</option>
				<option value="3" selected>Neither Agree nor Disagree</option>
				<option value="2">I Somewhat Disagree</option>
				<option value="1">I Strongly Disagree</option>
			</select>

			<hr />

			<p class="question-text">2. I tend to follow the rules.</p>

			<select name="q-2" id="q-2">
				<option value="5">I Strongly Agree</option>
				<option value="4">I Somewhat Agree</option>
				<option value="3" selected>Neither Agree nor Disagree</option>
				<option value="2">I Somewhat Disagree</option>
				<option value="1">I Strongly Disagree</option>
			</select>

			<hr />

			<p class="question-text">3. I consider myself to be a happy person</p>

			<select name="q-3" id="q-3">
				<option value="5">I Strongly Agree</option>
				<option value="4">I Somewhat Agree</option>
				<option value="3" selected>Neither Agree nor Disagree</option>
				<option value="2">I Somewhat Disagree</option>
				<option value="1">I Strongly Disagree</option>
			</select>

			<hr />

			<p class="question-text">4. I am a good liar</p>

			<select name="q-4" id="q-4">
				<option value="5">I Strongly Agree</option>
				<option value="4">I Somewhat Agree</option>
				<option value="3" selected>Neither Agree nor Disagree</option>
				<option value="2">I Somewhat Disagree</option>
				<option value="1">I Strongly Disagree</option>
			</select>

			<hr />

			<p class="question-text">5. I consider myself a sociable person</p>

			<select name="q-5" id="q-5">
				<option value="5">I Strongly Agree</option>
				<option value="4">I Somewhat Agree</option>
				<option value="3" selected>Neither Agree nor Disagree</option>
				<option value="2">I Somewhat Disagree</option>
				<option value="1">I Strongly Disagree</option>
			</select>

			<hr />

			<input type="submit" value="Continue Test" />
		</form>

	</main>
	<footer>
		At any point, you can <a href="index.php" title="Exit the test">click here</a> to exit the test.
		<hr />
		&copy; <?php echo date('Y') ?>


	</footer>
</body>
</html>
