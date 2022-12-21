<?php
if (@$_GET['function'] == "new_mail"){
    // $url = file_get_contents('https://dongvanfb.com/api/buyaccount.php?apiKey=d1e8183eda1a9b96cb089683c7067a89&type=1&amount=1');
    // // $url ='{"success":1,"message":"","accounts":"imoruthrw@hotmail.com|gw678Kjwt","balance":5900}';
    // $someArray = json_decode($url,true);
    // echo $someArray['accounts'];
    echo  '{"success":1,"message":"","accounts":"tselenejtx@hotmail.com|gb0hwrxGzl","balance":160}';
}
else if (@$_GET['function'] == "check_mail" && $_GET['email'] && $_GET['pass']){
   $url = 'http://fbvip.org/api/ordercode.php?apiKey=d1e8183eda1a9b96cb089683c7067a89&user='.$_GET['email'].'&pass='.$_GET['pass'];
    $dt = file_get_contents($url);
  $json_dt = json_decode($dt,true);
//   echo $json_dt['id'];
 echo $link_ = "http://fbvip.org/api/getcode.php?apiKey=d1e8183eda1a9b96cb089683c7067a89&id=".$json_dt['id'];
 echo $content = file_get_contents($link_);
  $dt = json_decode($content,true);
// echo ($dt['content']);
$a = '!a-b.c3@j+dk9.0$3e8`~]\]2';
echo $number = str_replace(['+', '-'], '', filter_var($dt['content'], FILTER_SANITIZE_NUMBER_INT));
}


