<?php
	require_once('../core/db_connect.php');
	require_once('../core/header.php');
	
	$role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';
	$header = getHeader($role);
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

	<!-- Section: intro -->
    <section id="intro" class="intro">
	<div class ="intro-content">
	  <div class="container">
	     <h2 align="center">Άλλαξε τον κωδικό σου</h2>
		   <br />
		   <div class="panel panel-default">
			<div class="panel-heading">Αλλαγή κωδικού</div>
			<div class="panel-body">
			 <form method="post">
			 	<div class="alert alert-success hide">
					<strong>Επιτυχής </strong> αλλαγή κωδικού
				</div>
				<div class="alert alert-danger hide">
				  <strong>Πρόβλημα </strong> κατά την αλλαγή κωδικού
				</div>
			  <div class="form-group">
			   <label>Παλιός κωδικός</label>
			   <input type="password" name="user_old_pass" id="user_old_pass" class="form-control" required/>
			  </div>
			  <div class="form-group">
			   <label>Νέος κωδικός</label>
			   <input type="password" name="user_new_pass" id="user_new_pass" class="form-control" required/>
			  </div>
			  <div class="form-group">
			   <input type="submit" name="login" id="login" class="btn btn-info" value="Update" />
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
		console.log($('form').serialize());
		$.ajax({
			url: 'aj_update_profile.php',
			type: 'post',
			dataType: 'json',
			data: $('form').serialize(),
			success: function(data) {
				console.log(data);
				if('success' in data) $('.alert-success').removeClass('hide');
				else $('.alert-danger').removeClass('hide');
				
			}
		});
		

    });

	</script>

</body>

</html>
