<?php
 echo "<script>console.log('removal page in SUCCESSFULL!!!!');</script>";
try{
                $conn=new PDO("mysql:host=localhost;dbname=gym_database;",'root','');
                echo "<script>console.log('connection successful');</script>";
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "<script>window.alert('connection error');</script>";
            }


					if(isset($_GET['remove']) ){
									$E_id=$_GET['remove'];
									$fname=$_GET['fname'];
									$email=$_GET['email'];
									$M_id=$_GET['M_id'];
									
                            		echo "<script>console.log('fname: '+fname+' email: '+email+' eid: '+eid+' done');</script>";

		                        try{
		                            $sql= "SELECT T_id FROM trainers WHERE trainers.T_Fname='".$fname."' and trainers.T_email='".$email."' ";
		                            $object=$conn->query($sql);
		                            $T_id= $object->fetchAll();
		                            foreach ($T_id as $key) {
		                            	# code...
		                            	$deletesql=" DELETE FROM ejmt WHERE T_id='".$key[0]."' AND E_id='".$E_id."' AND M_id='".$M_id."' ";
		                            }

	                            	$conn->exec($deletesql);
		                            echo "<script>console.log('INSERT SUCCESSFULL!!!!');</script>";
		                        }
		                        catch(PDOException $ex1){
		                            echo "<script>console.log(' UNSUCCESSFULL!!');</script>";
		                            
		                        }


		                        try{
		                            

		                            $sql= "SELECT T_id FROM trainers WHERE trainers.T_Fname='".$fname."' and trainers.T_email='".$email."' ";
		                            $object=$conn->query($sql);
		                            $T_id= $object->fetchAll();
		                            foreach ($T_id as $key) {
		                            	# code...
		                            	$selectsql=" SELECT E_id FROM ejmt WHERE T_id='".$key[0]."' AND M_id='".$M_id."' GROUP BY E_id ";
		                            }

	                            	$object1=$conn->query($selectsql);
	                            	$E_id_modal= $object1->fetchAll();
	                            	foreach ($E_id_modal as $key) {
	                            	 	# code...
	                            	 	$showsql= " SELECT * from exercise WHERE E_id='".$key[0]."'  ";

	                            	 	$object2= $conn->query($showsql);
									
										if ($object2->rowCount() == 0) {
											?>
											<tr>
												<td colspan="5" style="text-align: center;">NO Exercises Given Yet!!</td>
											</tr>
											<?php
										}

										else
										{
											$table2= $object2->fetchAll();

											foreach ($table2 as $key) {
												# code...
												?>
												<tr style="border:2px solid black; overflow: auto;" id="tablerow">
													<td><?php echo $key[0] ?></td>
													<td><?php echo $key[1]?></td>
													<td><?php echo $key[2] ?></td>
													<td><?php echo $key[3] ?></td>
													<td> <img src="<?php echo $key[4] ?>" alt="image here" height="80" width="80" /> </td>
													<td> 
													<input type="button" class="btn btn-outline-dark btg-sm" name="remove" value="REMOVE" onclick="removeExercise(<?php echo $key[0] ?>);" > 
												</td>
													
												</tr>

												<?php
												break;
											}/*foreache inner*/
										} /*_____Else ends here*/
	                            	 }/*foreeach outer*/
		                            echo "<script>console.log('INSERT SUCCESSFULL!!!!');</script>";
		                        }/*main try ends here*/



		                        catch(PDOException $ex1){
		                            echo "<script>console.log(' UNSUCCESSFULL!!');</script>";
		                            
		                        }
		                    }
		                    else
		                    {
		                    	echo "<script>console.log('did not get removed');</script>";
		                    }
?>