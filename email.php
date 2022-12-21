<?php
$code=false;
if (@$_GET['func_email'] == "check_mail" && (@$_GET['email'] != null))
{
	
	$link ="https://gmailnator.p.rapidapi.com/inbox";
	$dt="{\r\n    \"email\": \"".$_GET['email']."\",\r\n    \"limit\": 10\r\n}";
	$code = true;
}
else{
	$link ="https://gmailnator.p.rapidapi.com/generate-email";
	$dt= "{\r\n    \"options\": [\r\n        3,\r\n        4,\r\n    5,\r\n 6,\r\n]\r\n}";
}
post_data($link,$dt,$code);

function post_data($link,$dt,$code)
{
	$curl = curl_init();
curl_setopt_array($curl, [
	CURLOPT_URL => $link,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => $dt,
	CURLOPT_HTTPHEADER => [
		"content-type: application/json",
		"x-rapidapi-host: gmailnator.p.rapidapi.com",
		"x-rapidapi-key: 2b7a9e0927mshe5893b0b04a81e2p1f82a9jsna8df8b4d7c3c"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} 
	$arr= json_decode($response,true);
	var_dump($arr);
	$fp = fopen('email.txt', 'a');
	fwrite($fp, $_GET['email']."\n");
	fclose($fp);
	if ($code == true)
	{
		foreach ($arr as $k =>$v)
		{
			$pos = strpos($v['subject'], "Twitter ");
			if ($pos != null)
			{
				preg_match_all('!\d+!', $v['subject'], $matches);
				$code = array ( "code" => $matches[0][0]);
				echo json_encode($code);
				$fp = fopen('acc_twitter.txt', 'a');
				fwrite($fp, $_GET['email']."\n");
				fclose($fp);
			}

		}
	}
	else {
		echo $response;
	}

}
