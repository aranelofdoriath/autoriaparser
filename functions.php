<?php

if(isset($_POST)) {
	$list = $_POST['marks'];
	$pieces = explode("_", $list);
	session_start();
	$_SESSION['sMark'] = $pieces[0];
	$json_string = "http://api.auto.ria.com/categories/2/marks/".$pieces[1]."/models";
	$jsondata = file_get_contents($json_string);
	$obj = json_decode($jsondata, true);
	echo "<pre>";

	print("<form method='post' action='functions2.php'>");
	print("<select name='models' size='30'>");
	foreach ($obj as $model) {
		//	print($mark['name']."\t ".$mark['value']."\n");
        	print("<option>".$pieces[1]."_".$model['name']."_".$model['value']."</option>");
	}
	print("</select>");
	print("<input type='submit' value='click' name='submit'>");
	print("</form>");

}


?>
