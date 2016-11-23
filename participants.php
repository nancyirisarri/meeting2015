<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT first_name, last_name, affiliation FROM kids_meeting2015";

$result = $conn->query($sql);
$num_rows = $result->num_rows;

if($conn->query($sql)) {
  if($num_rows <= 0) {
    echo "<h2>There are {$num_rows} people registered.</h2>";    
  } else {
    echo "<h2>List of participants</h2>
    <table style='width:60%; cellpadding: '0'; line-height: 2;'>
    <tr><td colspan='2'><hr></td></tr>";
    
    while($row = $result->fetch_assoc()) {
      echo "<tr><td style='width:40%'>{$row[first_name]} {$row[last_name]}</td>
      <td style='width:60%'>{$row[affiliation]}</td></tr>";
    }
    echo "</table>";
  }
} else {
  echo "<span style='color:red;'>Error: " . $conn->error . "</span>";
}
?>
