<?php

///-----------------------to read all the members informations-----------------------------------
	
///to get a specific memberss info URL: http://localhost:port/project/API/member_database_API.php?id=YourId
///to get all the members info URL: http://localhost:port/project/API/member_database_API.php?id=all

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

			$sqlquery="SELECT * FROM members"; 
			if($id != "all") $sqlquery.=" where M_id=$id";

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

//---------------------to insert a new members data ------------------------------------------------

///request URI: POST http://localhost:port/project/API/member_database_API.php

///data is sent as raw data by setting the request Content-Type as application/json and the data is received in the server side through file_get_contents('php://input') method calling


/*sample data to send with request :  {
	"M_Fname": "api_user",
	"M_Lname": "api_last",
	"M_email": "api_user@gmail.com",
	"M_pass": "api_user101",
	"M_chest": 12,
	"M_shoulder": 21,
	"M_waist": 12,
	"M_description": "api_user_desc",
	"M_weight": 1
}*/



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
		$maxidquery="SELECT MAX(M_id) FROM members";
		$table=$conn->query($maxidquery)->fetchAll();
		
		$newid=$table[0][0]+1;
		$fname=$phparray['M_Fname'];
		$lname=$phparray['M_Lname'];
		$email=$phparray['M_email'];
		$password=$phparray['M_pass'];
		$chest=$phparray['M_chest'];
		$shoulder=$phparray['M_shoulder'];
		$waist=$phparray['M_waist'];
		$description=$phparray['M_description'];
		$weight=$phparray['M_weight'];

		$insertquery="INSERT INTO members (M_Fname, M_Lname, M_email, M_pass, M_chest, M_shoulder, M_waist, M_desc, M_weight) VALUES ('".$fname."','".$lname."','".$email."','".$password."','".$chest."','".$shoulder."','".$waist."','".$description."','".$weight."')";

		$conn->exec($insertquery);
		
		http_response_code(201);
		echo json_encode(array("message"=>"member added successfully", "id"=>$newid));
		
	}
	catch(PDOException $ex){
		///database or query error
		http_response_code(503);

		echo json_encode(array("message"=>"Database Unavailable!"));
	}
}


///------------------------------to update a members's information ------------------------


//request URI: PUT http://localhost:port/project/API/member_database_API.php?id=yourId

///data is sent as raw data by setting the request Content-Type as application/json and the data is received in the server side through file_get_contents('php://input') method calling

/*sample data to send with the request:  {
	"M_Fname": "update_api_user",
	"M_Lname": "updated_api_last",
	"M_email": "api_user@gmail.com",
	"M_pass": "api_user101",
	"M_chest": 12,
	"M_shoulder": 21,
	"M_waist": 12,
	"M_desc": "api_user_desc updated",
	"M_weight": 1
}*/

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
			
			$fname=$phparray['M_Fname'];
			$lname=$phparray['M_Lname'];
			$email=$phparray['M_email'];
			$password=$phparray['M_pass'];
			$chest=$phparray['M_chest'];
			$shoulder=$phparray['M_shoulder'];
			$waist=$phparray['M_waist'];
			$description=$phparray['M_desc'];
			$weight=$phparray['M_weight'];

			$updatequery="UPDATE members SET M_fname='".$fname."',M_Lname='".$lname."',M_email='".$email."', M_pass='".$password."', M_chest='".$chest."', M_shoulder='".$shoulder."', M_waist='".$waist."', M_desc='".$description."', M_weight='".$weight."' WHERE M_id='".$id."' ";
			
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

///------------------------- to delete a member's information --------------------------------------


///request URL: DELETE https://localhost:port/project/API/member_database_API.php?id=YourId
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
			
			$deletequery="DELETE FROM members WHERE M_id=$id ";
			
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


/*member API ends here*/



?>