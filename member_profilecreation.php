<?php
session_start();
$fname= $_SESSION["fname"];
$lname =$_SESSION["lname"];

$email = $_SESSION["email"];
$role = $_SESSION["role"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Ali Iktider Sayam">
	<meta name="description" content="Online Health & Fitness Guide">
	<meta name="keywords" content="gym,fitness,Healthy,Health">
	<title>MEMBER PROFILE</title>
	<link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css/MIME" />
	<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

	<link href="profile.css" rel="stylesheet">
	<link rel="icon" href="logo.ico">
</head>
<body>

	<main id="main">
		<form action="member_insert.php" method="post"> 
		<div class="container">
			<div class="outer">

				<div class="details">
					<span id="left">
					<h1>MEMBER</h1>
						<div class="textbox">
								<i class="fas fa-user"></i>
								<input type="text" name="fname" disabled="true" autocorrect=off placeholder="(Name)<?php echo $fname; ?> <?php echo $lname; ?>">
							</div> 

							<div class="textbox">
								<i class="fas fa-envelope"></i>
								<input type="email" name="email" disabled="true" placeholder="(Email)<?php echo $email; ?> ">
							</div>
	

							<div class="textbox">
								<i class="fas fa-lock"></i>
								<input type="text" name="role" disabled="true" placeholder="(Role)<?php echo $role; ?> ">
							</div>	

							<div class="textbox">
								<i class="fas fa-lock"></i>
								<input type="password" name="password" placeholder="Password">
							</div>

							<div class="textbox">
								<i class="fas fa-lock"></i>
								<input type="number" name="chest" placeholder="Chest Size (In Inches)">
							</div>
							<div class="textbox">
								<i class="fas fa-lock"></i>
								<input type="number" name="shoulder" placeholder="Shoulder Width (In Inches)">
							</div>
							<div class="textbox">
								<i class="fas fa-lock"></i>
								<input type="number" name="waist" placeholder="Waist Size (In Inches)">
							</div>	
							<div class="textbox">
								<i class="fas fa-lock"></i>
								<input type="number" name="weight" placeholder="Weight (In Kilos)">
							</div>

							<div class="textbox">
								<i class="fas fa-lock"></i>
								<label for="description" style="vertical-align: top;">Description:</label>
              				    <textarea rows="2" cols="60"  id='description' name="description">Enter Your Previous Experiences Here</textarea>
							</div>

							<input type="submit" class="btn" value="Sign Up">			
					
					</span>
				</div>

				<h3 style="color: white; margin-left: 5%; margin-top: 20% "> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp	&nbsp &nbsp Upload Your Photo</h3>
						<input class="images" id="files" type='file' style="display: inline; color: white; overflow: hidden; font-size: 20px; border-bottom: 2px solid white; border-top: 2px solid white; margin-top: 10px; margin-left: 5%; margin-right: 15%;" onchange="readURL(this);" />

						<img id="trainer_photo" style="float: left; max-width: 800px; max-height: 300px; margin-left: 5%; padding: 0;" src="#" alt="" />
						
						

						<script type="text/javascript">
							     function readURL(input) {
							            if (input.files && input.files[0]) {
							                var reader = new FileReader();

							                reader.onload = function (e) {
							                    $('#trainer_photo')
							                        .attr('src', e.target.result);
							                      
							                };

							                reader.readAsDataURL(input.files[0]);
							            }
							        }
						        
						    
						</script>		
				
			</div>
			
		</div>

		</form>
	</main>


	
</body>
</html>