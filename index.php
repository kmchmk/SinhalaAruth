<!DOCTYPE html>
<?php
$file = fopen("config.txt", "r") or die("Unable to open file!");
$path = fgets($file);
fclose($file);


$thisURL = "http://" . $path . "/index.php";
$requestURl = "http://" . $path . "/request.php";
$addURL = "http://" . $path . "/add.php";
$helpURL = "http://" . $path . "/help.php";
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
                    <li><a href=<?php echo $helpURL; ?> title="වැඩි විස්තර සඳහා">උදව්</a></li>
                </ul>
            </div>
            
            <form action=<?php echo $thisURL; ?> method="get" class="search" id="search">
            <fieldset>
                <input type="text" id="thesinglishbox" onkeyup="convert()" placeholder="සිංහල/English">
            </fieldset>
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
            } else if($key){
	
                echo '<div class="SemiAcceptableAds">';
                echo '<p class="generic"><b>"'.$key.'"</b> යන වචනය  සඳහා තේරුම ඇතුලත් කර නොමැත. හැකිනම් ඇතුලත් කරන්න. </p>';
                echo '</div>';
	
	include('./shared/insert_form.php');
	
	}            
	else{
                echo '<div class="SemiAcceptableAds">';
                echo '<p class="generic"><b>අරුත්</b> යනු සිංහල වචනවල තේරුම් බලා ගතහැකි ශබ්දකෝෂයකි.</p>';
                echo '<p class="generic">ඕනෑම සිංහල වචනයක සරල අර්ථය මෙහි විස්තර කර ඇත.</p>';
                echo '</div>';
            }
            ?>

            <div class="SemiAcceptableAds">
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
        <script language="JavaScript" type="text/javascript">

