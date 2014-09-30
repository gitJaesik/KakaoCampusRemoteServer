<?php
//$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
header('Content-Type: text/html; charset=utf-8');
$json = '{"1" : { "username" : "userJaesik", "usercontents" : "#카카오캠퍼스!!! test1"}, "2" : { "username" : "inseon", "usercontents" : "test 2" }}';

//var_dump(json_decode($json));
//echo "<br />";
var_dump(json_decode($json, true));
echo "<br />";

$test = json_decode($json, true);

echo $test['1']['username'];

echo "<br />";

echo sizeof($test);

?>
