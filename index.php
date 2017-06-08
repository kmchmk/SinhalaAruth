<!DOCTYPE html>
<?php
$file = fopen("config.txt", "r") or die("Unable to open file!");
$path = fgets($file);
fclose($file);


$thisURL = "http://" . $path . "/index.php";
$requestURl = "http://" . $path . "/request.php";
$addURL = "http://" . $path . "/add.php";
$key = "";
if (isset($_GET['q'])) {
    $key = $_GET['q'];
}
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
            <form action=<?php echo $thisURL; ?> method="get" class="search" id="search">
                <fieldset>
                    <input required type="search" name="q" value="<?php echo $key; ?>" id="thesearchbox" placeholder="වචනයක් ඇතුලත් කරන්න.">
                    <input type="submit" id="thesearchbutton" value="සොයන්න">
                </fieldset>
            </form>


            <?php
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $requestURl . "?m=meaning&q=" . $key,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            $result = json_decode($response);
            $err = curl_error($curl);
            curl_close($curl);

            if (sizeof($result) > 0) {
                echo '<div class="SemiAcceptableAds"><h3>තේරුම</h3><div id="recent">';
                echo $result[0];
                echo '</div></div>';
                echo '<div class="SemiAcceptableAds"><h3>උදාහරණ</h3><div id="recent">';
                echo $result[1];
                echo '</div></div>';
            }
            ?>

            <div class="SemiAcceptableAds">



                <?php
//                    $curl = curl_init();
//                    curl_setopt_array($curl, array(
//                        CURLOPT_URL => $requestURl . "?m=synonym&q=" . $key,
//                        CURLOPT_RETURNTRANSFER => true,
//                        CURLOPT_ENCODING => "",
//                        CURLOPT_MAXREDIRS => 10,
//                        CURLOPT_TIMEOUT => 30,
//                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                        CURLOPT_CUSTOMREQUEST => "GET",
//                        CURLOPT_HTTPHEADER => array(
//                            "cache-control: no-cache"
//                        ),
//                    ));
//
//                    $response = curl_exec($curl);
//                    $result = json_decode($response);
//                    $err = curl_error($curl);
//                    curl_close($curl);
//echo '<h3>සමාන පද</h3>';
//                echo '<div class="results">';
//                    for ($i = 0; $i < sizeof($result); $i++) {
//                        echo '<dl><dt><a href="put something">' . $result[$i] . '</a></dt></dl>';
//                    }
//                echo '<p></p>';
//                echo '</div>';
                ?>


                <p class="generic">අරුත් යනු සිංහල වචනවල තේරුම් බලා ගතහැකි ශබ්ද කෝෂයකි.</p>
                <p class="generic">ඕනෑම සිංහල වචනයක සරල අර්ථය මෙහි විස්තර කර ඇත.</p>
                <p class="generic">
                    <a href="http://maduraonline.com/" target="_blank">සිංහල-ඉංග්‍රීසි<img  src="img/cutehamster.gif" title="Hi! search something" alt="">
                        <!--</a> | <a href="http://torrentzwealmisr.onion/">Torrentz2 Onion<span class="j z spadlock_index"></span>-->
                    </a> | <a href="http://dictionary.cambridge.org/" target="_blank">ඉංග්‍රීසි-ඉංග්‍රීසි<img  src="img/cutehamster.gif" title="Hi! search something" alt=""></a>
                </p>
                <div id="footer">
                    <br>
                </div>
            </div> 
        </div>

    </body>
</html>