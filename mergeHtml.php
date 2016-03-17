<?php
$full='./hinh-danh-su-gia.html';
$files = glob("./hinh-danh-su-gia/*.html");
// usort($files, 'cmp' );

$str = join(array_map("file_get_contents", $files));
file_put_contents( $full, $str);

function cmp($a, $b)
{
	$a_index= getIndex($a);
	$b_index= getIndex($b);
    if ($a_index == $b_index) {
        return 0;
    }
    return ($a_index < $b_index) ? -1 : 1;
}

function getIndex($a){
	// $a = substr($a, 0);
	$params = explode('-', $a);
	return $params[0] * 1; 
}

?>