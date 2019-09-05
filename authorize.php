<?php
#cURL Build
	session_start();
	include "./db/credentials.php";

	
if (!isset($_GET['code'])){
	header("Location: ./index.php");
}
if (isset($_SESSION['username'])){
	header("Location: ./add.php");
}

	
$discordcode = $_GET['code'];
$_SESSION['guild_check'] = "false"; #session variable that determines guild verification

$curl = curl_init();

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, $discordgate."/oauth2/token");
curl_setopt($curl, CURLOPT_POSTFIELDS, array("client_id"=>$client_id, "client_secret"=>$client_secret, "grant_type"=>"authorization_code",
"code"=> $discordcode, "scope"=> "identify guilds", "redirect_uri"=>$redirecturi));

$execution = curl_exec($curl);

curl_close();
#Decoding the JSON

$access_response = json_decode($execution, true);

#Building the Authorization Header
$_SESSION['authorization'] = array("Authorization: ".$access_response['token_type']." ".$access_response['access_token']);

$usercurl = curl_init();
curl_setopt($usercurl, CURLOPT_URL, $discordgate."/users/@me");
curl_setopt($usercurl, CURLOPT_HTTPHEADER, $_SESSION['authorization']);
curl_setopt($usercurl, CURLOPT_RETURNTRANSFER, 1);

$userraw = curl_exec($usercurl);
curl_setopt($usercurl, CURLOPT_URL, $discordgate."/users/@me/guilds");
$guilds = curl_exec($usercurl);


#Iterate through all guild objects checking for ID, set true if found.

$guildsjson = json_decode($guilds, true);
for ($i = 0; $i < count($guildsjson); $i++){
	if ($guildsjson[$i]['id'] == '385684070669221888'){
		$_SESSION['guild_check'] = true;
	}
}

curl_close();
curl_close(); 

#Decoding USER JSON

$userjson = json_decode($userraw, true);



#Creating Session Variables

$_SESSION['username'] = $userjson['username'];
$_SESSION['id'] = $userjson['id'];
$_SESSION['discriminator'] = $userjson['discriminator'];

header("Location: ./add.php");

?>
