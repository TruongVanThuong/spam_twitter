<?php
include('sql.php');
Function Lay_So(){
	$dt = file_get_contents("https://chothuesimcode.com/api?act=number&apik=19511bff&appId=1030");
 	$arr = (json_decode($dt));
	//  var_dump($arr);
 	$av = $arr->Result;
  	echo $av->Number."|".$av->Id;
}
function Lay_code($id)
{
	$dt = file_get_contents("https://chothuesimcode.com/api?act=code&apik=19511bff&id=".$id);
	$arr = (json_decode($dt));
 	$av = $arr->Result; 
  	echo $av->Code;
}
if (@$_GET['id_order'])
{
	Lay_code($_GET['id_order']);
}
else if (@$_GET['get_so'])
{
	Lay_So();
}
else if (@$_GET['reveri'])
{
	$dt = file_get_contents("https://chothuesimcode.com/api?act=number&apik=19511bff&appId=1030&number=".$_GET['reveri']);
	$arr = (json_decode($dt));
 	$av = $arr->Result;
  	echo $av->Number."|".$av->Id;
	$sql ="INSERT INTO `account`(`username`, `pass`,  `create_time`,  `logined`, `web_services`) VALUES ('$av->Number','trungdeptrai',now(),'1','chosimthuecode')";
	Query($sql);
}