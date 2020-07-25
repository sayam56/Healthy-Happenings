<?php
session_start();
$fname= $_SESSION["fname"];
/*$lname =$_SESSION["lname"];*/
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

	<link href="trainer_profile.css" rel="stylesheet">
	<link rel="icon" href="logo.ico">
</head>
<body>

	<main>
		<div class="container h-100">
			<div class="outer">
				<div class="details">

						<?php 


						/*if(isset($_GET['select']) ){
									$E_id=$_GET['select'];
									$M_id=$_GET['mem'];
									
		                            	

		                        try{
		                            /*$selectsql=" UPDATE members SET members.T_id='".$id."' WHERE members.M_Fname='".$fname."' AND members.M_pass='".$password."' ";*/

		                            /*$sql= "SELECT T_id FROM trainers WHERE trainers.T_Fname='".$fname."' and trainers.T_email='".$email."' ";
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
		                            
		                        }*/
		                   #}

						/*echo "name is : ".$fname." ".$lname." ";*/
						$sqlquery="SELECT * from trainers where T_Fname= '".$fname."' and T_email= '".$email."' ";

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
                				
                					Trainer ID: <?php echo $row[0] ?>
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
										Monthly Rate: <?php echo $row[6] ?> TK<br>
										Semi-Annial Rate: <?php echo $row[7] ?> TK <br>
										Annual Rate: <?php echo $row[8] ?> TK <br>
										Achievements: <?php echo $row[10] ?> <br>
										Description: <?php echo $row[5] ?> <br>
									</h4></div>
                				<?php
                			}
                		}
						?>
						
					
					
				</div> <!-- trainer info ends here -->



				<input type="button" style="align-self: center;" class="btn btn-outline-light btg-lg"  name="show" value="SHOW/HIDE MEMBERS UNDER TRAINING" onclick="showMembers();">



				<div id="membertable" class="table-responsive">
						<div id="desc" style="text-align: center; color: white;">
							<p><b>MEMBERS UNDER TRAINING!</b></p>

							<table class="table-dark" style=" width: 100%">
								<thead style="border-bottom: 2px solid black;">
									<tr>
										<th scope="col">Member Id</th>
										<th scope="col">Member name</th>
										<th scope="col">Member email</th>
										<th scope="col">Chest Width</th>
										<th scope="col">Shoulder Width</th>
										<th scope="col">Waist Size</th>
										<th scope="col">Weight(IN KG)</th>
										<th scope="col">Description</th>
										<th scope="col">Selected Exercises</th>
										<th scope="col">Exercise Selector</th>
										<!-- might add a button to reject a member -->
									</tr>
								</thead>

								<tbody class="table-dark">
									
									<?php

									$sql="SELECT * FROM members,trainers,mjt WHERE trainers.T_id=mjt.T_id AND members.M_id=mjt.M_id AND trainers.T_Fname='".$fname."' AND trainers.T_email='".$email."' Group by mjt.M_id ";
									$object1= $conn->query($sql);
									
									if ($object1->rowCount() == 0) {
										?>
										<tr>
											<td colspan="10" style="text-align: center;">!!! NO MEMBERS UNDER TRAINING YET !!!</td>
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
												<td><?php echo $key[12] ?></td>
												<td><?php echo $key[9] ?></td>
												<td>
													<input type="button" class="btn btn-outline-light btg-lg" name="showEx" data-toggle="modal" data-target="#selectedExercisesModal" value="Click To Show" onclick="showSelectedEx(<?php echo $key[0]?>);">
												</td>
												<td> 
													<input type="button" class="btn btn-outline-light btg-lg" name="setEx" data-toggle="modal" data-target="#myModal" value="Set Exercises" onclick="selectEx(<?php echo $key[0] ?>);" > <!-- add onclick shhowExerciseList --> 
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
			</div><!-- outer ends here -->

		</div>
	</main>

	<!-- Available Exercises Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">

		    <!-- Modal content-->
		    <div id="modalContent" class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Available Exercises</h4>
		      </div>
		      <div id="modalbody" class="modal-body">
		      	<div class="exerciseTable table-responsive">
		      		<table class="col-12" width="100%">
		      			<thead>
		      				<tr>
		      					<th>Exercise ID</th>
		      					<th>Exercise Name</th>
		      					<th>Exercise Type</th>
		      					<th>Exercise Level</th>
		      					<th>How To Perform</th>
		      					<th>Select Exercise</th>
		      				</tr>
		      			</thead>

		      			<tbody>
		      				<?php


									$sql="SELECT * FROM exercise";
									$object1= $conn->query($sql);
									
									if ($object1->rowCount() == 0) {
										?>
										<tr>
											<td colspan="6" style="text-align: center;">NO DATA FOUND!!!</td>
										</tr>
										<?php
									}

									else
									{
										$table= $object1->fetchAll();

										foreach ($table as $key) {
											# code...
											?>
											<tr style="border:2px solid black; overflow: auto;">
												<td><?php echo $key[0] ?></td>
												<td><?php echo $key[1]?></td>
												<td><?php echo $key[2] ?></td>
												<td><?php echo $key[3] ?></td>
												<td> <img src="<?php echo $key[4] ?>" alt="image here" height="80" width="80" /> </td>
												<td> 
													<input type="button" class="btn btn-outline-dark btg-sm" name="select" value="SELECT" onclick="selectExe(<?php echo $key[0] ?>); changeSelectBTN(<?php echo $key[0] ?>);" id="selectorBTN" > 
												</td>
											</tr>
											<?php
										}
									}

									?>
		      			</tbody>
		      		</table>
		      	</div><!-- exercise table ends -->
		      </div><!-- modal body ends here -->
		      <div class="modal-footer" id="modalFooter">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>

		      <!-- to show the whole div after ajax -->
		      <div id="showModalEx">
		      	
		      </div>
		    </div> <!-- showmodal Content ends here -->

		  </div>
		</div> <!-- total showmodal ends here -->









		<!-- Selected Exercises Modal -->
		<div id="selectedExercisesModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">
		  	<?php
						echo "<script>
									console.log('inside modal');
								</script>";
					?>
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
		      					<th>Remove</th>
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

		var member={};
		var fname="<?php echo $fname ?>";
		var email= "<?php echo $email ?>";

	/*	console.log(fname);
		console.log(password);*/

/*		var dropdown=document.getElementById('dropbox');
            dropdown.addEventListener('change',ajaxfn);*/


		function showMembers(){
			

			if (document.getElementById('membertable').style.display == "none") {
                	document.getElementById('membertable').style.display = "inline";
                }
                else
                	{
                		document.getElementById('membertable').style.display="none";
                	}
        }

		function selectEx(id){
				member.id= id;
			 	
		}

		


		function selectExe(id1)
			 {		

			 /*implement the selected highlighted button here*/	 	

			 	var ex= id1;		
			 	
				/*location.assign('trainer_profile.php?select='+ex+'&mem='+member.id);*/


				var ajaxreq=new XMLHttpRequest();
                ajaxreq.open("GET","trainer_ajax.php?select="+ex+"&mem="+member.id+"&fname="+fname+"&email="+email );
                console.log(member.id);
                ajaxreq.onreadystatechange=function ()
                {
                 if(ajaxreq.readyState==4 && ajaxreq.status==200)
                        {
                             var response=ajaxreq.responseText;
                            
                             var divelm=document.getElementById('showModalEx');

                            
                            
                             divelm.innerHTML=response;
                        }
                }
                
                ajaxreq.send();

			 }

			 function changeSelectBTN(e_id)
			 {
			 	document.getElementById('selectorBTN').class="btn btn-outline-light btg-lg";
			 	/*this doesnt work, fix it later*/
			 }


			 function showSelectedEx(id2){
			 	member.id= id2;
				var ajaxreq=new XMLHttpRequest();
                ajaxreq.open("GET","trainer_ajax_showSelected.php?member="+id2+"&fname="+fname+"&email="+email ); /*member.id from the show selected button and fname and email for t_id */


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





		function removeExercise(id){
				var ex= id;		


				/*location.assign('trainer_profile.php?select='+ex+'&mem='+member.id);*/
				 var ajaxreq=new XMLHttpRequest();
                ajaxreq.open("GET","trainer_ajax_removeExercise.php?remove="+ex+"&fname="+fname+"&email="+email+"&M_id="+member.id);

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