<!DOCTYPE html>
<?php

$file = fopen("config.txt", "r") or die("Unable to open file!");
$path = fgets($file);
fclose($file);


$thisURL = "http://" . $path . "/index.php";
$requestURl = "http://" . $path . "/request.php";
$addURL = "http://" . $path . "/add.php";
$helpURL = "http://" . $path . "/help.php";

$word = "";
if (isset($_GET['w'])) {
    $word = $_GET['w'];
}
?>
<html lang="en" class="sinhalaaruth">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ශබ්ද කෝෂය</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/styles.css" type="text/css">
    </head>
    <body data-gr-c-s-loaded="true">
        <?php include_once("analyticstracking.php") ?>
        <div id="wrap">
            <div id="top">
                <h1><a href=<?php echo $thisURL; ?> title="සිංහල වචන සොයන්න">සිංහල<sup>අරුත්</sup></a></h1>
                <ul>
                    <li><a href=<?php echo $helpURL; ?> title="වැඩි විස්තර සඳහා">උදව්</a></li>
                </ul>
            </div>
            <?php
            include('./addForm.php');
            ?>

            <div id="footer">
                <br>
            </div>
        </div> 

    </body>
</html>