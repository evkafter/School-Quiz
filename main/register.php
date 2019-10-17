<?php
	require_once('../core/db_connect.php');
	require_once('../core/header.php');
	
	$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';
	$header = getHeader($role);
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
	</div>
		<!-- end #menu --> 
	</div>

	<!-- Section: intro -->
    <section id="intro" class="intro">
	<div class ="intro-content">
	  <div class="container">
	     <h2 align="center">Δημιουργία λογαριασμού μαθητή</h2>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading">Στοιχεία εγγραφής</div>
				<div class="panel-body">
					<form method="post">
						<div class="alert alert-success hide">
							<strong>Επιτυχής </strong> εγγραφή
						</div>
						<div class="alert alert-danger hide">
						  <strong>Σφάλμα </strong> κατά την εγγραφή
						</div>
						<div class="form-group">
						   <label>Όνομα</label>
						   <input type="text" name="student_first" id="user_first" class="form-control" required/>
						</div>
						<div class="form-group">
						   <label>Επώνυμο</label>
						   <input type="text" name="student_last" id="user_last" class="form-control" required/>
						</div>
						<div class="form-group">
						   <label>Email</label>
						   <input type="text" name="student_email" id="user_email" class="form-control" required/>
						</div>
						<div class="form-group">
						   <label>Κωδικός</label>
						   <input type="password" name="student_password" id="user_password" class="form-control" required/>
						</div>
						<div class="form-group">
						   <label>Επιβεβαίωση κωδικού</label>
						   <input type="password" name="student_password_confirm" id="user_password_confirm" class="form-control" required/>
						</div>
						<div class="form-group">
							<input type="submit" name="register" id="register" class="btn btn-info" value="Εγγραφη" />
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
		console.log($('#user_password').val());
		if($('#user_password').val() != $('#user_password_confirm').val()){
			alert("Οι κωδικοί είναι διαφορετικοί!")
		}
		else {
			$.ajax({
				url: 'aj_register.php',
				type: 'post',
				dataType: 'json',
				data: $('form').serialize(),
				success: function(data) {
					$('.alert-success').removeClass('hide');
					$('form')[0].reset();
				},
				error: function(ts) {
					$('.alert-danger').removeClass('hide');
				}
			});
		}

    });

	</script>

</body>

</html>
