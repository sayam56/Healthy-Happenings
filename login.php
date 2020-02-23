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
	<title>LOGIN/SIGN UP</title>
	<link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">

	<link href="login.css" rel="stylesheet">
	<link rel="icon" href="logo.ico">
</head>


<body>
	<main id="main">
		<div class="container">
			<div class="outer">
				<div class="details">
					<!-- <h4>LOGIN</h4>
					<h2>
						<span>info here</span>
						<span>2nd span</span>
						</h2>

						<h1>ashdisaidnasini</h1> -->
						<span id="login">
							<form action="validation.php" method="POST">
							<h1>LOGIN!</h1>
							<div class="textbox">
    							<i class="fas fa-user"></i>
    							<input type="text" name="fname" placeholder="Username">
   							</div>

  							<div class="textbox">
   								<i class="fas fa-lock"></i>
    							<input type="password" name="password" placeholder="Password">
							</div>
							<div class="radiobtn">
								Choose Your Role:<br>
								<div ><span>
								<input type="radio" name="role"  value="Member" checked> Member
								</span></div>
								
								<div >
								<span>
                				<input type="radio" name="role"  value="Trainer"> Trainer
                				</span>
                				</div>
							</div>

  							<input type="submit" class="btn" value="Sign in">
  							</form>
						</span>

						<span id="signup">
							<form method="POST" action="choose_role.php" >

							<h1>SIGN-UP!</h1>

							<div class="textbox">
								<i class="fas fa-user"></i>
								<input type="text" name="fname" placeholder="First Name(Username)">
							</div>

							<div class="textbox">
								<i class="fas fa-user"></i>
								<input type="text" name="lname" placeholder="Last Name">
							</div>

							<div class="textbox">
								<i class="fas fa-envelope"></i>
								<input type="email" name="email" placeholder="Email ID">
							</div>

						

							
							<div class="radiobtn">
								Choose Your Role:<br>
								<div ><span>
								<input type="radio" name="role"  value="Member" checked> Member
								</span></div>
								
								<div >
								<span>
                				<input type="radio" name="role"  value="Trainer"> Trainer
                				</span>
                				</div>
							</div>
							<input type="submit" class="btn" value="Continue Signing Up -->">

							</form>

						</span>
				</div>
			</div>
		</div>
		
	</main>
</body>
</html>