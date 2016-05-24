<?php
  session_start();
  
  // If you don't have a selection form, like the one 
  // the last chapter, you can cheat by setting a value
  // manually.
  //$_SESSION['user_tz_ident'] = 'Europe/Paris';
  
  function get_user_timezone() {
    if(isset($_SESSION['user_tz_ident'])) {
      $user_tz_ident = $_SESSION['user_tz_ident'];
      $user_timezone = new DateTimeZone($user_tz_ident);
    }
    return $user_timezone;
  }

  $user_timezone = get_user_timezone();
  
  $format = 'F j, g:i a T';
  $utc_tz = new DateTimeZone('UTC');

  $utc_start = 'Dec 20 11:00pm';
  $dt_start = new DateTime($utc_start, $utc_tz);
  $dt_start->setTimezone($user_timezone);
  $start_time = $dt_start->format($format);

  $utc_end = 'Dec 21 3:00am';
  $dt_end = new DateTime($utc_end, $utc_tz);
  $dt_end->setTimezone($user_timezone);
  $end_time = $dt_end->format($format);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Notice of Upcoming Maintenance Window</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="main-content">

      <h1>Notice of Upcoming Maintenance Window</h1>

      <div>
        This website will be offline for routine maitenance from <span class="time"><?php echo $start_time; ?></span> to <span class="time"><?php echo $end_time; ?></span>.
      </div>
  
    </div>

  </body>
</html>
