<?php
  session_start();
  function get_user_timezone(){
    if(isset($_SESSION['user_tz_ident'])){
      $user_tz_ident = $_SESSION['user_tz_ident'];
      $user_timezone = new DateTimeZone($user_tz_ident);
    }else{
      $user_timezone = new DateTimeZone('American/New_York');
    }

    return $user_timezone;
  }

  $user_timezone = get_user_timezone();

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Time Zone Sensitivity</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="main-content">

      <h1>Time Zone Sensitivity</h1>

      <div id="current-time">
        Current Time: <span class="time">
          <?php
            $dt = new DateTime('now', $user_timezone);
            echo $dt->format('F j, g:i a T');
          ?>

        </span>
      </div>

      <div>
        <br />
        <br />
        <a href="../timezone_selection/index.php"; >Select Time Zone</a><br />
        <a href="maintenance.php"; >Maintenance</a><br />
      </div>

    </div>

  </body>
</html>
