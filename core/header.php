<?php
	require_once('session_manager.php');	
	SessionManager::sessionStart('');

	function getHeader($ROLE) {
$normal_header = <<<EOT
<ul>
	<li class="current_page_item"><a href="../main/home.php">Αρχικη</a></li>
	<li><a href="../main/login.php">Συνδεση</a></li>
	<li><a href="../main/register.php">Εγγραφη</a></li>
</ul>
EOT;
	
$student_header = <<<EOT
<ul>
	<li class="current_page_item"><a href="../main/home.php">Αρχικη</a></li>
	<li><a href="../students/test.php">Τεστ</a></li>
	<li><a href="../main/update_profile.php">Προφιλ</a></li>
	<li><a href="../main/logout.php">Αποσυνδεση</a></li>
</ul>
EOT;

$admin_header = <<<EOT
<ul>
	<li class="current_page_item"><a href="../main/home.php">Αρχικη</a></li>
	<li><a href="../admin/add_question.php">Προσθηκη Ερωτησης</a></li>
	<li><a href="../admin/update_questions.php">Επεξεργασια Ερωτησης</a></li>
	<li><a href="../main/logout.php">Αποσυνδεση</a></li>
</ul>
EOT;
	
		if($ROLE == SessionManager::$ROLE_ADMIN) return $admin_header;
		else if ($ROLE == SessionManager::$ROLE_STUDENT) return $student_header;
		else return $normal_header;
	}
?>