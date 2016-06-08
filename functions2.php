<?php
function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
	' ' => '-',
    );
    return strtr($string, $converter);
}

if(isset($_POST)) {
        $list = $_POST['models'];
        $pieces = explode("_", $list);
	$mark = rus2translit($pieces[0]);
	$model = rus2translit($pieces[2]);
	$sModel = rus2translit($pieces[1]);
	session_start();
	$sMark = rus2translit($_SESSION['sMark']);
	print($sMark." ".$sModel."<BR>");
	$json_string = "http://api.auto.ria.com/average?marka_id=".$mark."&model_id=".$model."&custom=0";
        $jsondata = file_get_contents($json_string);
        $obj = json_decode($jsondata, true);
//print_r($obj);
	print("Total bikes: ".$obj['total']."<BR>");
	print("Average: ".$obj['arithmeticMean']."<BR>");
	print("Prices: <BR>");
	$i=0;
	foreach ($obj['prices'] as $price) {
		$link = "http://auto.ria.com/auto_".$sMark."_".$sModel;
//		print $link;
		print($price." <A HREF=http://auto.ria.com/auto_".$sMark."_".$sModel."_".$obj['classifieds'][$i].".html>"."Link</A><BR>");
		$i++;
	}

}


?>
