<?php

$dir = './phong-luu';
$n_dir = '.';
$new_file = 'full.html';

creatFile($n_dir, $new_file);
if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      
    }
    closedir($dh);
}

function appendfile($n_dir, $full_file, $file){

}

function creatFile($dir, $name){
	$fp = fopen(getFullPath($dir, $name), "w");
	fwrite($fp, openHtml());
	fclose($fp);
}


function endFile($dir, $name){
	$fp = fopen(getFullPath($dir, $name), "a+");
	fwrite($fp, endHtml());
	fclose($fp);
}

function getFullPath($dir, $name){
	return $dir.'/'.$name;
}

function openHtml(){
	return '<!DOCTYPE html><html lang="vn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body>';
}

function endHtml(){
	return '</body></html>';
}



?>