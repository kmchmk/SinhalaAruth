<?php
    $jsonObj = new stdClass();
    $jsonObj->newversion = 3;
    $jsonObj->title = "යාවත්කාලීන කරන්න!";
    $jsonObj->message = "මෙම යෙදුම සඳහා නව යාවත් කාලයක් (1.38MB) ඇත. කරුණාකර යාවත්කාලීන කරන්න.\n* No internet message.\n* Loading icon.\n* Bugs fixed.";
    $jsonObj->positivebutton = "කරන්න";
    $jsonObj->negativebutton = "Cancel";
    $jsonObj->apkurl = "https://www.dropbox.com/sh/6wrgdm25jqetjg9/AAC_BSQOqJhUI3ur0Eyfez8Ga";
    echo json_encode($jsonObj);
?>


