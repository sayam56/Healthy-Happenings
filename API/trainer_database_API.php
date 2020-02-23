<?php

///-----------------------to read all the trainers informations-----------------------------------
	
///to get a specific memberss info URL: http://localhost:port/project/API/trainer_database_API.php?id=YourId
///to get all the members info URL: http://localhost:port/project/API/trainer_database_API.php?id=all

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

			$sqlquery="SELECT * FROM trainers"; 
			if($id != "all") $sqlquery.=" where T_id=$id";

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

//---------------------to insert a new trianers data ------------------------------------------------

///request URI: POST http://localhost:port/project/API/trainer_database_API.php

///data is sent as raw data by setting the request Content-Type as application/json and the data is received in the server side through file_get_contents('php://input') method calling

/*sample data to send with the request: 
{
	"T_Fname": "_api_user",
	"T_Lname": "api_last",
	"T_email": "api_user@gmail.com",
	"T_pass": "api_user101",
	"T_desc": "api_user_desc",
	"T_monrate": 12,
	"T_semirate": 21,
	"T_anrate": 12,
	"T_achievements": "api_user_achievements"
}
*/



if($_SERVER['REQUEST_METHOD']=='POST'){
	///setting the headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	///receiving the entity body of HTTP requests
	$jsonstring=file_get_contents("php://input");
	
	$phparray=json_decode($jsonstring,true);
	
	///connecting to database
	try{
		$conn=new PDO("mysql:host=localhost;dbname=gym_database;",'root','');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		///automatically setting the next available id to the next student
		///next available id = current maxid + 1
		$maxidquery="SELECT MAX(T_id) FROM trainers";
		$table=$conn->query($maxidquery)->fetchAll();
		
		$newid=$table[0][0]+1;
		$fname=$phparray['T_Fname'];
		$lname=$phparray['T_Lname'];
		$email=$phparray['T_email'];
		$password=$phparray['T_pass'];
		$description=$phparray['T_desc'];
        $monrate=$phparray['T_monrate'];
        $semirate=$phparray['T_semirate'];
        $anrate=$phparray['T_anrate'];
        $achievements=$phparray['T_achievements'];

		$insertquery="INSERT INTO trainers  (T_Fname, T_Lname, T_email, T_pass, T_desc, T_monrate, T_semirate, T_anrate, T_achievements) VALUES ('".$fname."','".$lname."','".$email."','".$password."','".$description."','".$monrate."','".$semirate."','".$anrate."','".$achievements."')";

		$conn->exec($insertquery);
		
		http_response_code(201);
		echo json_encode(array("message"=>"Trainer added successfully", "id"=>$newid));
		
	}
	catch(PDOException $ex){
		///database or query error
		http_response_code(503);

		echo json_encode(array("message"=>"Database Unavailable!"));
	}
}


///------------------------------to update a trainer's information ------------------------


//request URI: PUT http://localhost:port/project/API/trainer_database_API.php?id=yourId

///data is sent as raw data by setting the request Content-Type as application/json and the data is received in the server side through file_get_contents('php://input') method calling

/*sample data to send with the request: 
{
	"T_Fname": "updated_api_user",
	"T_Lname": "upadated_api_last",
	"T_email": "api_user@gmail.com",
	"T_pass": "api_user101",
	"T_desc": "api_user_desc_updated",
	"T_monrate": 12,
	"T_semirate": 21,
	"T_anrate": 12,
	"T_achievements": "api_user_achievements_updated"
}
*/

if($_SERVER['REQUEST_METHOD']=="PUT"){
	///setting the necessary headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	///checking the id field
	if(isset($_GET['id'])){
		///receiving the parameter value
		$id=$_GET['id'];
		
		///receiving the entity body of HTTP requests
		$jsonstring=file_get_contents("php://input");

		$phparray=json_decode($jsonstring,true);

		///connecting to database
		try{
			$conn=new PDO("mysql:host=localhost;dbname=gym_database;",'root','');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$fname=$phparray['T_Fname'];
			$lname=$phparray['T_Lname'];
			$email=$phparray['T_email'];
			$password=$phparray['T_pass'];
	        $monrate=$phparray['T_monrate'];
	        $semirate=$phparray['T_semirate'];
	        $anrate=$phparray['T_anrate'];
	        $description=$phparray['T_description'];
	        $achievements=$phparray['T_achievements'];

			$updatequery="UPDATE trainers SET T_fname='".$fname."',T_Lname='".$lname."',T_email='".$email."', T_pass='".$password."', T_desc='".$description."', T_monrate='".$monrate."', T_semirate='".$semirate."', T_anrate='".$anrate."', T_achievements='".$achievements."' WHERE T_id='".$id."' ";
			
			$no_rows=$conn->exec($updatequery);
			
			http_response_code(200);

			echo json_encode(array("message"=>"$no_rows rows have been updated"));
			
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

///------------------------- to delete a trainer's information --------------------------------------


///request URL: DELETE https://localhost:port/project/API/trainer_database_API.php?id=YourId
if($_SERVER['REQUEST_METHOD']=="DELETE"){
	///setting the necessary headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	
	///checking the id field
	if(isset($_GET['id'])){
		///receiving the parameter value
		$id=$_GET['id'];
		
		///connecting to database
		try{
			$conn=new PDO("mysql:host=localhost;dbname=gym_database;",'root','');
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$deletequery="DELETE FROM trainers WHERE T_id=$id ";
			
			$no_rows=$conn->exec($deletequery);
			
			http_response_code(200);

			echo json_encode(array("message"=>"$no_rows rows have been deleted"));
			
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


/*trainer API ends here*/



?>