<?php
#I am using javascript to do the redirect because for some reason using php's header() function was not working
#The problem was that data was already being sent, and therefore the headers could not be edited after that
#I *think* that using output buffering would be a prefered solution here, but I don't know how to do that, so instead am sticking with what I know I can get working.


#Retrieve the user id so we can keep track of which results are related:
#Check where the user is coming from.
$uid = $_REQUEST['uid'];
if (!isset($uid)) { #Check if the uid has been set
	echo "<script type='text/javascript'> document.location = 'results-summary.php';</script>";
}



?>
<!DOCTYPE html>


<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Test Results</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="stylesheet" href="css/style.css">
	
	<!--Import from Google Fonts: -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;1,300&family=Poppins&display=swap" rel="stylesheet">
  
	<link rel="favicon" href="images/favicon.png">
	
	<?php
		
		
		#Save the variables from the last page's REQUEST superglobal
		$previoustime = $_REQUEST['previoustime'] ?? 'NULL';
		$selftime = $_REQUEST['selftime'] ?? 0;
		$selftime_sec = round($selftime / 1000000000, 3);
		$selfwordcount = $_REQUEST['selfwordcount'] ?? 'NULL';
		$lastsimilarity = $_REQUEST['similarity'] ?? 'NULL';
		$lastwordcount = $_REQUEST['formwordcount'] ?? 'NULL';
		$lastpersonid = $_REQUEST['personid'] ?? 'NULL';
		$lastverdict = $_REQUEST['verdict'] ?? 'NULL';
		$lastverdict_actual = $_REQUEST['actual_verdict'] ?? 'NULL';

		
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
		echo 'mysqli errors <br>';
		echo 'Errno: '.$mysqli->connect_errno;
		echo '<br>';
		echo 'Error: '.$mysqli->connect_error;
		#exit();
	} else {
		#echo 'No mysqli connection errors';
	}
	
	#First we save the last page's results
	$query = 'INSERT INTO group8results (uid, selfwordcount, selftime, photoid, timedelta, similarity_score, wordcount, verdict, verdict_actual) VALUES (' . $uid . ', ' . $selfwordcount . ', ' . $selftime .  ', ' . $lastpersonid .  ', ' . $timedelta .  ', ' . $lastsimilarity .  ', ' . $lastwordcount . ', \'' . $lastverdict . '\' , \'' . $lastverdict_actual . '\')';
	$mysqli->query($query);
	$oldquery = $query; #save for debugging

	#Next we retrieve all the results for the user id
	$query = 'SELECT * FROM group8results WHERE uid =' . $uid . ' AND photoid IS NOT NULL';
	$result = $mysqli->query($query);

	#First, loop through the results and calculate the user's "score"
	$score = 0;
	while($row = $result->fetch_assoc()){
		if($row['verdict'] == $row['verdict_actual']){
					$score = $score + 1;
		}
	}
	
				
	
	?>
</head>

