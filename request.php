<?php

if (isset($_GET["q"])) {
    $key = $_GET["q"];
}
if (isset($_GET["m"])) {
    $method = $_GET["m"];
}

if (isset($_GET["w"])) {//word
    $word = $_GET["w"];
}
if (isset($_GET["a"])) {//arthaya
    $meaning = $_GET["a"];
}
if (isset($_GET["e"])) {//example
    $example = $_GET["e"];
}
if (isset($_GET["r"])) {//example
    $recordid = $_GET["r"];
}
$file = fopen("servername.txt", "r") or die("Unable to open file!");
$servername = fgets($file);
fclose($file);
$username = "root";
$password = "1234";
$dbname = "aruth";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($method == "meaning") {
    $sql = "SELECT meaning.id, meaning, example, up, down FROM meaning inner join word on word.id = meaning.wordid where word = '$key' and report = 0 ORDER BY up DESC";
    $result = $conn->query($sql);
//$numRows = mysqli_num_rows($result);

    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r['id'];
        $rows[] = $r['meaning'];
        $rows[] = $r['example'];
        $rows[] = $r['up'];
        $rows[] = $r['down'];
    }

    $json = json_encode($rows);
    echo $json;
}

if ($method == "synonym") {
    $sql = "SELECT word from (SELECT s1.word FROM synonym s1, synonym s2  where s2.word = '$key' and s2.id = s1.id) s3 where s3.word != '$key'";
    $result = $conn->query($sql);
//$numRows = mysqli_num_rows($result);

    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r['word'];
    }

    $json = json_encode($rows);
    echo $json;
}
if ($method == "addWord") {
    $sqlword = "insert into word (word,time) values ('$word', NOW()) ON DUPLICATE KEY UPDATE id = LAST_INSERT_ID(id)";
    if ($conn->query($sqlword) === TRUE) {
        $wordid = $conn->insert_id;
        $sqlmeaning = "insert into meaning (wordid, meaning, example, time) values ('$wordid','$meaning', '$example', NOW())";
        if ($conn->query($sqlmeaning) === TRUE) {
            echo "ඔබ විසින් සාර්ථකව වචනයක් ඇතුලත් කරන ලදී.";
        } else {
            echo "error";
//            echo "Error: " . $sqlmeaning . "<br>" . $conn->error;
        }
    } else {
        echo "error";
//        echo "Error: " . $sqlword . "<br>" . $conn->error;
    }
}
if ($method == "reportMeaning") {
    $sqlword = "update meaning set report = 1 where id = " . $recordid . ";";
    if ($conn->query($sqlword) === TRUE) {
        echo 'ඔබගේ වාර්තාව ලබාදෙන ලදී.';
    } else {
        echo "error";
        //echo "Error: " . $sqlword . "<br>" . $conn->error;
    }
}
if ($method == "voteup") {
    if ($_GET["s"] == "plus") {
        $sqlword = "update meaning set up = up + 1 where id = " . $recordid;
    } else if ($_GET["s"] == "minus") {
        $sqlword = "update meaning set up = up - 1 where id = " . $recordid;
    }
    if ($conn->query($sqlword) === TRUE) {
        echo 'ස්තුතියි!';
    } else {
        echo "error";
        //echo "Error: " . $sqlword . "<br>" . $conn->error;
    }
}
if ($method == "votedown") {
    if ($_GET["s"] == "plus") {
        $sqlword = "update meaning set down = down + 1 where id = " . $recordid;
    } else if ($_GET["s"] == "minus") {
        $sqlword = "update meaning set down = down - 1 where id = " . $recordid;
    }
    if ($conn->query($sqlword) === TRUE) {
        echo 'ස්තූතියි!';
    } else {
        echo "error";
        //echo "Error: " . $sqlword . "<br>" . $conn->error;
    }
}
?>

