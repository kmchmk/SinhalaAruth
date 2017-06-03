<!DOCTYPE html>
<?php
$thisURL = "http://localhost/SinhalaAruth/index.php";
$requestURl = "http://localhost/SinhalaAruth/request.php";
$key="";
if(isset($_GET['q'])){
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
                <h1>
                    <a href=<?php echo $thisURL;?> title="Torrents Search">සිංහල<sup>අරුත්</sup></a>
                </h1>
                <ul>
                    <li>
                        <a href="https://torrentz2.eu/search" title="Torrent Search">සියල්ල</a>
                    </li>
                    <li>
                        <a href="https://torrentz2.eu/help" title="Get Help">උදව්</a>
                    </li>
                </ul>
            </div>
            <form action=<?php echo $thisURL;?> method="get" class="search" id="search">
                <fieldset>
                    <input type="text" name="q" value="<?php echo $key;?>" id="thesearchbox" autocomplete="off" autofocus="">
                    <ul class="autocomplete" style="top: 119px; left: 84.5px; width: 909px;">
                    </ul>
                    <input type="submit" id="thesearchbutton" value="සොයන්න">
                </fieldset>
            </form>
            <div class="SemiAcceptableAds">
                <h3>තේරුම</h3>
                <div id="recent">
                    <?php
                    $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => $requestURl."?m=meaning&q=".$key,
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

                    if (sizeof($result)>0){
                        echo $result[0];
                        
                    }
                    else{
                        echo "වචනයක් ඇතුලත් කරන්න..";
                    }
                ?>
                </div>

            </div>
            <div class="SemiAcceptableAds">
                <h3>සමාන පද</h3>
                <div class="results">
                    
                    
                    <?php
                    $curl = curl_init();
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => $requestURl."?m=synonym&q=".$key,
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

                    for($i =0;$i<sizeof($result);$i++){
                        echo '<dl><dt><a href="put something">'.$result[$i].'</a></dt></dl>';
                    }
                ?>
                    
                    <p></p>
                </div>
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