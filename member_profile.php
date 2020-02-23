<?php
session_start();
$fname= $_SESSION["fname"];
/*$lname =$_SESSION["lname"]*/;
/*$password =$_SESSION["password"];*/
$email = $_SESSION["email"];
/*$role = $_SESSION["role"];*/

			try{
                $conn=new PDO("mysql:host=localhost;dbname=gym_database;",'root','');
                echo "<script>console.log('connection successful');</script>";
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "<script>window.alert('connection error');</script>";
            }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Ali Iktider Sayam">
	<meta name="description" content="Online Health & Fitness Guide">
	<meta name="keywords" content="gym,fitness,Healthy,Health">
	<title>WELCOME!</title>
	<link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<link href="member_profile.css" rel="stylesheet">
	<link rel="icon" href="logo.ico">
</head>
<body>

	<main>
		<div class="container">
			<div class="outer">
				<div class="details">
						

						<?php 


								if(isset($_GET['select'])){
									$id=$_GET['select'];

		                        try{
		                            /*$selectsql=" UPDATE members SET members.T_id='".$id."' WHERE members.M_Fname='".$fname."' AND members.M_pass='".$password."' ";*/

		                            $sql= "SELECT M_id FROM members WHERE members.M_Fname='".$fname."' and members.M_email='".$email."' ";
		                            $object=$conn->query($sql);
		                            $M_id= $object->fetchAll();
		                            foreach ($M_id as $key) {
		                            	# code...
		                            	$selectsql=" INSERT INTO mjt (M_id,T_id) VALUES ('".$key[0]."','".$id."') ";
		                            }
		                            
		

		                            $conn->query($selectsql);
		                            echo "<script>console.log('SUCCESSFULL!!!!');</script>";
		                        }
		                        catch(PDOException $ex1){
		                            echo "<script>console.log(' UNSUCCESSFULL!!');</script>";
		                            
		                        }



		                        /*try{
		                            /*$selectsql=" INSERT INTO trainers (trainers.M_id) SELECT members.M_id FROM members,trainers WHERE members.M_Fname='".$fname."' AND members.M_pass='".$password."' AND members.T_id=trainers.T_id ";*/
		                            /*we keep this for later, gotta consult with sir about multiple rows :/ */
		                          /*  $sql= "SELECT M_id FROM members WHERE members.M_Fname='".$fname."' and members.M_pass='".$password."' ";
		                            $object=$conn->query($sql);
		                            $M_id= $object->fetchAll();

		                            foreach ($M_id as $key) {
		                            	# code...
		                            	$selectsql=" UPDATE trainers SET trainers.M_id='".$key[0]."' WHERE trainers.T_id='".$id."' ";
		                            }
		                            
		                            
		                            $conn->query($selectsql);
		                            echo "<script>window.alert('SUCCESSFULL!!!!');</script>";
		                        }
		                        catch(PDOException $ex1){
		                            echo "<script>window.alert(' UNSUCCESSFULL!!');</script>";
		                            
		                        }*/
		                        
		                    }

		                    if (isset($_GET['delete'])) {
		                    	$id=$_GET['delete'];
		                    	# code...\
		                    	try{
		                            $sql= "SELECT M_id FROM members WHERE members.M_Fname='".$fname."' and members.M_email='".$email."' ";
		                            $object=$conn->query($sql);
		                            $M_id= $object->fetchAll();

		                            foreach ($M_id as $key) {
		                            	$deletesql= "DELETE FROM mjt WHERE M_id=".$key[0]." AND T_id=".$id." ";
		                            }
		                            $conn->exec($deletesql);
		                            echo "<script>console.log('DELETION SUCCESSFULL!!!!');</script>";
		                        }
		                        catch(PDOException $ex1){
		                            echo "<script>console.log('DELETION UNSUCCESSFULL!!');</script>";
		                            
		                        }
		                    }
		                

						/*echo "name is : ".$fname." ".$lname." ";*/
						$sqlquery="SELECT * from members where M_Fname= '".$fname."' and M_email= '".$email."' ";

                		$object = $conn->query($sqlquery); 

                		if ($object->rowCount() == 0 ) {
                			# code...
                			echo "<h4>no data found!!</h4>";
                		}
                		else
                		{
                			$data=$object->fetchAll();

                			foreach ($data as $row) {
                				# code...
                				?>
                				
                					Member ID: <?php echo $row[0] ?>
                					<div>
                					<span id="left">
                					<h2>
									WELCOME!! <?php echo " ".$row[1]." ".$row[2]." "?> 
									</h2>
									</span>

									<span id="right">
									<a  class="btn btn-outline-light btg-lg" href="logout.php">L-O-G-O-U-T-!-!</a>
									</span>
								</div>
									<div class="serverinfo">
										<br>
										<br>
									<h4 style="color: yellow;">
										Chest Width: <?php echo $row[6] ?> inches<br>
										Shoulder Width: <?php echo $row[7] ?> inches <br>
										Waist: <?php echo $row[8] ?> inches <br>
										Weight: <?php echo $row[12] ?> Kilos <br>
										Description: <?php echo $row[9] ?> <br>
									</h4></div>
                				<?php
                			}
                		}
						?>
						
					
					
				</div>


				<input type="button" style="align-self: center;" class="btn btn-outline-light btg-lg" name="show" value="SHOW/HIDE AVAILABLE TRAINERS" onclick="show();">

				<input type="button" class="btn btn-outline-light btg-lg" name="showEx" data-toggle="modal" data-target="#selectedExercisesModal" value="SHOW ROUTINE" onclick="showSelectedEx();" >




				<div id="trainertable" class="table-responsive" style="display: none;">
						<div id="desc" style="text-align: center; color: white;">
							<p><b>AVAILABLE TRAINERS AND THEIR RATES!</b></p>

							<table  class="table-dark" style="width: 100%">
								<thead style="border-bottom: 2px solid black;">
									<tr>
										<th>Trainer Id</th>
										<th>Trainer name</th>
										<th>Trainer email</th>
										<th>Monthly rate</th>
										<th>Semi-annual rate</th>
										<th>Annual Rate</th>
										<th>Achievements</th>
										<th>Description</th>
										<th>Select Trainer</th>
									</tr>
								</thead>

								<tbody class="table-dark">
									
									<?php

									$sql="SELECT * FROM trainers";
									$object1= $conn->query($sql);
									
									if ($object1->rowCount() == 0) {
										?>
										<tr>
											<td colspan="9" style="text-align: center;">!!! No Trainers Found !!!</td>
										</tr>
										<?php
									}

									else
									{
										$table= $object1->fetchAll();

										foreach ($table as $key) {
											# code...
											?>
											<th scope="row"> </th>
											<tr style=" border-bottom: 2px solid white;">
												<td><?php echo $key[0] ?></td>
												<td><?php echo " ".$key[1]." ".$key[2]." "?></td>
												<td><?php echo $key[3] ?></td>
												<td><?php echo $key[6] ?></td>
												<td><?php echo $key[7] ?></td>
												<td><?php echo $key[8] ?></td>
												<td><?php echo $key[10] ?></td>
												<td><?php echo $key[5] ?></td>
												<td> 
													<input type="button" class="btn btn-outline-light btg-lg" name="select" value="SELECT" onclick="updatedata(<?php echo $key[0]?>);"> 
												</td>
											</tr>
											<?php
										}
									}

									?>
								</tbody>

							</table>
						</div>
						
					</div> <!-- table div ends -->


					<br> <br>


					<!-- <input type="button" style="align-self: center;" class="btn btn-outline-light btg-lg" name="show" value="SHOW SELECTED TRAINER" onclick="showSelected();"> -->



				<div id="selectedTrainertable" class="table-responsive">
						<div id="desc" style="text-align: center; color: white;	">
							<p><b>SELECTED TRAINER AND HIS RATES!</b></p>

							<table  class="table-dark" style=" width: 100%">
								<thead style="border-bottom: 2px solid black;">
									<tr>
										<th>Trainer Id</th>
										<th>Trainer name</th>
										<th>Trainer email</th>
										<th>Monthly rate</th>
										<th>Semi-annual rate</th>
										<th>Annual Rate</th>
										<th>Achievements</th>
										<th>Description</th>
										<th>Remove Trainer</th>
									</tr>
								</thead>

								<tbody class="table-dark">
									
									<?php

									$sql="SELECT * FROM trainers,members,mjt WHERE trainers.T_id=mjt.T_id AND members.M_id=mjt.M_id AND members.M_Fname='".$fname."' AND members.M_email='".$email."' Group by mjt.T_id ";
									$object1= $conn->query($sql);
									
									if ($object1->rowCount() == 0) {
										?>
										<tr>
											<td colspan="9" style="text-align: center;">!!! No Selected Trainers !!!</td>
										</tr>
										<?php
									}

									else
									{
										$table= $object1->fetchAll();

										foreach ($table as $key) {
											# code...
											?>
											<th scope="row"> </th>
											<tr style=" border-bottom: 2px solid white;">
												<td><?php echo $key[0] ?></td>
												<td><?php echo " ".$key[1]." ".$key[2]." "?></td>
												<td><?php echo $key[3] ?></td>
												<td><?php echo $key[6] ?></td>
												<td><?php echo $key[7] ?></td>
												<td><?php echo $key[8] ?></td>
												<td><?php echo $key[10] ?></td>
												<td><?php echo $key[5] ?></td>
												<td> 
													<input type="button" class="btn btn-outline-light btg-lg" name="select" value="REMOVE" onclick="removedata(<?php echo $key[0]?>);">

													<!-- add onclick show trainer info here --> 
												</td>
											</tr>
											<?php
										}
									}

									?>
								</tbody>

							</table>
						</div>
						
					</div><!-- selected trainer ends -->

					
				
			</div> <!-- outer ends -->

		</div> <!-- container ends -->


		


	</main>


					<!-- Selected Exercises Modal -->
				<div id="selectedExercisesModal" class="modal fade" role="dialog">
					
					<?php
						echo "<script>
									console.log('inside modal');
								</script>";
					?>

				  <div class="modal-dialog modal-lg">

				    <!-- Modal content-->
				    <div id="modalContent" class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Selected Exercises</h4>
				      </div>
				      <div id="selectedExercisesModalbody" class="modal-body">
				      	<div class="table-responsive">
				      		<table class="col-12" width="100%">
				      			<thead>
				      				<tr>
				      					<th>Exercise ID</th>
				      					<th>Exercise Name</th>
				      					<th>Exercise Type</th>
				      					<th>Exercise Level</th>
				      					<th>How To Perform</th>
				      				</tr>
				      			</thead>

				      			<tbody id="tableSection">
				      			</tbody>
				      		</table>
				      	</div><!-- exercise table ends -->
				      </div><!-- modal body ends here -->
				      <div class="modal-footer" id="modalFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>

				      <!-- to show the whole div after ajax -->
				      <div id="selectedExercisesShowModalList">
				      	
				      </div>
				    </div> <!-- modal Content ends here -->

				  </div>
				</div> <!-- total modal ends here -->



	<script>

		var fname="<?php echo $fname ?>";
		var email= "<?php echo $email ?>";

		function show(){
                //console.log(id);
                

                if (document.getElementById('trainertable').style.display == "none") {
                	document.getElementById('trainertable').style.display = "inline";
                }
                else
                	{
                		document.getElementById('trainertable').style.display="none";
                	}
               
            }

            function showSelected(){
            	if (document.getElementById('selectedTrainertable').style.display == "none") {
                	document.getElementById('selectedTrainertable').style.display = "inline";
                }
                else
                	{
                		document.getElementById('selectedTrainertable').style.display="none";
                	}

            }


		function updatedata(id){

			location.assign('member_profile.php?select='+id);
			/*location.assign('home.php');*/
		}

		function removedata(id){
			/*in future add a promt (do you want to remove this trainer?)*/
			location.assign('member_profile.php?delete='+id);
		}


		 function showSelectedEx(){
				var ajaxreq=new XMLHttpRequest();
                ajaxreq.open("GET","member_ajax_showSelected.php?fname="+fname+"&email="+email );


                ajaxreq.onreadystatechange=function ()
                {
                 if(ajaxreq.readyState==4 && ajaxreq.status==200)
                        {
                             var response=ajaxreq.responseText;
                            
                             var divelm=document.getElementById('tableSection');
                            
                            
                             divelm.innerHTML=response;
                        }
                }
                
                ajaxreq.send();


		}


        </script>
         
</body>
</html>