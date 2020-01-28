<?php
$make = $_GET["make"] ?? 'Kwikset';
$bitting = $_GET["bitting"] ?? "0123456789";
$guide = $_GET["guide"] ?? false;
$direct = $_GET["direct"] ?? false;
$w = $_GET["w"] ?? 1000;
$h = $_GET["h"] ?? 250;

$values = array();

array_push($values, 0, 0);

for($i = 0; $i < strlen($bitting); $i++) {
	array_push($values, $w/(strlen($bitting)+1)*($i+1), (intval($bitting{$i})+1)*$h/11);
	if ($make == "Kwikset" || $make == "Weiser") {
		array_push($values, $w/(strlen($bitting)+1)*($i+1.5), (intval($bitting{$i})+1)*$h/11);
		//array_push($values, $w/(strlen($bitting)+1)*($i+1.9), (intval($bitting{$i})+1)*$h/11);
	} else {
		array_push($values, $w/(strlen($bitting)+1)*($i+1.5), 0);
	}
}

if ($make == "Kwikset" || $make == "Weiser") {
	array_push($values, $w, 0);
}
array_push($values, $w, $h);
array_push($values, 0, $h);

$image = imagecreatetruecolor($w, $h);

imagesavealpha($image, true);
imagefill($image, 0, 0, imagecolorallocatealpha($image, 0, 0, 0, 127));

imagefilledpolygon($image, $values, count($values)/2, imagecolorallocate($image, 100, 100, 100));

if ($guide) {
	for($i = 1; $i <= 10; $i++) {
		imageline($image, 0, $i*$h/11, $w , $i*$h/11, imagecolorallocate($image, 0, 0, 0));
		imageline($image, 0, $i*$h/11, $w , $i*$h/11, imagecolorallocate($image, 0, 0, 0));
	}
}

$file = 'Key.png';
imagepng($image, $file);

if ($direct) {
	header('Location: ' . $file);
} else {
	echo '<html><header><title>Key Visualizer - ' . $make . ' ' . $bitting . '</title></header><body>
		<img src="' . $file . '">
		<div>' . $make . ' ' . $bitting . '</div>
	</body></html>';
}
?>
