<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
if (isset($_POST['kind'])) {
	// include db connect class
	require_once __DIR__ . '/db_connect.php';
	 
	// connecting to db
	$db = new DB_CONNECT();
	 
	$query = "SELECT * FROM boardtable1_univer where kind='".$_POST['kind']."';";
	// get all products from products table
	$result = mysql_query($query) or die(mysql_error());
	 
	// check for empty result
	if (mysql_num_rows($result) > 0) {
		// looping through all results
		// products node
		$response["data"] = array();
		//$response["products"] = array();
	 
		while ($row = mysql_fetch_array($result)) {
			// temp user array
			$product = array();
			$product["id"] = $row["id"];
			$product["username"] = $row["username"];
			$product["usercontents"] = $row["usercontents"];
			$product["kslink"] = $row["kslink"];
			$product["created_at"] = $row["created_at"];
			//$product["updated_at"] = $row["updated_at"];
	 
			// push single product into final response array
			array_push($response["data"], $product);
			//array_push($response["products"], $product);
		}
		// success
		$response["success"] = 1;
	 
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "No data found";
		//$response["message"] = "No products found";
	 
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
