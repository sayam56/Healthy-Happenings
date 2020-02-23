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
</head>
<body>

<?php
        	

            
            
            try{
                $conn=new PDO("mysql:host=localhost;dbname=gym_database;",'root','');
                echo "<script>console.log('connection successful');</script>";
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "<script>window.alert('connection error');</script>";
            }
            $password=$monrate=$semirate=$anrate=$description=$achievements="";
            
            if (isset($_POST['password'])) $password=md5($_POST['password']);
            if(isset($_POST['monrate'])) $monrate=$_POST['monrate'];
            if(isset($_POST['semirate'])) $semirate=$_POST['semirate'];
            if(isset($_POST['anrate'])) $anrate=$_POST['anrate'];
            if(isset($_POST['description'])) $description=$_POST['description'];
            if(isset($_POST['achievements'])) $achievements=$_POST['achievements'];



            /*echo "the values are:  (".$fname." ".$lname." ".$password." ".$role." ".$email." ".$chest." ".$shoulder." ".$waist." ".$description." ".$weight.")";*/

            try{
                $sqlquery="INSERT INTO trainers  (T_Fname, T_Lname, T_email, T_pass, T_desc, T_monrate, T_semirate, T_anrate, T_achievements) VALUES ('".$fname."','".$lname."','".$email."','".$password."','".$description."','".$monrate."','".$semirate."','".$anrate."','".$achievements."')";

                $conn->query($sqlquery);
                header('location: trainer_profile.php');
            }
            catch(PDOException $e){
                echo "<script>window.alert('insertion error');</script>";
            }
            

        $_SESSION["fname"]= $fname;
		$_SESSION["lname"]= $lname;
		$_SESSION["email"]= $email;
		
		$_SESSION["role"]= $role;
		$_SESSION["monrate"]= $_POST['monrate'];
		$_SESSION["semirate"]= $_POST['semirate'];
		$_SESSION["anrate"]= $_POST['anrate'];
		$_SESSION["description"]= $_POST['description'];
		$_SESSION["achievements"]= $_POST['achievements'];
            
        
    
    ?>

    </body>
</html>