<?php
    $jsonObj = new stdClass();
    $jsonObj->newversion = 1;
    $jsonObj->title = "යාවත්කාලීන කරන්න!";
    $jsonObj->message = "මෙම යෙදුම සඳහා නව යාවත් කාලයක් ඇත. කරුණාකර යාවත්කාලීන කරන්න.";
    $jsonObj->positivebutton = "කරන්න";
    $jsonObj->negativebutton = "Cancel";
    $jsonObj->apkurl = "https://www.dropbox.com/sh/6wrgdm25jqetjg9/AAC_BSQOqJhUI3ur0Eyfez8Ga";
    echo json_encode($jsonObj);
?>


