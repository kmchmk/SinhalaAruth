<?php

$file = fopen("config.txt", "r") or die("Unable to open file!");
$path = fgets($file);
fclose($file);

$requestURl = "http://" . $path . "/request.php";
if (isset($_GET["q"])) {
    $key = $_GET["q"];
}
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $requestURl . "?m=meaning&q=" . $key,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 2,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl);
//echo $response;
$result = json_decode($response);
//for($i = 0; $i < sizeof($result); $i+=3)
$values = new stdClass();
if (sizeof($result) > 0) {
    $values->meaning = $result[1];
    $values->example = $result[2];
    $values->up = $result[3];
    $values->down = $result[4];
} else {
    $values->meaning = "Not fount";
    $values->example = "Not fount";
    $values->up = "Not fount";
    $values->down = "Not fount";
}
$jsonObj = new stdClass();
$jsonObj->option = "str";
$jsonObj->values = $values;
$err = curl_error($curl);
curl_close($curl);
//echo $jsonObj;
echo json_encode($jsonObj);
?>