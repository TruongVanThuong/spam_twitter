<?php

ini_set('display_errors', 0);


require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "3946649953-yoYVVEUZQrHrLYqyLgdVp3DWmoGmuFPtLAJw7VL",
    'oauth_access_token_secret' => "oK4a29WJdUFYFyAU2irBFESkL10XaguoU2jviOEZ7G3mM",
    'consumer_key' => "axDUwelSHRBCgAjnH55Br3ekF",
    'consumer_secret' => "wgb5PMmIsfUOicNzAsrta8gPqPoHWPcVFPDu6V2M7HbFcFuaaS"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
// $postfields = array(
//     'screen_name' => 'xclaraluiza', 
//     'skip_status' => '1'
// );

// /** Perform a POST request and echo the response **/
// $twitter = new TwitterAPIExchange($settings);
// echo $twitter->buildOauth($url, $requestMethod)
//              ->setPostfields($postfields)
//              ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/

 $id_cursor = @$_POST['next_cursor'];
if ($id_cursor ==0 || $id_cursor =='batdau')
{
    echo "If";
    echo "</br>";
    $url = 'https://api.twitter.com/1.1/followers/list.json';
    $getfield = '?count=200&screen_name=GreatXvids&cursor='+$id_cursor;
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
     $following = $twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest();
     $kq = json_decode($following,true);
    
    //  print("<pre>".print_r($kq,true)."</pre>");
    echo "next_cursor:".$kq['next_cursor'];
    $kq = $kq['users'];
     
     $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    
    foreach ($kq as $key => $value) {
        //echo $value['screen_name'] . ", " . $value["followers_count"] . "<br>";
    fwrite($myfile, $value['screen_name']."\n");
    
      }
    
      fclose($myfile);
}
else
{

    echo "else";
    echo "</br>";

    $url = 'https://api.twitter.com/1.1/followers/list.json';
    $getfield = '?count=200&screen_name=GreatXvids';
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
     $following = $twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest();
     $kq = json_decode($following,true);
    
    // print("<pre>".print_r($kq,true)."</pre>");
     echo "next_cursor:".$kq['next_cursor'];
     $kq = $kq['users'];
     
     $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    
    foreach ($kq as $key => $value) {
        //echo $value['screen_name'] . ", " . $value["followers_count"] . "<br>";
    fwrite($myfile, $value['screen_name']."\n");
    
      }
    
      fclose($myfile);
}