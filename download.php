<?php

$image = basename($_SERVER['REQUEST_URI']);
$filename = dirname(__FILE__).'/images/'.$image;

if(!file_exists($filename)) {

	echo 'Invalid File to download';
	exit;
}

$mime = ($mime = getimagesize($filename)) ? $mime['mime'] : $mime;
$size = filesize($filename);

header("Content-type: " . $mime);
header("Content-Length: " . $size);
// NOTE: Possible header injection via $basename
header("Content-Disposition: attachment; filename=" . $image);
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
echo file_get_contents($filename);