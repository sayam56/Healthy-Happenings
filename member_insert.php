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
            $password=$chest=$shoulder=$waist=$description=$weight="";
            if(isset($_POST['password'])) $password=md5($_POST['password']);
            
            if(isset($_POST['chest'])) $chest=$_POST['chest'];
            if(isset($_POST['shoulder'])) $shoulder=$_POST['shoulder'];
            if(isset($_POST['waist'])) $waist=$_POST['waist'];
            if(isset($_POST['description'])) $description=$_POST['description'];
            if(isset($_POST['weight'])) $weight=$_POST['weight'];

            /*echo "the values are:  (".$fname." ".$lname." ".$password." ".$role." ".$email." ".$chest." ".$shoulder." ".$waist." ".$description." ".$weight.")";*/

            try{
                $sqlquery="INSERT INTO members  (M_Fname, M_Lname, M_email, M_pass, M_chest, M_shoulder, M_waist, M_desc, M_weight) VALUES ('".$fname."','".$lname."','".$email."','".$password."','".$chest."','".$shoulder."','".$waist."','".$description."','".$weight."')";

                $conn->query($sqlquery);
                header('location: member_profile.php');
            }
            catch(PDOException $e){
                echo "<script>window.alert('insertion error');</script>";
            }
            

        $_SESSION["fname"]= $fname;
		$_SESSION["lname"]= $lname;
		$_SESSION["email"]= $email;
		$_SESSION["role"]= $role;
		$_SESSION["chest"]= $_POST['chest'];
		$_SESSION["shoulder"]= $_POST['shoulder'];
		$_SESSION["waist"]= $_POST['waist'];
		$_SESSION["description"]= $_POST['description'];
		$_SESSION["weight"]= $_POST['weight'];
            
        
    
    ?>

    </body>
</html>