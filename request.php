<?php

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
if (isset($_GET["r"])) {//recordid
    $recordid = $_GET["r"];
}
if (isset($_GET["p"])) {//phrase
    $phrase = $_GET["p"];
}
if (isset($_GET["en"])) {//phrase
    $english = $_GET["en"];
}



$file = fopen("servername.txt", "r") or die("Unable to open file!");
$servername = fgets($file);
fclose($file);
$username = "root";
$password = "1234";
$dbname = "aruth";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($method == "meaning") {
    $sql = 'SELECT meaning.id, english, meaning, example, up, down FROM meaning inner join word on word.id = meaning.wordid where word = ? and report = 0 ORDER BY up - down DESC';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $word);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {

        if ($r['meaning'] == NULL | trim($r['meaning']) == "") {
            $r['meaning'] = "";
        }
        if ($r['example'] == NULL | trim($r['example']) == "") {
            $r['example'] = "";
        }
        if ($r['english'] == NULL | trim($r['english']) == "") {
            $r['english'] = "";
        }
//        
//        if ($r['english'] != NULL) {
//            $temp_english = $r['english'];
//        }
//        $rows['id'] = $r['id'];
//        $rows['meaning'] = $temp_meaning;
//        $rows['example'] = $temp_example;
//        $rows['up'] = $r['up'];
//        $rows['down'] = $r['down'];
//        $rows['english'] = $temp_english;

        $rows[] = $r;
    }

    $json = json_encode($rows);
    echo $json;

    if (sizeof($rows) == 0) {
        $sqlword = "insert into word (word,time) values (?, NOW())";
        $stmt = $conn->prepare($sqlword);
        $stmt->bind_param('s', $word);
        $stmt->execute();
    }





//while ($row = $result->fetch_assoc()) {
    // do something with $row
//}
}

//if ($method == "synonym") {
//    $sql = "SELECT word from (SELECT s1.word FROM synonym s1, synonym s2  where s2.word = '$word' and s2.id = s1.id) s3 where s3.word != '$word'";
//    $stmt = $conn->prepare($sql);
//    $stmt->bind_param('s', $word);
//    $stmt->execute();
//    $result = $stmt->get_result();
//
//    $rows = array();
//    while ($r = mysqli_fetch_assoc($result)) {
//        $rows[] = $r['word'];
//    }
//
//    $json = json_encode($rows);
//    echo $json;
//}


if ($method == "addWord") {
    $sqlword = "insert into word (word,time) values (?, NOW()) ON DUPLICATE KEY UPDATE id = LAST_INSERT_ID(id)";
    $stmt = $conn->prepare($sqlword);
    $stmt->bind_param('s', $word);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $wordid = $conn->insert_id;
        $sqlmeaning = "insert into meaning (wordid, english, meaning, example, time) values (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sqlmeaning);
        $stmt->bind_param('isss', $wordid, $english, $meaning, $example);
        if ($stmt->execute()) {
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
    try {
        $sql = "update meaning set report = 1 where id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $recordid);
        $stmt->execute();

        echo 'ඔබගේ වාර්තාව ලබාදෙන ලදී.';
    } catch (Exception $e) {
        echo "error";
        //echo "Error: " . $sqlword . "<br>" . $conn->error;
    }
}

if ($method == "voteup") {
    try {
        if ($_GET["s"] == "plus") {
            $sql = "update meaning set up = up + 1 where id = ?";
        } else if ($_GET["s"] == "minus") {
            $sql = "update meaning set up = up - 1 where id = ?";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $recordid);

        $stmt->execute();
        echo 'ස්තුතියි!';
    } catch (Exception $e) {
        echo "error";
        //echo "Error: " . $sqlword . "<br>" . $conn->error;
    }
}
if ($method == "votedown") {
    try {
        if ($_GET["s"] == "plus") {
            $sql = "update meaning set down = down + 1 where id = ?";
        } else if ($_GET["s"] == "minus") {
            $sql = "update meaning set down = down - 1 where id = ?";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $recordid);

        $stmt->execute();
        echo 'ස්තූතියි!';
    } catch (Exception $e) {
        echo "error";
        //echo "Error: " . $sqlword . "<br>" . $conn->error;
    }
}

if ($method == "suggestions") {
    $phrase = $phrase . "%";
    $sql = 'SELECT DISTINCT word FROM word inner join meaning on word.id = meaning.wordid where word like ? and report = 0 ORDER BY word ASC LIMIT 5';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $phrase);
    $stmt->execute();
    $result = $stmt->get_result();

    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r['word'];
    }

    $json = json_encode($rows);
    echo $json;
}

// if ($method == "meaningNotFound") {
//     $sql = 'SELECT * FROM aruth.word left outer join aruth.meaning on word.id = meaning.wordid order by word.id desc limit 10';
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     $rows = array();
//     while ($r = mysqli_fetch_assoc($result)) {
//         $rows[] = $r;
//     }
//     $json = json_encode($rows);
//     echo $json;

// }

?>

