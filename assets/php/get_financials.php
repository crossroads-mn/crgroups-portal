<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
function slug($z){
    $z = strtolower($z);
    $z = preg_replace('/[^a-z0-9 -]+/', '', $z);
    $z = ucfirst($z);
    return trim($z, '-');
}

include 'auth.php';

$connection = mysqli_connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_SCHEMA);
	$query = "SELECT * FROM API_INTEGRATIONS WHERE NAME = 'Freshbooks';";
	$result = mysqli_query($connection, $query) or die("Query fail: " . mysqli_error());
	$outp = "";

	if($rs = mysqli_fetch_array($result)) {
		$client_id = $rs['TOKEN'];
		$client_secret = $rs['SECRET'];
	}
	$connection->close();

//Global vars needed
$redirect_uri = "https://" .  $_SERVER['SERVER_NAME'] . "/index.php";
if(isset($_GET["code"])) {
	$code = htmlspecialchars($_GET["code"]);
}


$post = [
	"grant_type" => "authorization_code",
	"client_secret" => "$client_secret",
	"code" => "$code",
	"client_id" => "$client_id",
	"redirect_uri" => "$redirect_uri"
];

//Use PHP curl to do post and all that jazz
$ch = curl_init("https://api.freshbooks.com/auth/oauth/token");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Api-Version: alpha')                                                                       
);

$response = curl_exec($ch);
$access_token = json_decode($response, true);
$token = $access_token['access_token'];
$access_headers = array(                                                                          
    'Content-Type: application/json',                                                                                
    'Api-Version: alpha',
    "Authorization: Bearer $token");


//We have now another step to see our data. That is... TO GRAB OUR ACCOUNT ID! hooray
$acch = curl_init("https://api.freshbooks.com/auth/api/v1/users/me");
curl_setopt($acch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($acch, CURLOPT_HTTPHEADER, $access_headers);
$resp = curl_exec($acch);
$accjson = json_decode($resp, true);
$account_id = $accjson['response']['business_memberships'][0]['business']['account_id'];


//Now we need to set up our GET requests to grab the financial data :)
$chh = curl_init("https://api.freshbooks.com/accounting/account/" . $account_id . "/invoices/invoices?status=4");
curl_setopt($chh, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($chh, CURLOPT_HTTPHEADER, $access_headers);
$re = curl_exec($chh);

echo json_encode($re);



?>