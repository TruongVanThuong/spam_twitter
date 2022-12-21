<?php
include ('sql.php');
if (@$_POST['username'] && @$_POST['pass']){
	$sql = "SELECT * FROM `username` where `username`='".$_POST['username']."' and password=md5('".$_POST['pass']."') limit 1";
	$dt = mysqli_num_rows(Query($sql));
	$user = (mysqli_fetch_assoc(Query($sql)));
	if ($dt ==1 )
	{
		echo 'OK';
		session_start();
		$_SESSION["user_id"] = $user['user_id'];

	}
	else
	{
		echo 'error';
	}
}