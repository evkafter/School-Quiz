<?php
	require_once('../core/db_connect.php');
	require_once('../core/header.php');
	
	$bdd = new db();
	$sql = "SELECT * FROM questions";
	$questions = $bdd->getAll($sql);
	
	$sql = "SELECT * from courses";
	$courses = $bdd->getAll($sql);
	
	$questions_selector = '<select class = question-selector >';
	
	foreach($questions as $question) {
		$questions_selector .= "<option value = ". $question['question_id'] .">";
		foreach($courses as $course) {
			if($question['course_id'] == $course['course_id']) {
				$questions_selector.= $course['name'] ." - ";
				break;
			}
		}
		$questions_selector.= $question['title'] ."</option>";
	}
	$questions_selector .= "</select>";
	
	$questions_json = '$'.'questions = {';
	foreach($questions as $question) {
		$questions_json .= '"'. $question['question_id'] . '": {';
		$questions_json .= '"title": "' . $question['title'] . '",';
		$questions_json .= '"text": "' . $question['text'] . '",';
		$questions_json .= '"answers": "' . $question['answers'] . '",';
		$questions_json .= '"course_id": "' . $question['course_id'] . '",';
		$questions_json .= '"source": "' . $question['source']. '"';
		$questions_json .= '},';
	}
	$questions_json = substr($questions_json, 0, -1);
	$questions_json .= '};';
	
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
	     <h2 align="center">Ενημέρωση Ερωτήσεων</h2>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading">Λίστα Ερωτήσεων</div>
				<div class="panel-body">
					<?php echo $questions_selector; ?>
				</div>
			</div>
		   <br />
			<div class="panel panel-default">
				<div class="panel-heading">Περιεχόμενα Ερώτησης</div>
				<div class="panel-body">
					<form method="post">					
						<div class="form-group">
							<textarea class = "question-id hide"></textarea>
							<div><h4>Τίτλος</h4></div>
							<textarea class = "question-title"> ...</textarea>
							<div><h4>Ερώτηση</h4></div>
							<textarea class = "question-text"> ...</textarea>
							<div><h4>Σωστή απάντηση</h4></div>
							<textarea class = "question-answer-right"> ...</textarea>
							<div><h4>Απάντηση #2</h4></div>
							<textarea class = "question-answer-wrong"> ...</textarea>
							<div><h4>Απάντηση #3</h4></div>
							<textarea class = "question-answer-wrong-2"> ...</textarea>
							<div><h4>Απάντηση #4</h4></div>
							<textarea class = "question-answer-wrong-3"> ...</textarea>
							<div><h4>Μάθημα</h4></div>
							<div><?php echo $course_selector; ?></div>
							<div><h4>Υπόδειξη απάντησης</h4></div>
							<textarea class = "question-source"> ...</textarea>
							<hr>		
						</div>
						<div class="form-group">
							<button name="register" id="register" class="btn btn-info btn-update-question" value= />Ενημερωση Ερωτησης</button>
							<button  type = "submit" name="register" id="register" class="btn btn-info btn-delete-question">Διαγραφη Ερωτησης</button>
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
	<?php
	echo $questions_json;
	?>
	
	$questions_size = Object.keys($questions).length;
	if($questions_size > 0) {
		$(".question-selector").prop("selectedIndex", 0);
		updateForm(Object.keys($questions)[0]);
	}
	
	function updateForm(_id) {
		var question_obj = $questions[_id];
		var answers = question_obj['answers'].split('#');

		$('.question-id').text(_id);
		$('.question-title').val(question_obj['title']);
		$('.question-text').val(question_obj['text']);
		$('.question-answer-right').val(answers[0]);
		$('.question-answer-wrong').val(answers[1]);
		$('.question-answer-wrong-2').val(answers[2]);
		$('.question-answer-wrong-3').val(answers[3]);
		$('.question-source').val(question_obj['source']);
		$('.question-course').val(question_obj['course_id']);
	}
	
	$('.question-selector').on('change', function() {
	  updateForm(this.value);
	});
	
	$( ".btn-update-question" ).click(function(e) {
		e.preventDefault();
		if(isEmpty($('.question-title').val()) ||
		isEmpty($('.question-text').val()) ||
		isEmpty($('.question-answer-right').val()) ||
		isEmpty($('.question-answer-wrong').val()) ||
		isEmpty($('.question-answer-wrong-2').val()) ||
		isEmpty($('.question-answer-wrong-3').val()) ||
		isEmpty($('.question-source').val()))
		alert("Υπάρχουν κενά πεδία!");
		else {
			var r = confirm("Θέλετε να ενημερώσετε την ερώτηση;");
			if (r == true) {
				$('.alert').addClass('hide');
				$answers = $(".question-answer-right").val() + '#' +
				$(".question-answer-wrong").val() + '#' +
				$(".question-answer-wrong-2").val() + '#' +
				$(".question-answer-wrong-3").val();
				$.ajax({
					url: 'aj_update_question.php',
					type: 'post',
					dataType: 'json',
					data: {
						question_id: $('.question-id').val(),
						question_title : $('.question-title').val(),
						question_text : $('.question-text').val(),
						question_answers : $answers,
						question_source : $('.question-source').val(),
						question_course : $('.question-course').val()
					},
					success: function(data) {
						$('.alert-success').removeClass('hide');
						
						$questions[$('.question-id').val()].title = $('.question-title').val();
						$questions[$('.question-id').val()].text = $('.question-text').val();
						$questions[$('.question-id').val()].answer = $answers;
						$questions[$('.question-id').val()].course_id = $('.question-course').val();
						$questions[$('.question-id').val()].source = $('.question-source').val();
						
						$('.question-selector option[value="' + $('.question-id').val() + '"]').text("");
						
						$('.question-selector option[value="' + $('.question-id').val() + '"]').text($('select option:selected').text() + ' - ' + $('.question-title').val());
						
						$('form')[0].reset();
						
					},
					error: function(ts) {
						console.log("error");
						$('.alert-danger').removeClass('hide');
					},
					complete: function(data) {
						console.log(data);
					}
				});
			}
		}
		
	});
	
	function isEmpty(str) {
		return (!str || 0 === str.length);
	}
	
	$( ".btn-delete-question" ).click(function(e) {
	  e.preventDefault();
	  var r = confirm("Θέλετε να διαγράψετε την ερώτηση;");
		if (r == true) {
			$('.alert').addClass('hide');
			$.ajax({
				url: 'aj_delete_question.php',
				type: 'post',
				dataType: 'json',
				data: {
					question_id: $('.question-id').val()
				},
				success: function(data) {
					$('.alert-success').removeClass('hide');
					
					delete $questions[$('.question-id').val()];
					$('.question-selector option[value="' + $('.question-id').val() + '"]').remove();
					
					$('form')[0].reset();
					
				},
				error: function(ts) {
					console.log("error");
					$('.alert-danger').removeClass('hide');
				},
				complete: function(data) {
					console.log(data);
				}
			});
		}
	});


	</script>

</body>

</html>
