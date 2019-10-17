<?php
	require_once('../core/db_connect.php');
	require_once('../core/header.php');
	
	$bdd = new db();
	$sql = "SELECT * FROM questions";
	$questions = $bdd->getAll($sql);
	
	$sql = "SELECT * from courses";
	$courses = $bdd->getAll($sql);
	
	$questions_json = '$'.'questions = {';
	foreach($questions as $question) {
		$questions_json .= '"'. $question['question_id'] . '": {';
		$questions_json .= '"title": "' . $question['title'] . '",';
		$questions_json .= '"text": "' . $question['text'] . '",';
		$questions_json .= '"answers": "' . $question['answers'] . '",';
		
		foreach($courses as $course) {
			if($question['course_id'] == $course['course_id']) {
				$questions_json .= '"course": "' . $course['name'] . '",';
				break;
			}
		}
		
		$questions_json .= '"source": "' . $question['source']. '"';
		$questions_json .= '},';
	}
	$questions_json = substr($questions_json, 0, -1);
	$questions_json .= '};';
	
	$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';
	$header = getHeader($role);
	
	if(!isset($_SESSION['role'])){ //if login in session is not set
		header("Location: http://localhost/main/home.php");
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<title>School Quiz</title>
	
	<!-- css -->
	<link rel="icon" href="../assets/icons/site_icon.png">
	<link href="http://fonts.googleapis.com/css?family=Chivo:400,900" rel="stylesheet" />
	<link href="../styles/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../styles/css/style.css" rel="stylesheet">
	<link href="../styles/css/default.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../styles/css/fonts.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
	<div id="wrapper">
		<div id="header-wrapper">
			<div id="header" class="container-header">
				<div id="logo">
					<h1><a href="#">School Quiz</a></h1>
					<p>Δοκιμασε τις γνωσεις σου</p>
				</div>
			</div>
		</div>
		<div id="menu-wrapper">
			<div id="menu" class="container-header">
				 <?php echo $header; ?>
			</div>
			<!-- end #menu --> 
		</div>
		<section id="intro" class="intro">
		<div class ="intro-content">
		  <div class="container">
		<!-- Question intro -->
		<div id = "questions_intro" class=" panel panel-default">			
			<h2>Έναρξη Τεστ</h2>
			<div> Επιλέξτε τον αριθμό των ερωτήσεων από το ακόλουθο μενού και στη συνέχεια πατήστε το κουμπί "Έναρξη" για να ξεκινήσετε το τεστ.
			</div>
			<span> Αριθμός ερωτήσεων </span>
			<span style="width:200px;">
			  <select class = "questions-num-selector">
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="15">15</option>
			  </select>
			</span>
			<div class="form-group">
				<button id="btn-start-test" class="btn btn-info"> Εναρξη </button>
			</div>
		</div>
		<!-- Question intro end -->
		<!-- Questions  -->
			<div id = "questions" class="hide container">
				<div class="panel panel-default">
					<div class="panel-heading">Ερωτήσεις</div>
					<div class="panel-body">
						<div class="form-group question-group">
							<div class ="test-question">Επώνυμο</div>
							<input type="radio" name="gender" value="male"> Male<br>
							<input type="radio" name="gender" value="female"> Female<br>
							<input type="radio" name="gender" value="other"> Other<br>
							<div class = "question-right"> Σωστή απάντηση </div>
							<div class = "question-wrong"> Σωστή απάντηση </div>
							<hr>								  
						</div>
						<div class="form-group checkTest-container">
							<button type="submit" name="register" id="btn-check-test" class="btn btn-info">Ελεγχος</button>
						</div>
						<div class="form-group goHome-container hide">
							<button type="submit" name="register" id="btn-go-home" class="btn btn-info">Επιστροφη</button>
						</div>
					</div>
				</div>
			   <br />
			</div>
			</div>
			</section>
		</div>
	</div>

	<div id="copyright" class="container">
		<p>&copy; All rights reserved.</p>
	</div>
	
	<!-- Core JavaScript Files -->
	<script src="../core/scripts/jquery.min.js"></script>	 
    <script src="../core/scripts/bootstrap.min.js"></script>
	
	<script>
	<?php
	echo $questions_json;
	?>
	
	function startTest() {
		$('.panel-body .question-group').remove();
		$questions_num = $('.questions-num-selector').val();
		$keys = Object.keys($questions);
		shuffle($keys);
		
		if($keys.length < $questions_num) $questions_num = $keys.length;
		
		for(i = 0; i < $questions_num; ++i) {
			$question = $questions[$keys[i]];
			$question_div = '<div class="form-group question-container">';
			$question_div += '<div class ="test-question">' + $question.text + '</div>';
			
			$answers = $question.answers.split('#');
			$answer_indices = new Array();
			for(j = 0; j < 4; ++j) $answer_indices.push(j);
			shuffle($answer_indices);
			for(j = 0; j < 4; ++j) {
				$question_div += '<input type="radio" name="question-' + i + '" value="' +  $answer_indices[j] + '">' + $answers[$answer_indices[j]] +'<br>';
			}
			$question_div += '<div class = "hide question-right"> <span style = "color: green; font-weight: bold;"> Σωστή απάντηση </span></div>';
			$question_div += '<div class = "hide question-wrong"> <span style = "color: red; font-weight: bold;">Λάθος απάντηση.</span> <span style = "margin-right: 5px; margin-left: 5px; font-style: italic;">Μάθημα: </span>' + $question.course  + ' <span style = "margin-right: 5px; margin-left: 5px;font-style: italic;">Πηγή της ερώτησης:</span>' + $question.source + '</div><hr></div>';
			$('.panel-body').prepend($question_div);
		}
		
		$('#questions_intro').addClass('hide');
		$('#questions').removeClass('hide');
	}
	
	function checkTest() {
		$('.panel-body').children('.question-container').each(function(idx, itm) {
			if($(itm).children('input:checked').val() == 0) $(itm).children('.question-right').removeClass('hide');
			else $(itm).children('.question-wrong').removeClass('hide');
		});
		$('.panel-body .checkTest-container').addClass('hide');
		$('.panel-body .goHome-container').removeClass('hide');
	}
	
	function goHome() {
		window.location = 'http://localhost/main/home.php';
	}
	
	$('#btn-start-test').click(startTest);
	$('#btn-check-test').click(checkTest);
	$('#btn-go-home').click(goHome);
	
	
	function shuffle(a) {
		var j, x, i;
		for (i = a.length - 1; i > 0; i--) {
			j = Math.floor(Math.random() * (i + 1));
			x = a[i];
			a[i] = a[j];
			a[j] = x;
		}
		return a;
	}
	
	</script>
</body>
</html>
