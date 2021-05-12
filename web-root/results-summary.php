<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Test Results Summary</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="stylesheet" href="css/style.css">
	
	<!--Import from Google Fonts: -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;1,300&family=Poppins&display=swap" rel="stylesheet">
  
	<link rel="favicon" href="images/favicon.png">
	

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
		echo 'mysqli errors <br>';
		echo 'Errno: '.$mysqli->connect_errno;
		echo '<br>';
		echo 'Error: '.$mysqli->connect_error;
		#exit();
	} else {
		#echo 'No mysqli connection errors';
	}

	?>
</head>

<body>
	<header>
		<h1>Summary of All Test Results</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index.php" title="Home">Home</a></li>
			<li><a href="test-start.php" title="Start the test">Start Test</a></li>
			<li><a href="results-summary.php" title="Summary of All Results">Summary of All Results</a></li>
			<li><a href="group-reflection.php" title="Group Reflection">Group Reflection</a></li>
			<li><a href="individual-reflection.php" title="Individual Reflections">Individual Reflections</a></li>
		</ul>
	</nav>
	<main>
		<h3>All Test Results</h3>
		<p>Here are some average results from everyone else who completed the test</p>
		
		<?php
		
		#Create array to store values
		$averages = array(
			array('1 <img src="http://group8.raroyston.org/images/Jace-Boyd.png">'),
			array('2 <img src="http://group8.raroyston.org/images/Richard-Jones.png">'),
			array('3 <img src="http://group8.raroyston.org/images/Antoine%20Jackson.jpg">'),
			array('4 <img src="http://group8.raroyston.org/images/Sandra%20Bland.jpg">'),
			array('5 <img src="http://group8.raroyston.org/images/Xiaoxing-Xi.png">'),
			array('6 <img src="http://group8.raroyston.org/images/Alissa%20Weese.jpg">'),
		);
		
		#GET AVERAGES FOR EACH PHOTO 
		for ($photo = 1; $photo < 7; $photo++) {
			$array_index = $photo - 1;
			$query = 'SELECT AVG(similarity_score) FROM group8results WHERE photoid = ' . $photo;
			$result= $mysqli->query($query);
			array_push($averages[$array_index], $result->fetch_row()[0]);
			
			$query = 'SELECT AVG(timedelta) FROM group8results WHERE photoid = ' . $photo;
			$result= $mysqli->query($query);
			array_push($averages[$array_index], round($result->fetch_row()[0] / 1000000000, 3));
		
			$query = 'SELECT AVG(wordcount) FROM group8results WHERE photoid = ' . $photo;
			$result= $mysqli->query($query);
			array_push($averages[$array_index], $result->fetch_row()[0]);
		
			$query = 'SELECT COUNT(verdict) FROM group8results WHERE photoid = ' .  $photo . ' AND verdict = \'guilty\'';
			$result= $mysqli->query($query);
			array_push($averages[$array_index], $result->fetch_row()[0]);
			
			$query = 'SELECT COUNT(verdict) FROM group8results WHERE photoid = ' .  $photo . ' AND verdict = \'innocent\'';
			$result= $mysqli->query($query);
			array_push($averages[$array_index], $result->fetch_row()[0]);
		}
		?>
		<table>
		<tr class="table-head">
			<td>photo/person id</td>
			<td>average similarity score</td>
			<td>average description time (seconds)</td>
			<td>average description word count</td>
			<td>count of guilty</td>
			<td>count of innocent</td>
		</tr>
		
		<?php
		
		#adapted from https://www.w3schools.com/php/php_arrays_multidimensional.asp
		for ($row = 0; $row < 7; $row++) {
			echo '<tr class="hover">';
			for ($col = 0; $col < 6; $col++) {
				echo "<td>".$averages[$row][$col]."</td>";
			}
 			echo "</tr>";
		}

		?>
		</table>
		
		<hr />
		<h4>Self-Assessments</h4>
		<p>At the beginning of the test, we ask each user to assess how much you agreed with a series of statements. For the purposes of comparison, we have converted these responses to numerical representations. These range from 1 to 5, with 1 being "Strongly Disagree" and 5 being "Strongly Agree."</p>
		
		<?php
			#Next, we get the averages for everyone else on each of the questions
			$query = "SELECT AVG(`q1`) FROM group8results";
			$result = $mysqli->query($query);
			$q1average = $result->fetch_array(MYSQLI_NUM)[0];
			
			$query = "SELECT AVG(`q2`) FROM group8results";
			$result = $mysqli->query($query);
			$q2average = $result->fetch_array(MYSQLI_NUM)[0];
			
			$query = "SELECT AVG(`q3`) FROM group8results";
			$result = $mysqli->query($query);
			$q3average = $result->fetch_array(MYSQLI_NUM)[0];
			
			$query = "SELECT AVG(`q4`) FROM group8results";
			$result = $mysqli->query($query);
			$q4average = $result->fetch_array(MYSQLI_NUM)[0];
			
			$query = "SELECT AVG(`q5`) FROM group8results";
			$result = $mysqli->query($query);
			$q5average = $result->fetch_array(MYSQLI_NUM)[0];

		?>
		<table>
			<tr class="table-head">
				<td>Self-Assessment Statement</td>
				<td>Average Response (1 - 5)</td>
			</tr>
			<tr>
				<td>I consider myself to be an impulsive person</td>
				<td><?php echo $q1average; ?></td>
			</tr>
			<tr>
				<td>I tend to follow the rules</td>
				<td><?php echo $q2average; ?></td>
			</tr>
			<tr>
				<td>I consider myself to be a happy person</td>
				<td><?php echo $q3average; ?></td>
			</tr>
			<tr>
				<td>I am a good liar</td>
				<td><?php echo $q4average; ?></td>
			</tr>
			<tr>
				<td>I consider myself a sociable person</td>
				<td><?php echo $q5average; ?></td>
			</tr>
		</table>
		
		<hr />
		
		
		
		<h3>Interpreting results</h3>
		<p>You may be wondering what all those above numbers mean. Here are some questions you may like to ask yourself:</p>
		<div class="ReflectionQuestions">
		<ul>
			<li>Did you write more about yourself than you did about the people in the photos?</li>
			<li>Did you see the people in the photos as being similar to you? Or not so much?</li>
			<li>What characteristics of the photos did you pay most attention to?</li>
			<li>How did you decide whether a person was innocent or guilty?</li>
			<li>Do you believe in the saying 'innocent until proven guilty'?</li>
			<li>Were you trying to guess randomly? Do you think you actually were?</li>
			<li>Did it take you longer to write about some of the people than others?</li>
			<li>What assumptions, if any, did you make about the people in the photos?</li>
		</ul>
		</div>
		<p>This test does not provide direct answers to these questions. Instead, our hope is that by quantifying at least some aspects of how you responded to these people that we have been able to create opportunities for you to reflect on how you view the world and how you perceive other people.</p>

		
		
		
		
		
		<hr />
		

		
		<p>Return to the <a href="index.php" title="Home Page">Home Page</a>
	</main>
	
	
	<footer>
		&copy; <?php echo date('Y') ?>
		
	
		<?php $mysqli->close(); ?>
	</footer>
</body>
</html>