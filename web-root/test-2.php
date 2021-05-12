<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Test Part 1 - Self-Description</title>
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
			echo "<script type='text/javascript'> document.location = 'test-start.php';</script>"; #kick user to start if uid is not set
		}
		
		
		#Store the question answers from the first page into variables so we can pass those along to eventually save to the table
		$q1 = $_REQUEST['q-1'];
		$q2 = $_REQUEST['q-2'];
		$q3 = $_REQUEST['q-3'];
		$q4 = $_REQUEST['q-4'];
		$q5 = $_REQUEST['q-5'];
		
		#Process to track how much time the user spends on each page
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
		<h3>Describe yourself</h3>
		<p>Please write a bit about yourself. How would you describe yourself? What might a person think about you when they meet you for the first time? Aim for approximately 25 words please:</p>
        </desc>
        
		<form method="POST" action="test-3.php">
			<!-- Hidden Form Elements to pass along values to the next page -->
			<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
			<input type="hidden" name="previoustime" value="<?php echo $starttime; ?>" />
			<input type="hidden" name="formwordcount" id="formwordcount" value="0" />
			
			<input type="hidden" name="q1" value="<?php echo $q1; ?>" />
			<input type="hidden" name="q2" value="<?php echo $q2; ?>" />
			<input type="hidden" name="q3" value="<?php echo $q3; ?>" />
			<input type="hidden" name="q4" value="<?php echo $q4; ?>" />
			<input type="hidden" name="q5" value="<?php echo $q5; ?>" />
			
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
		
	</footer>
</body>
</html>