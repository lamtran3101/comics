<?php

 $postdata = file_get_contents("php://input");
 $request = json_decode($postdata);

if(isset($request->comic)){
	$comic = $request->comic;
	echo json_encode($comic->name);
	savefile($comic);
} else {
	echo 'no data';
};

function savefile($comic){
	$path = dirname ( __FILE__ );
	$directory = convert2machine_name($comic->title);
	$filename = get_chapter_id($comic->chapter_id).'-'.convert2machine_name($comic->name).'.html';
	if (!file_exists('path/to/directory')) {
	    mkdir($path.'/'.$directory, 0777, true);
	}

	$path_2_file = $path.'/'.$directory.'/'.$filename;
	$fp = fopen($path_2_file, "w");
	fwrite($fp, exportPlaintext($comic));
	fclose($fp);
}

function get_chapter_id($id){
	while(strlen($id) < 4){
		$id = '0'.$id;
	}
	return $id;
}

function exportPlaintext($comic){
	$content = '';
    $content .= '<h1>'.$comic->name.'</h1><div class="content">';
    $content .= $comic->detail;
    $content .= '</div>';
    return $content;
}

function exportHtml($comic){
	$content = '<!DOCTYPE html><html lang="vn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head><body>';
    $content .= '<h1>'.$comic->name.'</h1>';
    $content .= $comic->detail;
    $content .= '</body></html>';
    return $content;
}


function convert2machine_name($name){
	$name = remove_vietnamese_accents($name);
	return preg_replace('@[^\.a-z0-9-]+@','-', strtolower($name));
}

function remove_vietnamese_accents($string) {
	$trans = array(
		'à'=>'a','á'=>'a','ả'=>'a','ã'=>'a','ạ'=>'a',
		'ă'=>'a','ằ'=>'a','ắ'=>'a','ẳ'=>'a','ẵ'=>'a','ặ'=>'a',
		'â'=>'a','ầ'=>'a','ấ'=>'a','ẩ'=>'a','ẫ'=>'a','ậ'=>'a',
		'À'=>'a','Á'=>'a','Ả'=>'a','Ã'=>'a','Ạ'=>'a',
		'Ă'=>'a','Ằ'=>'a','Ắ'=>'a','Ẳ'=>'a','Ẵ'=>'a','Ặ'=>'a',
		'Â'=>'a','Ầ'=>'a','Ấ'=>'a','Ẩ'=>'a','Ẫ'=>'a','Ậ'=>'a',
		'đ'=>'d','Đ'=>'d',
		'è'=>'e','é'=>'e','ẻ'=>'e','ẽ'=>'e','ẹ'=>'e',
		'ê'=>'e','ề'=>'e','ế'=>'e','ể'=>'e','ễ'=>'e','ệ'=>'e',
		'È'=>'e','É'=>'e','Ẻ'=>'e','Ẽ'=>'e','Ẹ'=>'e',
		'Ê'=>'e','Ề'=>'e','Ế'=>'e','Ể'=>'e','Ễ'=>'e','Ệ'=>'e',
		'ì'=>'i','í'=>'i','ỉ'=>'i','ĩ'=>'i','ị'=>'i',
		'Ì'=>'i','Í'=>'i','Ỉ'=>'i','Ĩ'=>'i','Ị'=>'i',
		'ò'=>'o','ó'=>'o','ỏ'=>'o','õ'=>'o','ọ'=>'o',
		'ô'=>'o','ồ'=>'o','ố'=>'o','ổ'=>'o','ỗ'=>'o','ộ'=>'o',
		'ơ'=>'o','ờ'=>'o','ớ'=>'o','ở'=>'o','ỡ'=>'o','ợ'=>'o',
		'Ò'=>'o','Ó'=>'o','Ỏ'=>'o','Õ'=>'o','Ọ'=>'o',
		'Ô'=>'o','Ồ'=>'o','Ố'=>'o','Ổ'=>'o','Ỗ'=>'o','Ộ'=>'o',
		'Ơ'=>'o','Ờ'=>'o','Ớ'=>'o','Ở'=>'o','Ỡ'=>'o','Ợ'=>'o',
		'ù'=>'u','ú'=>'u','ủ'=>'u','ũ'=>'u','ụ'=>'u',
		'ư'=>'u','ừ'=>'u','ứ'=>'u','ử'=>'u','ữ'=>'u','ự'=>'u',
		'Ù'=>'u','Ú'=>'u','Ủ'=>'u','Ũ'=>'u','Ụ'=>'u',
		'Ư'=>'u','Ừ'=>'u','Ứ'=>'u','Ử'=>'u','Ữ'=>'u','Ự'=>'u',
		'ỳ'=>'y','ý'=>'y','ỷ'=>'y','ỹ'=>'y','ỵ'=>'y',
		'Y'=>'y','Ỳ'=>'y','Ý'=>'y','Ỷ'=>'y','Ỹ'=>'y','Ỵ'=>'y'
	);
	return strtr($string, $trans);
}
?>