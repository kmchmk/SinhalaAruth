<!DOCTYPE html>
<?php
$file =fopen("config.txt", "r") or die("Unable to open file!");
$path = fgets($file);
fclose($file);

$thisURL = "http://".$path."/index.php";
$requestURl = "http://".$path."/request.php";
$addURL = "http://".$path."/add.php";
$helpURL = "http://" . $path . "/help.php";
?>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Help</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style129.css" type="text/css">
        <link rel="search" type="application/opensearchdescription+xml" href="https://torrentz2.eu/opensearch.xml" title="Torrents Search">
    </head>
    <body>
        <div id="wrap">

            <div id="top">
                <h1><a href=<?php echo $thisURL; ?> title="සිංහල වචන සොයන්න">සිංහල<sup>අරුත්</sup></a></h1>
                <ul>
                    <li><a href=<?php echo $addURL; ?> title="වචන ඇතුලත් කරන්න">අළුත්</a></li>
                </ul>
            </div>
            <div class="help">
                <p><b>Android Application</b></p>
                <ol>
                    <li><b>සිංහල අරුත්</b> ශබ්දකෝෂයේ   <a href="https://www.dropbox.com/sh/6wrgdm25jqetjg9/AAC_BSQOqJhUI3ur0Eyfez8Ga?dl=0" target="_blank">android යෙදුම</a> ඔබට ලබාගත හැක.</li>
                    <li> සෑම විටම යෙදුම යාවත්කාලීන කොට තබාගන්න..</li>
                </ol>
                <p><b>වචන ඇතුලත් කිරීම</b></p>
                <ol>
                    <li>සෑමවිටම නිවැරදි වචන, අක්ෂර වින්‍යාසය සහ අර්ථය ඇතුළත් කරන්න.</li>
                    <li>වැරදි වචන ඇතුලත් කිරීමෙන් වැළකී සිටින්න.</li>
                </ol>
                
                <p><b>යෝජනා සහ චෝදනා</b></p>
                <ol>
                    <li>ඔබගේ ගැටළු අප වෙත යොමුකරන්න.</li>
                    <li>email - <a href="mailto:kmchmk@gmail.com">kmchmk@gmail.com</a></li>
                </ol>

            </div>
            <div id="footer"><br></div>

        </div>
        <!--<div class="adsbox">&nbsp;</div>-->
    </body></html>