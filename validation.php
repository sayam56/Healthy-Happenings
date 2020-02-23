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
		$password = md5($_POST['password']);
            
		$role = $_POST['role'];


			try{
                $conn=new PDO("mysql:host=localhost;dbname=gym_database;",'root','');
                echo "<script>console.log('connection successful');</script>";
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "<script>window.alert('connection error');</script>";
            }

            if(isset($_POST['fname'])) $fname=$_POST['fname'];
            if(isset($_POST['password'])) $password=md5($_POST['password']);
            if(isset($_POST['role'])) $role = $_POST['role'];
            

            if ($role == 'Trainer') {
            	
	            	try{
	                $sqlquery="SELECT * from trainers where T_Fname= '".$fname."' and T_pass= '".$password."' ";
					$object=$conn->query($sqlquery);
					$row= $object->rowCount();
					
					$is_invalid=0;
					while( $row>0) {
			
			 			 	$row1= $object->fetchAll();
									foreach ($row1 as $key) {
										$_SESSION["fname"]= $fname;
            							$_SESSION["email"]=$key[3];
		                            header('Location: trainer_profile.php');
		                            break;
		                            }
		
						
						#header('Location:redirecthtml.html');
						#echo 'WELCOME'.$fname." "."<br>";
						$is_invalid=1;
						break;

					}

		
					if ($is_invalid==0)
					{
						#echo "invalid Passcode or Username";
						header('Location: incorrect_password.html');
					} 

	            }

	            catch(PDOException $e){
	                echo "<script>window.alert('validation error');</script>";
	            	}
            	
            }




            else
            {
		            try{
		                $sqlquery="SELECT * from members where M_Fname= '".$fname."' and M_pass= '".$password."' ";
						$object= $conn->query($sqlquery);
						$row= $object->rowCount();
						echo "from member $row";
		                $is_invalid=0;

					while($row>0) {


			            $row1= $object->fetchAll();
						foreach ($row1 as $key) {
							$_SESSION["fname"]= $fname;
							$_SESSION["email"]=$key[3];
	                        header('Location: member_profile.php');
	                        break;
                        }
						#echo 'WELCOME'.$fname." "."<br>";
						$is_invalid = 1;
						break;
					}
					
		
					if ($is_invalid==0)
					{
						#echo "invalid Passcode or Username";
						header('Location: incorrect_password.html');
					} 
		                
		            }

		            catch(PDOException $e){
		                echo "<script>window.alert('validaiton error');</script>";
		            }
        }



		
	?>



</body>
</html>