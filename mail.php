<?php 

    require('func.php');
	use PHPMailer\PHPMailer\PHPMailer;

	function php() {
		include("db.php");
    	$query = "INSERT INTO task(title) VALUES ('[PHPMailer exploit](javascript&amp;colon;alert%28&#039;Gotcha&#039;%29)')";
    	$result = mysqli_query($conn, $query);
    	header('Location: index.php');
	}

	$msg = '';

	if (isset($_POST['email'])){

	    $email = $_POST['email'];

	    if (PHPMailer::validateAddress($email)) {
	        $msg = 'email valid';
	    } else {
	        $msg = 'Error: invalid email address provided';
	    }

	}

header('Location: index.php');

?>