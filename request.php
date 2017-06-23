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
$file =fopen("servername.txt", "r") or die("Unable to open file!");
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
    $sql = "SELECT meaning,example FROM meaning inner join word on word.id = meaning.wordid where word = '$key'";
    $result = $conn->query($sql);
//$numRows = mysqli_num_rows($result);

    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r['meaning'];
        $rows[] = $r['example'];
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
    
//    'INSERT INTO `tags` (`tag`) VALUES ('myvalue1')
//  ON DUPLICATE KEY UPDATE id=LAST_INSERT_ID(id), `tag`='myvalue1';
//SELECT LAST_INSERT_ID();'
//    
    
    $sqlword = "insert into word (word,time) values ('$word', NOW()) ON DUPLICATE KEY UPDATE id = LAST_INSERT_ID(id)";
    if ($conn->query($sqlword) === TRUE) {
        $wordid = $conn->insert_id;
        $sqlmeaning = "insert into meaning (wordid, meaning, example, time) values ('$wordid','$meaning', '$example', NOW())";
        if ($conn->query($sqlmeaning) === TRUE) {
            echo "ඔබ විසින් සාර්ථකව වචනයක් ඇතුලත් කරන ලදී.";
        } else {
            echo "Error: " . $sqlmeaning . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sqlword . "<br>" . $conn->error;
    }
}
?>

