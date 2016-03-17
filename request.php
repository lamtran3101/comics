<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url_target = null;
if(isset($_GET['url'])) {
	$url_target = $_GET['url'];
}


if($url_target) {
	$output = getComic($url_target);
	echo $output;
} else {
	echo 'url is invalid';
};

function getComic($url){
	$ch = curl_init(); 
   	curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
     // $output contains the output string 
        $output = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch);    
        // if($output == '' or $output == null) {
        //     sleep(5);
        //     return getComic($url);
        // }
  
        return  $output;
};

function getTextOnly($post_ref_id){

};

?>