//            function getKey(event) {
//                var charCode = event.keyCode;
//                if (charCode != 8) {
//                    var letter = String.fromCharCode(charCode);
//                    document.getElementById('hiddenbox').value += letter;
//                }
//            }
//            function backspace() {
//                if (event.keyCode == 8) {
//                    var hiddenbox = document.getElementById('hiddenbox');
//                    hiddenbox.value = hiddenbox.value.slice(0, -1);
//                }
//            }
            var text;
            var nVowels;
            var consonants = new Array()
            var consonantsUni = new Array()
            var vowels = new Array()
            var vowelsUni = new Array()
            var vowelModifiersUni = new Array()
            var specialConsonants = new Array()
            var specialConsonantsUni = new Array()
            var specialCharUni = new Array()
            var specialChar = new Array()


            vowelsUni[0] = 'ඌ';
            vowels[0] = 'oo';
            vowelModifiersUni[0] = 'ූ';
            vowelsUni[1] = 'ඕ';
            vowels[1] = 'o\\)';
            vowelModifiersUni[1] = 'ෝ';
            vowelsUni[2] = 'ඕ';
            vowels[2] = 'oe';
            vowelModifiersUni[2] = 'ෝ';
            vowelsUni[3] = 'ආ';
            vowels[3] = 'aa';
            vowelModifiersUni[3] = 'ා';
            vowelsUni[4] = 'ආ';
            vowels[4] = 'a\\)';
            vowelModifiersUni[4] = 'ා';
            vowelsUni[5] = 'ඈ';
            vowels[5] = 'Aa';
            vowelModifiersUni[5] = 'ෑ';
            vowelsUni[6] = 'ඈ';
            vowels[6] = 'A\\)';
            vowelModifiersUni[6] = 'ෑ';
            vowelsUni[7] = 'ඈ';
            vowels[7] = 'ae';
            vowelModifiersUni[7] = 'ෑ';
            vowelsUni[8] = 'ඊ';
            vowels[8] = 'ii';
            vowelModifiersUni[8] = 'ී';
            vowelsUni[9] = 'ඊ';
            vowels[9] = 'i\\)';
            vowelModifiersUni[9] = 'ී';
            vowelsUni[10] = 'ඊ';
            vowels[10] = 'ie';
            vowelModifiersUni[10] = 'ී';
            vowelsUni[11] = 'ඊ';
            vowels[11] = 'ee';
            vowelModifiersUni[11] = 'ී';
            vowelsUni[12] = 'ඒ';
            vowels[12] = 'ea';
            vowelModifiersUni[12] = 'ේ';
            vowelsUni[13] = 'ඒ';
            vowels[13] = 'e\\)';
            vowelModifiersUni[13] = 'ේ';
            vowelsUni[14] = 'ඒ';
            vowels[14] = 'ei';
            vowelModifiersUni[14] = 'ේ';
            vowelsUni[15] = 'ඌ';
            vowels[15] = 'uu';
            vowelModifiersUni[15] = 'ූ';
            vowelsUni[16] = 'ඌ';
            vowels[16] = 'u\\)';
            vowelModifiersUni[16] = 'ූ';
            vowelsUni[17] = 'ඖ';
            vowels[17] = 'au';
            vowelModifiersUni[17] = 'ෞ';
            vowelsUni[18] = 'ඇ';
            vowels[18] = '/\a';
            vowelModifiersUni[18] = 'ැ';

            vowelsUni[19] = 'අ';
            vowels[19] = 'a';
            vowelModifiersUni[19] = '';
            vowelsUni[20] = 'ඇ';
            vowels[20] = 'A';
            vowelModifiersUni[20] = 'ැ';
            vowelsUni[21] = 'ඉ';
            vowels[21] = 'i';
            vowelModifiersUni[21] = 'ි';
            vowelsUni[22] = 'එ';
            vowels[22] = 'e';
            vowelModifiersUni[22] = 'ෙ';
            vowelsUni[23] = 'උ';
            vowels[23] = 'u';
            vowelModifiersUni[23] = 'ු';
            vowelsUni[24] = 'ඔ';
            vowels[24] = 'o';
            vowelModifiersUni[24] = 'ො';
            vowelsUni[25] = 'ඓ';
            vowels[25] = 'I';
            vowelModifiersUni[25] = 'ෛ';
            nVowels = 26;

            specialConsonantsUni[0] = 'ං';
            specialConsonants[0] = /\\n/g;
            specialConsonantsUni[1] = 'ඃ';
            specialConsonants[1] = /\\h/g;
            specialConsonantsUni[2] = 'ඞ';
            specialConsonants[2] = /\\N/g;
            specialConsonantsUni[3] = 'ඍ';
            specialConsonants[3] = /\\R/g;
            //special characher Repaya
            specialConsonantsUni[4] = 'ර්' + '\u200D';
            specialConsonants[4] = /R/g;
            specialConsonantsUni[5] = 'ර්' + '\u200D';
            specialConsonants[5] = /\\r/g;

            consonantsUni[0] = 'ඬ';
            consonants[0] = 'nnd';
            consonantsUni[1] = 'ඳ';
            consonants[1] = 'nndh';
            consonantsUni[2] = 'ඟ';
            consonants[2] = 'nng';
            consonantsUni[3] = 'ථ';
            consonants[3] = 'Th';
            consonantsUni[4] = 'ධ';
            consonants[4] = 'Dh';
            consonantsUni[5] = 'ඝ';
            consonants[5] = 'gh';
            consonantsUni[6] = 'ඡ';
            consonants[6] = 'Ch';
            consonantsUni[7] = 'ඵ';
            consonants[7] = 'ph';
            consonantsUni[8] = 'භ';
            consonants[8] = 'bh';
            consonantsUni[9] = 'ශ';
            consonants[9] = 'sh';
            consonantsUni[10] = 'ෂ';
            consonants[10] = 'Sh';
            consonantsUni[11] = 'ඥ';
            consonants[11] = 'GN';
            consonantsUni[12] = 'ඤ';
            consonants[12] = 'KN';
            consonantsUni[13] = 'ළු';
            consonants[13] = 'Lu';
            consonantsUni[14] = 'ද';
            consonants[14] = 'dh';
            consonantsUni[15] = 'ච';
            consonants[15] = 'ch';
            consonantsUni[16] = 'ඛ';
            consonants[16] = 'kh';
            consonantsUni[17] = 'ත';
            consonants[17] = 'th';

            consonantsUni[18] = 'ට';
            consonants[18] = 't';
            consonantsUni[19] = 'ක';
            consonants[19] = 'k';
            consonantsUni[20] = 'ඩ';
            consonants[20] = 'd';
            consonantsUni[21] = 'න';
            consonants[21] = 'n';
            consonantsUni[22] = 'ප';
            consonants[22] = 'p';
            consonantsUni[23] = 'බ';
            consonants[23] = 'b';
            consonantsUni[24] = 'ම';
            consonants[24] = 'm';
            consonantsUni[25] = '‍ය';
            consonants[25] = '\\u005C' + 'y';
            consonantsUni[26] = '‍ය';
            consonants[26] = 'Y';
            consonantsUni[27] = 'ය';
            consonants[27] = 'y';
            consonantsUni[28] = 'ජ';
            consonants[28] = 'j';
            consonantsUni[29] = 'ල';
            consonants[29] = 'l';
            consonantsUni[30] = 'ව';
            consonants[30] = 'v';
            consonantsUni[31] = 'ව';
            consonants[31] = 'w';
            consonantsUni[32] = 'ස';
            consonants[32] = 's';
            consonantsUni[33] = 'හ';
            consonants[33] = 'h';
            consonantsUni[34] = 'ණ';
            consonants[34] = 'N';
            consonantsUni[35] = 'ළ';
            consonants[35] = 'L';
            consonantsUni[36] = 'ඛ';
            consonants[36] = 'K';
            consonantsUni[37] = 'ඝ';
            consonants[37] = 'G';
            consonantsUni[38] = 'ඨ';
            consonants[38] = 'T';
            consonantsUni[39] = 'ඪ';
            consonants[39] = 'D';
            consonantsUni[40] = 'ඵ';
            consonants[40] = 'P';
            consonantsUni[41] = 'ඹ';
            consonants[41] = 'B';
            consonantsUni[42] = 'ෆ';
            consonants[42] = 'f';
            consonantsUni[43] = 'ඣ';
            consonants[43] = 'q';
            consonantsUni[44] = 'ග';
            consonants[44] = 'g';
            //last because we need to ommit this in dealing with Rakaransha
            consonantsUni[45] = 'ර';
            consonants[45] = 'r';

            specialCharUni[0] = 'ෲ';
            specialChar[0] = 'ruu';
            specialCharUni[1] = 'ෘ';
            specialChar[1] = 'ru';
            //specialCharUni[2]='්‍ර'; specialChar[2]='ra';


            function convert() {
                var s, r, v;
                text = document.getElementById('thesinglishbox').value;
                //special consonents
                for (var i = 0; i < specialConsonants.length; i++) {
                    text = text.replace(specialConsonants[i], specialConsonantsUni[i]);
                }
                //consonents + special Chars
                for (var i = 0; i < specialCharUni.length; i++) {
                    for (var j = 0; j < consonants.length; j++) {
                        s = consonants[j] + specialChar[i];
                        v = consonantsUni[j] + specialCharUni[i];
                        r = new RegExp(s, "g");
                        text = text.replace(r, v);
                    }
                }
                //consonants + Rakaransha + vowel modifiers
                for (var j = 0; j < consonants.length; j++) {
                    for (var i = 0; i < vowels.length; i++) {
                        s = consonants[j] + "r" + vowels[i];
                        v = consonantsUni[j] + "්‍ර" + vowelModifiersUni[i];
                        r = new RegExp(s, "g");
                        text = text.replace(r, v);
                    }
                    s = consonants[j] + "r";
                    v = consonantsUni[j] + "්‍ර";
                    r = new RegExp(s, "g");
                    text = text.replace(r, v);
                }
                //consonents + vowel modifiers
                for (var i = 0; i < consonants.length; i++) {
                    for (var j = 0; j < nVowels; j++) {
                        s = consonants[i] + vowels[j];
                        v = consonantsUni[i] + vowelModifiersUni[j];
                        r = new RegExp(s, "g");
                        text = text.replace(r, v);
                    }
                }

                //consonents + HAL
                for (var i = 0; i < consonants.length; i++) {
                    r = new RegExp(consonants[i], "g");
                    text = text.replace(r, consonantsUni[i] + "්");
                }

                //vowels
                for (var i = 0; i < vowels.length; i++) {
                    r = new RegExp(vowels[i], "g");
                    text = text.replace(r, vowelsUni[i]);
                }

                document.getElementById('thesearchbox').value = text;
            }

        </script>
    </body>
</html>