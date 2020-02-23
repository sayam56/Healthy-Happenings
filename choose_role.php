<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Ali Iktider Sayam">
	<meta name="description" content="Online Health & Fitness Guide">
	<meta name="keywords" content="gym,fitness,Healthy,Health">
	<title>Profile</title>
	<link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">

	<!-- <link href="login.css" rel="stylesheet"> -->
	<link rel="icon" href="logo.ico">
</head>

<body>
	<?php
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		
		$role = $_POST['role'];

		$_SESSION["fname"]= $_POST['fname'];
		$_SESSION["lname"]= $_POST['lname'];
		$_SESSION["email"]= $_POST['email'];
		
		$_SESSION["role"]= $_POST['role'];
		

		if ($role  == 'Trainer') {
			# code...
			header('Location: trainer_profilecreation.php');
		}
		else
			header('Location: member_profilecreation.php');

		
	?>



</body>
</html>