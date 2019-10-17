<?php
	require_once('../core/db_connect.php');
	require_once('../core/header.php');
	
	$bdd = new db();
	$sql = "SELECT * FROM courses";
	$courses = $bdd->getAll($sql);
	$course_selector = "<select class = question-course >";
	
	foreach($courses as $course) {
		$course_selector .= "<option value = ". $course['course_id'] .">". $course['name'] ."</option>";
	}
	$course_selector .= "</select>";
	
	$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';
	$header = getHeader($role);
	
	if(!isset($_SESSION['role'])){ //if login in session is not set
		header("Location: http://localhost/main/home.php");
	}
?>
<html lang="en">

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

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">

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

	<!-- Section: intro -->
    <section id="intro" class="intro">
	<div class ="intro-content">
	  <div class="container">
	     <h2 align="center">Δημιουργία ερώτησης</h2>
		   <br />
			<div class="panel panel-default">
				<div class="panel-heading">Νέα ερώτηση</div>
				<div class="panel-body">
					<form method="post">					
						<div class="form-group">
							<div><h4>Τίτλος</h4></div>
							<textarea class = "question-title"> ...</textarea>
							<div><h4>Ερώτηση</h4></div>
							<textarea class = "question-text"> ...</textarea>
							<div><h4>Σωστή απάντηση</h4></div>
							<textarea class = "question-answer-right"> ...</textarea>
							<div><h4>Απάντηση #2</h4></div>
							<textarea class = "question-answer-wrong"> ...</textarea>
							<div><h4>Απάντηση #3</h4></div>
							<textarea class = "question-answer-wrong"> ...</textarea>
							<div><h4>Απάντηση #4</h4></div>
							<textarea class = "question-answer-wrong"> ...</textarea>
							<div><h4>Μάθημα</h4></div>
							<div><?php echo $course_selector; ?></div>
							<div><h4>Υπόδειξη απάντησης</h4></div>
							<textarea class = "question-source"> ...</textarea>
							<hr>		
						</div>
						<div class="alert alert-success hide">
							<strong>Επιτυχής </strong> εισαγωγή ερώτησης
						</div>
						<div class="alert alert-danger hide">
						  <strong>Αποτυχία </strong> κατά την εισαγωγή ερώτησης
						</div>
						<div class="form-group">
							<input type="submit" name="insert" id="insert" class="btn btn-info" value="Εισαγωγη" />
						</div>
					</form>
				</div>
			</div>
		   <br />
	   </div>
	</div>
    </section>
</div>
<div id="copyright" class="container">
	<p>&copy; All rights reserved.</p>
</div>

<!-- Core JavaScript Files -->
    <script src="../core/scripts/jquery.min.js"></script>	 
    <script src="../core/scripts/bootstrap.min.js"></script>
	<script>

	$('form').on('submit', function (e) {
		e.preventDefault();
		$('.alert').addClass('hide');
		$answers = $(".question-answer-right").val();
		$(".question-answer-wrong").each(function(){
			$answers += '#' + this.value;
		});
		$.ajax({
			url: 'aj_insert_question.php',
			type: 'post',
			dataType: 'json',
			data: {
				question_title : $('.question-title').val(),
				question_text : $('.question-text').val(),
				question_answers : $answers,
				question_source : $('.question-source').val(),
				question_course : $('.question-course').val()
			},
			success: function(data) {
				$('.alert-success').removeClass('hide');
				//window.location = '../index.php';
				$('form')[0].reset();
				
			},
			error: function(ts) {
				$('.alert-danger').removeClass('hide');
			}
		});
    });

	</script>

</body>

</html>
