<html>
<body>
<?php

	$json_string = 'http://api.auto.ria.com/categories/2/marks';
	$jsondata = file_get_contents($json_string);
	$obj = json_decode($jsondata, true);
	echo "<pre>";
//print_r($obj);

	print("<form method='post' action='functions.php'>");
	print("<select name='marks' size='30'>");
	foreach ($obj as $mark) {
		print("<option>" . $mark['name'] . "_" . $mark['value'] . "</option>");
	}
	print("</select>");
	print("<input type='submit' value='click' name='submit'>");
	print("</form>");


?>
</body>
</html>
