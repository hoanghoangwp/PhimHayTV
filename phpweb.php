<?php
function get_and_write($url, $cache_file) {
	$string = file_get_contents($url);
	$f = fopen($cache_file, 'w');
	fwrite ($f, $string, strlen($string));
	fclose($f);
	return $string;
}
 
function read_content($path) {
	$f = fopen($path, 'r');
	$buffer = '';
	while(!feof($f)) {
		$buffer .= fread($f, 2048);
	}
	fclose($f);
	return $buffer;
}
 
$cache_file = '/home/user/public_html/cache/cache.page.php';
$url = 'http://grouphimhay.tk/page.php';
 
if (file_exists($cache_file)) { // is there a cache file?
    $timedif = (time() - filemtime($cache_file));
     if ($timedif < 3600*24) {
        $html = read_content($cache_file);
    } else { // create a new cache file
        $html = get_and_write($url, $cache_file);
    }
} else { // no file? create a cache file
    $html = get_and_write($url, $cache_file);
}
echo $html;
exit;