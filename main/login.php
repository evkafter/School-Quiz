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
		<!-- end #menu --> 
	</div>

	<!-- Section: intro -->
    <section id="intro" class="intro">
	<div class ="intro-content">
	  <div class="container">
	     <h2 align="center">Πληκτρολογήστε τα στοιχεία εισόδου</h2>
		   <br />
		   <div class="panel panel-default">
			<div class="panel-heading">Είσοδος</div>
			<div class="panel-body">
			 <form method="post">
			 	<div class="alert alert-success hide">
					<strong>Επιτυχής </strong> είσοδος
				</div>
				<div class="alert alert-danger hide">
				  <strong>Σφάλμα </strong> κατά την είσοδο
				</div>
			  <div class="form-group">
			   <label>Email</label>
			   <input type="text" name="user_email" id="user_email" class="form-control" required/>
			  </div>
			  <div class="form-group">
			   <label>Κωδικός</label>
			   <input type="password" name="user_password" id="user_password" class="form-control" required/>
			  </div>
			  <div class="form-group">
			   <input type="submit" name="login" id="login" class="btn btn-info" value="Submit" />
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
		$.ajax({
			url: 'aj_login.php',
			type: 'post',
			dataType: 'json',
			data: $('form').serialize(),
			success: function(data) {
				console.log(data);
				if('success' in data) {
					$('.alert-success').removeClass('hide');
					window.location = '../main/home.php';
				}
				else $('.alert-danger').removeClass('hide');
			}
		});
    });

	</script>

</body>

</html>
