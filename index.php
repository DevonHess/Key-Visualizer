<html>
	<head>
		<title>Key Visualizer</title>
	</head>
	<body>
		<canvas id="key" style="border:1px solid #d3d3d3;"></canvas>
		<div id="make"></div>
		<div id="bitting"></div>
		<script>
var make = "<?php echo $_GET["make"] ?? 'Kwikset' ?>";
var bitting = "<?php echo $_GET["bitting"] ?? rand(9999,999999) ?>";
var w = "<?php echo $_GET["w"] ?? 1000 ?>";
var h = "<?php echo $_GET["h"] ?? 300 ?>";
var line = document.getElementById("key").getContext("2d");

document.getElementById("key").width = w;
document.getElementById("key").height = h;

document.getElementById("make").innerText = make;
document.getElementById("bitting").innerText = bitting;

line.moveTo(0,0);

for(i=0; i < bitting.length; i++) {
	line.lineTo(w/(bitting.length+1)*(i+1), (Number(bitting.charAt(i))+1)*h/11);
	console.log(bitting.charAt(i), w/(bitting.length+1)*(i+1), (Number(bitting.charAt(i))+1)*h/11);
	console.log((Number(bitting.charAt(i))+1));
	line.lineTo(w/(bitting.length+1)*(i+1.5), 0);
}

line.lineTo(w,h);
line.lineTo(0,h);
line.fillStyle = "gray";
line.fill();
		</script>
	</body>
</html>
