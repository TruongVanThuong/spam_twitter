<?php
ini_set('display_errors', 1);
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
$url = 'https://api.twitter.com/1.1/followers/list.json';
$getfield = '?count=200&screen_name=GreatXvids&next_cursor=1682478993882173840';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
 $following = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
 $kq = json_decode($following,true);
 var_dump($kq);
 echo count ($kq);
 $kq = $kq['users'];
foreach ($kq as $key => $value) {
    echo $value['screen_name'] . ", " . $value["followers_count"] . "<br>";
  }

// $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
 
// $requestMethod = "GET";
 
// $getfield = '?screen_name=iagdotme&count=20';
 
// $twitter = new TwitterAPIExchange($settings);
// echo $twitter->setGetfield($getfield)
//              ->buildOauth($url, $requestMethod)
//              ->performRequest();