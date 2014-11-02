<?php
header('Content-Type: text/html; charset=utf-8');

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();

if (isset($_POST['jsonMyStoriesInfo'])) {

	$inputArray = array();
	$inputArray = json_decode($_POST['jsonMyStoriesInfo'], true);
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();
	
    mysql_query("set names 'utf8'");
  	//jsonMyStoriesInfo = { "1" : { "username" : "jaesik" }, { "usercontents" : "some" } }

	for($i = 1; $i <= sizeof($inputArray); $i++){
		$username = cleanMe($inputArray[$i]['username']);
		$usercontents = cleanMe($inputArray[$i]['usercontents']);
		$kind = cleanMe($inputArray[$i]['kind']);

    	$result = 
			mysql_query("INSERT INTO boardtable1_univer(username, usercontents, kind) 
					VALUES('$username', '$usercontents', '$kind')");

	}
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Product successfully created.";
        $response["utftest"] = $inputArray[1]['username'];
        $response["name"] = $username;
        $response["all"] = $inputArray;
        $response["korea"] = "한글 테스트";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}

function cleanMe($input) {
   $input = mysql_real_escape_string($input);
   $input = htmlspecialchars($input, ENT_IGNORE, 'utf-8');
   $input = strip_tags($input);
   $input = stripslashes($input);
   return $input;
}

?>
