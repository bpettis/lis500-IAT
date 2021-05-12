<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Instructions for Part 2</title>
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
		#Save the time and word count from the previous page
		$previoustime = $_REQUEST['previoustime'];
		$selfwordcount = $_REQUEST['formwordcount'];
		
		
		#Store the question answers from the first page into variables so we can pass those along to eventually save to the table
		$q1 = $_REQUEST['q1'];
		$q2 = $_REQUEST['q2'];
		$q3 = $_REQUEST['q3'];
		$q4 = $_REQUEST['q4'];
		$q5 = $_REQUEST['q5'];
		
		
		$starttime = hrtime(true); #record the start time
		$starttime = str_replace(".", "", $starttime); #remove the period
		$starttime = str_replace(" ", "", $starttime); #remove the period
		$starttime = (int) $starttime; #convert to int
		
		$selftime = $starttime - $previoustime;
	?>
	
	

</head>

<body>
	<header>
		<h1>Instructions for Part 2</h1>
	</header>
	<nav>
		At any point, you can <a href="index.php" title="Exit the test">click here</a> to exit the test.
		<hr />
	</nav>
	<main>
	    <desc>
		<h3>Instructions</h3>
		<p>In the next section of the test, you will be shown a series of images of people. These are all people who have been accused of committing a crime. Below each image is a short description of the crime they were associated with. For each person you will be asked whether you think the person looks similar to yourself.</p>
		<p>Additionally, you will be asked to indicate whether you think they are guilty or innocent. You will also be asked to write a brief description of how you made this decision. </p>
		<p>It is okay to guess, but if so please include that in your written description. If you are guessing, please ask yourself if it is a truly random guess. If you recognize the person, please mention that as a part of your written description.</p>
        </desc>
        
		<form method="POST" action="test-4.php">
			<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
			<input type="hidden" name="previoustime" value="<?php echo $starttime; ?>" />
			<input type="hidden" name="selftime" value="<?php echo $selftime; ?>" />
			<input type="hidden" name="selfwordcount" value="<?php echo $selfwordcount; ?>" />
			<input type="hidden" name="q1" value="<?php echo $q1; ?>" />
			<input type="hidden" name="q2" value="<?php echo $q2; ?>" />
			<input type="hidden" name="q3" value="<?php echo $q3; ?>" />
			<input type="hidden" name="q4" value="<?php echo $q4; ?>" />
			<input type="hidden" name="q5" value="<?php echo $q5; ?>" />
			
			
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