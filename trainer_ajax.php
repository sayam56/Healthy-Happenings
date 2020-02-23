<?php
 echo "<script>console.log('next page SUCCESSFULL!!!!');</script>";
try{
                $conn=new PDO("mysql:host=localhost;dbname=gym_database;",'root','');
                echo "<script>console.log('connection successful');</script>";
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "<script>window.alert('connection error');</script>";
            }


					if(isset($_GET['select']) ){
									$E_id=$_GET['select'];
									$M_id=$_GET['mem'];
									$fname=$_GET['fname'];
									$email=$_GET['email'];
		                            	

		                        try{
		                            /*$selectsql=" UPDATE members SET members.T_id='".$id."' WHERE members.M_Fname='".$fname."' AND members.M_pass='".$password."' ";*/

		                            $sql= "SELECT T_id FROM trainers WHERE trainers.T_Fname='".$fname."' and trainers.T_email='".$email."' ";
		                            $object=$conn->query($sql);
		                            $T_id= $object->fetchAll();
		                            foreach ($T_id as $key) {
		                            	# code...
		                            	$selectsql=" INSERT INTO ejmt (M_id,T_id,E_id) VALUES ('".$M_id."','".$key[0]."','".$E_id."') ";
		                            }

	                            	$conn->query($selectsql);
	                            	
		                            echo "<script>console.log('INSERT SUCCESSFULL!!!!');</script>";
		                        }
		                        catch(PDOException $ex1){
		                            echo "<script>console.log(' UNSUCCESSFULL!!');</script>";
		                            
		                        }
		                    }
?>