<?php
 
// array for JSON response
$response = array();
 
if (isset($_POST['kind'])) {
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	 
	$query = "SELECT * FROM boardtable1_univer where kind='".$_POST['kind']."';";
	$result = mysql_query($query) or die(mysql_error());
	 
	// check for empty result
	if (mysql_num_rows($result) > 0) {
		// looping through all results
		$response["data"] = array();
	 
		while ($row = mysql_fetch_array($result)) {
			// temp user array
			$remoteData = array();
			$remoteData["id"] = $row["id"];
			$remoteData["username"] = $row["username"];
			$remoteData["usercontents"] = $row["usercontents"];
			$remoteData["kslink"] = $row["kslink"];
			$remoteData["created_at"] = $row["created_at"];
	 
			array_push($response["data"], $remoteData);
		}
		// success
		$response["success"] = 1;
	 
		// echoing JSON response
		echo json_encode($response);
	} else {
		$response["success"] = 0;
		$response["message"] = "No data found";
	 
		// echo no users JSON
		echo json_encode($response);
	}
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}

?>
