<!DOCTYPE html>
<html>

<head data-gwd-animation-mode="proMode">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="styles.css">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <title>KiDS Meeting 2015 Website</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

  <?php
    require("database_access.php");

    echo "<div class='div-page'>";

    include("menu-long.html");

    echo "<div class='div-page-text'>";

    if(isset($_POST['logistics'])) {
      include("logistics.html");
    } else if(isset($_POST['registration'])) {
      include("registration.html");
    } else if(isset($_POST['participants'])) {
      include("participants.php");
    } else if (isset($_POST['program'])) {
      include("program.html");          
    } else if (isset($_POST['contact'])) {
      include("contact.html");          
    } else {
      include("home.html");   
    }
    
    echo "</div></div>";
  ?>

</body>
</html>      
