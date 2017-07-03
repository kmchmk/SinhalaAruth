<?php
//echo phpinfo();
//echo file_get_contents('http://www.maduraonline.com');
$output = "";
if (isset($_GET['w'])) {
    $word = $_GET['w'];
    $html = file_get_contents('http://www.maduraonline.com?find=' . $word);
    $DOM = new DOMDocument;
    $DOM->loadHTML($html);
    try {
//    echo "---";
        $items = $DOM->getElementsByTagName('td'); //getElementsByTagName('h1');
//echo $items->item(0)->nodeValue;
//echo $items->length;
        $arr = array();
        //echo $items->length;
        for ($i = 4; $i < $items->length - 3; $i+=3) {
            $meaning = $items->item($i)->nodeValue . $items->item($i + 1)->nodeValue; //. "</br>";
            $arr[] = $meaning;
            echo $meaning."\n";
        }
        $output = $arr;
    } catch (Exception $e) {
        $output = "error";
    }
} else {
    $output = "enter a word";
}

$json = json_encode($output);
//echo $output;
?>