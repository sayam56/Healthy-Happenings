<?php
try{
                $conn=new PDO("mysql:host=localhost;dbname=gym_database;",'root','');
                echo "<script>console.log('connection successful');</script>";
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "<script>window.alert('connection error');</script>";
            }
		                    

					if(isset($_GET['fname']) ){
									
									$fname=$_GET['fname'];
									$email=$_GET['email'];
		                            	echo "<script> console.log('im here'); </script>";

		                        try{
		                            /*$selectsql=" UPDATE members SET members.T_id='".$id."' WHERE members.M_Fname='".$fname."' AND members.M_pass='".$password."' ";*/

		                            $sql= "SELECT M_id FROM members WHERE M_Fname='".$fname."' and M_email='".$email."' ";
		                            $object=$conn->query($sql);
		                            $M_id= $object->fetchAll();
		                            foreach ($M_id as $key) {
		                            	# code...
		                            	$selectsql=" SELECT E_id FROM ejmt WHERE M_id='".$key[0]."' GROUP BY E_id ";
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


?>
