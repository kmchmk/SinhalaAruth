<!DOCTYPE html>
<?php

$file =fopen("config.txt", "r") or die("Unable to open file!");
$path = fgets($file);
fclose($file);

$thisURL = "http://".$path."/index.php";
$requestURl = "http://".$path."/request.php";
$addURL = "http://".$path."/add.php";
?>
<html lang="en" class="gr__torrentz2_eu">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ශබ්ද කෝෂය</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/style129.css" type="text/css">
        <link rel="search" type="application/opensearchdescription+xml" href="https://torrentz2.eu/opensearch.xml" title="Torrents Search">
    </head>
    <body data-gr-c-s-loaded="true">
        <div id="wrap">
            <div id="top">
                <h1><a href=<?php echo $thisURL; ?> title="සිංහල වචන සොයන්න">සිංහල<sup>අරුත්</sup></a></h1>
                <ul>
                    <li><a href=<?php echo $addURL; ?> title="වචන ඇතුලත් කරන්න">අළුත්</a></li>
                    <li><a href="https://torrentz2.eu/help" title="Get Help">උදව්</a></li>
                </ul>
            </div>
            <form class="search" id="search">
                <fieldset>
                    <input required type="text" id="thewordbox" placeholder="Enter word here.">
                </fieldset>
                <fieldset>
                    <textarea required rows=3  type="text" id="themeaningbox" placeholder="Enter meaning here."></textarea>
                </fieldset>
                <fieldset></fieldset>
                <fieldset>
                    <textarea required rows=3 type="text" id="theexamplebox" placeholder="Enter example here."></textarea>
                </fieldset>
                <fieldset></fieldset>
                <fieldset>
                    <input type="submit" onclick="addWord()" id="themeaningbox" value="Enter">
                    <!--<input type"submit" onclick="addWord()" id="themeaningbox">Enter>-->
                </fieldset>
                <!--                <fieldset>
                                    <input type="submit" value="Enter" id="themeaningbox" onclick="addWord()">
                                </fieldset>-->
                <script>
                    function addWord() {
                        var w = document.getElementById("thewordbox").value;
                        var a = document.getElementById("themeaningbox").value;
                        var e = document.getElementById("theexamplebox").value;


                        var url = "<?php echo $requestURl; ?>" + "?m=addWord&w=" + w + "&a=" + a + "&e=" + e;
                        var xmlHttp = new XMLHttpRequest();
                        xmlHttp.open("GET", url, false);
                        xmlHttp.send();
                        var message = xmlHttp.responseText;
                        alert(message);
                    }
                </script>
            </form>


            <div id="footer">
                <br>
            </div>
        </div> 

    </body>
</html>