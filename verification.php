<?php

session_start();
include "./db/dbaccess.php";
include "./db/credentials.php";

if (!($_SESSION['first_time'] == true)){
	header("Location: ../index.php?authorization=already_registered");
}

if (!isset($_SESSION['id'])){
	header("Location: ../index.php?authorization=verify_failure");
}

if (!isset($_POST['submit'])){
	header("Location: ../index.php?authorization=submission_failure");
}


if (!isset($_POST['mcusername'])){
	header("Location: ../index.php?authorization=mcuser_failure");
}

#Adding into the SQL Database

$stmt = $link->prepare("INSERT INTO mcuserlink VALUES (null, ?, ?)");
$stmt->bind_param("ss", $_SESSION['id'], $_POST['mcusername']);
if (!($stmt->execute())){
	header("Location: ..com/index.php?verification=mqsqli_failed");
	
}

#Whitelisting for MC Server through Webhooking

$ch = curl_init();
#Survival Webhooking
curl_setopt($ch, CURLOPT_URL, $survivalurl);
$hookObject = json_encode(['content'=>'whitelist add '.$_POST['mcusername']]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $hookObject);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type" => 'application/json'));
curl_exec($ch);

#Skyblock Switch
curl_setopt($ch, CURLOPT_URL, $skyblockurl);
curl_exec($ch);


curl_close($ch);

header ("Location: ../index.php?verification=successful");
session_destroy();




?>
