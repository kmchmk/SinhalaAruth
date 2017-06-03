<?php

if (isset($_GET["q"])) {
    $key = $_GET["q"];
}
if (isset($_GET["m"])) {
    $method = $_GET["m"];
}
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "aruth";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($method == "meaning") {
    $sql = "SELECT meaning FROM meaning inner join synonym where word = '$key'";
    $result = $conn->query($sql);
//$numRows = mysqli_num_rows($result);

    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r['meaning'];
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
?>

