<?php
function timezone_select_options($selected_timezone=NULL){

  $td_idents = timezone_identifiers_list();

  $output = "";

  $dt = new DateTime('now');

  foreach ($td_idents as $zone) {
    $dt->setTimezone(new DateTimeZone($zone));

    $offset = $dt->format('P');

    $output .= "<option value=\"{$zone}\"";
    if ($selected_timezone == $zone) {
      $output.= " selected";
    }
    $output.= ">";
    $output.= $zone . " (UTC/GMT {$offset})";
    $output.= "</option>";
  }
  return $output;

}

function select_options_for($assoc_array, $selected_value=NULL){

  $output = "";

  foreach ($assoc_array as $opt_value=>$label) {

    $output .= "<option value=\"{$opt_value}\"";
    if ($selected_value == $opt_value) {
      $output.= " selected";
    }
    $output.= ">";
    $output.= $label;
    $output.= "</option>";
  }
  return $output;

}

function month_select_options($selected_month=NULL){
  $months = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May",
      6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
  if(is_null($selected_month)) { $selected_month = date('n'); }
  return select_options_for($months, $selected_month);
}

function day_select_options($selected_day=NULL) {
  $range = range(1,31);
  $days = array_combine($range, $range);
  if(is_null($selected_day)) { $selected_day = date('d'); }
  return select_options_for($days, $selected_day);
}

function year_select_options($selected_year=NULL) {
  $start_year = (int) date('Y');
  //$end_year = $start_year + 5;
  $range = range($start_year-5, $start_year+5);
  $years = array_combine($range, $range);
  if(is_null($selected_year)) { $selected_year = $start_year; }
  return select_options_for($years, $selected_year);
}

function hour_option_format($hour) {
  $hour_ampm = $hour < 12 ? $hour : $hour - 12;
  if($hour_ampm == 0) { $hour_ampm = 12; }
  $ampm = $hour < 12 ? 'am' : 'pm';
  $output = str_pad($hour, 2, '0', STR_PAD_LEFT);
  $output .= " / {$hour_ampm} {$ampm}";
  return $output;
}

function hour_select_options($selected_hour=NULL) {
  $range = range(0,23);
  $labels = array_map('hour_option_format', $range);
  $hours = array_combine($range, $labels);
  if(is_null($selected_hour)) { $selected_hour = date('G'); }
  return select_options_for($hours, $selected_hour);
}

function minute_option_format($minute) {
  return str_pad($minute, 2, '0', STR_PAD_LEFT);
}

function minute_select_options($selected_minute=NULL) {
  $range = range(0,59);
  $labels = array_map('minute_option_format', $range);
  $minutes = array_combine($range, $labels);
  if(is_null($selected_minute)) { $selected_minute = date('i'); }
  return select_options_for($minutes, $selected_minute);
}


if(isset($_POST['submit'])){
  $from_month = $_POST['from_month'];
  $from_day = $_POST['from_day'];
  $from_year = $_POST['from_year'];
  $from_hour = $_POST['from_hour'];
  $from_minute = $_POST['from_minute'];

  $from_time = $from_year."/".$from_month."/".$from_day." ".$from_hour.":".$from_minute;

  $from_tz = $_POST['from_tz'];
  $to_tz = $_POST['to_tz'];

  $tz_idents = timezone_identifiers_list();
  if(in_array($from_tz, $tz_idents) && in_array($to_tz, $tz_idents)){

      $converted_time = new DateTime($from_time, new DateTimezone($from_tz));
      $converted_time->setTimezone(new DateTimezone($to_tz));
  }

}


?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Time Zone Calculator</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="main-content">

      <h1>Time Zone Calculator</h1>
  
      <form action="" method="post">
        
        <dl>
          <dt>From Time:</dt>
          <dd>
            <select name="from_month">
              <?php echo month_select_options($from_month); ?>
            </select>
            <select name="from_day">
              <?php echo day_select_options($from_day); ?>
            </select>
            <select name="from_year">
              <?php echo year_select_options($from_year); ?>
            </select>
            <select name="from_hour">
              <?php echo hour_select_options($from_hour); ?>
            </select>
            :
            <select name="from_minute">
              <?php echo minute_select_options($from_minute); ?>
            </select>
          </dd>
        </dl>
        <dl>
          <dt>From Time Zone:</dt>
          <dd>
            <select class="timezone" name="from_tz">
                <?php echo timezone_select_options($from_tz); ?>
            </select>
          </dd>
        </dl>
        <dl>
          <dt>To Time Zone:</dt>
          <dd>
            <select class="timezone" name="to_tz">
              <?php echo timezone_select_options($to_tz); ?>
            </select>
          </dd>
        </dl>

        <?php if (isset($converted_time)){ ?>
        <dl>
          <dt>Converted Time:</dt>
          <dd>

              <?php echo $converted_time->format('F j, Y \a\t g:i a'); ?>

          </dd>
        </dl>

        <?php } ?>




        <br />
        <div class="controls">
          <input type="submit" name="submit" value="Submit" />
        </div>
      </form>
  
    </div>

  </body>
</html>