<body>
	<header>
		<h1>Test Results</h1>
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
		<h3>Your Responses</h3>
		<h4><?php echo $score; ?> out of 6 correct</h4>
		<desc>
		<p>Here are the results of your test. When it came to your determinations of whether each person was guilty or innocent, you had <?php echo $score; ?> correct responses.</p> 
		<p>Additionally, we've measured approximately how long it took you to complete each portion, as well as the length of your responses. Please note that we have not stored nor analyzed the actual content of your descriptions.</p>
		<p>As a point of comparison, when you were describing yourself, it took you approximately <?php echo $selftime_sec?> seconds for you to write <?php echo $selfwordcount; ?> words.</p>
		</desc>
		
		<table>
		<tr class="table-head">
			<td>photo/person id</td>
			<td>similarity score</td>
			<td>description time (seconds)</td>
			<td>description word count</td>
			<td>your verdict</td>
			<td>actual verdict</td>
		</tr>
		
		<?php
		
		#store the photo URLs in an array:
		#image URL starting string: http://group8.raroyston.org/images/
		#This is clunky, but I am just putting a blank value in the zeroth position. This is so that the photoid variable as stored in the databased will correspond with the correct index here. Otherwise we end up with the classic off-by-one error
		#We *could* just subtract 1 from the id later on, but this is equally clunky but also works
		$photoURL = array("NULL", "Jace-Boyd.png", "Richard-Jones.png", "Antoine%20Jackson.jpg", "Sandra%20Bland.jpg", "Xiaoxing-Xi.png", "Alissa%20Weese.jpg");
		
		#adapted from: https://www.w3schools.com/php/php_mysql_select.asp
		
		#Something janky is going on. When I try to re-use the result of the query from earlier on, it doesn't work. But if I re-run the sql query it works okay. So that's weird.
		$query = 'SELECT * FROM group8results WHERE uid =' . $uid . ' AND photoid IS NOT NULL';
		$result = $mysqli->query($query);
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				echo '<tr class="hover">';
				echo '<td>' . $row['photoid'] . '<img src="http://group8.raroyston.org/images/' . $photoURL[(int)$row['photoid']] . '"></td>'; #The datatype returned in the query is a string. So we must convert to int before we can use it to call the correct array value
				echo '<td>' . $row['similarity_score'] . '</td>';
				echo '<td>' . round($row['timedelta'] / 1000000000, 3) . '</td>';
				echo '<td>' . $row['wordcount'] . '</td>';
				echo '<td>' . $row['verdict'] . '</td>';
				echo '<td>' . $row['verdict_actual'] . '</td>';
				echo '</tr>';
			}
		} else {
			echo '<tr><td>no results</td></tr>';
		}
		
		?>
		</table>
		
		<hr />
		<h3>How do I compare to others?</h3>
		
		<hr />
		<h4>Part 1: Self-Assessments</h4>
		<desc>
		<p>At the beginning of the test, we asked you to assess how much you agreed with a series of statements. For the purposes of comparison, we have converted your responses to numerical representations. These range from 1 to 5, with 1 being "Strongly Disagree" and 5 being "Strongly Agree." As a reminder, here were your responses:</p>
		</desc>
		
		<?php
			#First, we get the user's responses:
			$query = 'SELECT q1, q2, q3, q4, q5 FROM group8results WHERE uid =' . $uid;
			$result = $mysqli->query($query);
			$selfassessmentarray = $result->fetch_array(MYSQLI_NUM); #Store the mysqli object into a numeric array
			
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
				<td>Your Response (1 - 5)</td>
				<td>Average Response (1 - 5)</td>
			</tr>
			<tr>
				<td>I consider myself to be an impulsive person</td>
				<td><?php echo $selfassessmentarray[0];?></td>
				<td><?php echo $q1average; ?></td>
			</tr>
			<tr>
				<td>I tend to follow the rules</td>
				<td><?php echo $selfassessmentarray[1];?></td>
				<td><?php echo $q2average; ?></td>
			</tr>
			<tr>
				<td>I consider myself to be a happy person</td>
				<td><?php echo $selfassessmentarray[2];?></td>
				<td><?php echo $q3average; ?></td>
			</tr>
			<tr>
				<td>I am a good liar</td>
				<td><?php echo $selfassessmentarray[3];?></td>
				<td><?php echo $q4average; ?></td>
			</tr>
			<tr>
				<td>I consider myself a sociable person</td>
				<td><?php echo $selfassessmentarray[4];?></td>
				<td><?php echo $q5average; ?></td>
			</tr>
		</table>
		
		<hr />
		
		<h4>Part 2: Images of people</h4>
		</desc>
		<p>Here are some average results from everyone else who completed the test:</p>
		</desc>
		
		<?php
		
		#Create array to store values
		$averages = array(
			array('1'),
			array('2'),
			array('3'),
			array('4'),
			array('5'),
			array('6'),
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
			echo '<tr>';
			for ($col = 0; $col < 6; $col++) {
				echo "<td>".$averages[$row][$col]."</td>";
			}
 			echo "</tr>";
		}

		?>
		</table>
		
		
		<h3>Interpreting your results</h3>
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
		
		<!-- Word counter adapted from: https://stackoverflow.com/questions/20699509/adding-word-counter-to-html-form/20699544 -->
		<script src="js/wordcount.js" type="text/javascript"></script>
		
		<?php
		$mysqli->close();
		unset($uid); #Once we're done doing everything, unset the uid so it isn't hanging around in memory or anything. This should keep users from refreshing the page and inadvertently adding more lines to the table
		 ?>
	</footer>
</body>
</html>