<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Test Instructions</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="stylesheet" href="css/style.css">
	
	<!--Import from Google Fonts: -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;1,300&family=Poppins&display=swap" rel="stylesheet">
  
	<link rel="favicon" href="images/favicon.png">

</head>

<body>
	<header>
		<h1>Test Instructions</h1>
	</header>
	<nav>
		At any point, you can <a href="index.php" title="Exit the test">click here</a> to exit the test.
		<hr />
	</nav>
	<main>
	    <desc>
		<p>You have decided to take the Implicit Bias Test about Crime. In this study, you will be asked to categorize people as innocent or guilty based on real photos. In addition, there are 
		some questions about your own personality and characteristics. For the majority of the questions, we will be asking for you to write a description on either yourself or the picture.
		This study should take about 10 minutes to complete. At the end, you will receive your results along with a comparison from the community's results.</p>
	    </desc>
	    
		<?php
		$random = rand(0, 1000000000); #return a random number
		$timestamp = microtime(false); #get the current unix timestamp with microseconds for lots of precision
		$timestamp = str_replace(".", "", $timestamp); #remove the period
		$timestamp = str_replace(" ", "", $timestamp); #remove the space
		$uid = $random + $timestamp; #combine the two together to make it *very* unlikely for there to be duplicates	
		
		#clear the variables just in case:
		unset($starttime);
		unset($timedelta);
		unset($previoustime);
		
		?>
		<form method="POST" action="test-1.php">
			<input type="hidden" name="uid" value="<?php echo $uid; ?>" />
			<input type="submit" value="Begin the Test" />
		</form>
	
	</main>
	<footer>
		&copy; <?php echo date('Y') ?>
	</footer>
</body>
</html>