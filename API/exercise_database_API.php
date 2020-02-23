<?php

///-----------------------to read all the exercise informations-----------------------------------
	
///to get a specific memberss info URL: http://localhost:port/project/API/exercise_database_API.php?id=YourId
///to get all the members info URL: http://localhost:port/project/API/exercise_database_API.php?id=all


/// You can only use this api to GET exercise table data since the INSERT/UPDATE permission is neither available to the Members nor to the Trainers

if($_SERVER['REQUEST_METHOD']=="GET"){
	///setting necessary CORS headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	if(isset($_GET['id'])){
		///receiving the parameter value
		$id=$_GET['id'];

		///connecting to database
		try{
			$conn=new PDO("mysql:host=localhost;dbname=gym_database;",'root','');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sqlquery="SELECT * FROM exercise"; 
			if($id != "all") $sqlquery.=" where E_id=$id";

			$pdostmt=$conn->query($sqlquery);
			if($pdostmt->rowCount()>0){
				$table=$pdostmt->fetchAll();

				http_response_code(200);
				echo json_encode($table);
			}
			else{
				///no data found for the given id value
				http_response_code(400);
				
				echo json_encode(array("message"=>"Invalid id"));
			}

		}
		catch(PDOException $ex){
			///database or query error
			http_response_code(503);
				
			echo json_encode(array("message"=>"Database Unavailable"));
		}
	}
	else{
		///no id value is set error
		http_response_code(404);
				
		echo json_encode(array("message"=>"id parameter not found"));
	}
}

///setting header informations for preflighted requests like: POST, PUT, DELETE etc.
if($_SERVER['REQUEST_METHOD']=="OPTIONS"){
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type");
	header("Access-Control-Allow-Max-Age: 86400");
}


/*exercise API ends here*/



?>