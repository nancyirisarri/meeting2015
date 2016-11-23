<?php
require("database_access.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $conn->real_escape_string($_POST['first_name']);
$last_name = $conn->real_escape_string($_POST['last_name']);
$affiliation = $conn->real_escape_string($_POST['affiliation']);
$present_th_top = $_POST['present_th_top'];
$present_th_bottom = $_POST['present_th_bottom'];
$present_fr_top = $_POST['present_fr_top'];
$present_fr_bottom = $_POST['present_fr_bottom'];
$present_dinner = $_POST['present_dinner'];
$dietary_req = $conn->real_escape_string($_POST['dietary_req']);

echo "<span style='color:rgb(255, 255, 255); font-weight: bold; font-family: Arial;'>";

if(!(empty($first_name) || empty($last_name))) {
  $sql = "SELECT * FROM kids_meeting2015 WHERE first_name='{$first_name}' AND last_name='{$last_name}'";

  $result = $conn->query($sql);

  if($result->num_rows > 0) {
    echo "<span style='color:red;'>{$first_name} {$last_name} has been previously registered!</span>";
    break;
  }

  if(($present_th_top != 'true') && ($present_th_bottom != 'true') && ($present_fr_top != 'true') && ($present_fr_bottom != 'true')) {
    echo "<span style='color:red;'>Please make a selection under 'When will you be present?'</span>";
    break;
  }

  $th_top = 0;
  $th_bottom = 0;
  $fr_top = 0;
  $fr_bottom = 0;
  $dinner = 0;
  if($present_th_top == 'true') {
    $th_top = 1;
  }
  if($present_th_bottom == 'true') {
    $th_bottom = 1;
  }
  if($present_fr_top == 'true') {
    $fr_top = 1;
  }
  if($present_fr_bottom == 'true') {
    $fr_bottom = 1;
  }
  if($present_dinner == 'true') {
    $dinner = 1;
  }

  $sql2 = "INSERT INTO kids_meeting2015 (first_name, last_name, affiliation,
    present_th_top, present_th_bottom, present_fr_top, present_fr_bottom,
    present_dinner, dietary_req) VALUES ('{$first_name}', '{$last_name}',
    '{$affiliation}', {$th_top}, {$th_bottom}, {$fr_top}, {$fr_bottom},
    {$dinner}, '{$dietary_req}')";
  //$sql2 = $conn->prepare("INSERT INTO kids_meeting2015 (first_name, last_name, affiliation,
    //present_th_top, present_th_bottom, present_fr_top, present_fr_bottom,
    //present_dinner, dietary_req) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  //$stmt->

  if($conn->query($sql2)) {
    echo "You have been registered for the meeting!";
  } else {
    echo "Error: " . $conn->error;
    echo "{$sql2}";
  }
} else {
  echo "<span style='color:red;'>Please enter a First and Last name.</span>";
}

echo "</span>";

$conn->close();
?>

