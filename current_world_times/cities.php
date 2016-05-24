<?php

function offset_compare($a, $b){
    if($a[1]==$b[1]){return 0;}
    if($a[1]>$b[1]){return 1;}
    if($a[1]<$b[1]){return -1;}
}
// 25 largest cities, sorted by size
$cities = array(
  'Tokyo, Japan' => 'Asia/Tokyo',
  'New York, USA' => 'America/New_York',
  'Sao Paulo, Brazil' => 'America/Sao_Paulo',
  'Seoul, South Korea' => 'Asia/Seoul',
  'Mexico City, Mexico' => 'America/Mexico_City',
  'Osaka, Japan' => 'Asia/Tokyo',
  'Manila, Philippines' => 'Asia/Manila',
  'Mumbai, India' => 'Asia/Kolkata',
  'Delhi, India' => 'Asia/Kolkata',
  'Jakarta, Indonesia' => 'Asia/Jakarta',
  'Lagos, Nigeria' => 'Africa/Lagos',
  'Kolkata, India' => 'Asia/Kolkata',
  'Cairo, Egypt' => 'Africa/Cairo',
  'Los Angeles, USA' => 'America/Los_Angeles',
  'Buenos Aires, Argentina' => 'America/Argentina/Buenos_Aires',
  'Rio de Janeiro, Brazil' => 'America/Sao_Paulo',
  'Moscow, Russia' => 'Europe/Moscow',
  'Shanghai, China' => 'Asia/Shanghai',
  'Karachi, Pakistan' => 'Asia/Karachi',
  'Paris, France' => 'Europe/Paris',
  'Istanbul, Turkey' => 'Europe/Istanbul',
  'Nagoya, Japan' => 'Asia/Tokyo',
  'Beijing, China' => 'Asia/Shanghai',
  'Chicago, USA' => 'America/Chicago',
  'London, UK' => 'Europe/London'
);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Current World Times</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="main-content">

      <h1>Current World Times</h1>

      <?php
        $dt = new DateTime('now');
        $output_array = array();
        foreach($cities as $city => $zone) {
            $this_tz = new DateTimeZone($zone);
            $dt->setTimezone($this_tz);

            $time_in_city = $dt->format('g:i a');
            $offset = $dt->format('Z');
            $output_array[$city]= array($time_in_city, $offset);
        }
        uasort($output_array, 'offset_compare');

        foreach($output_array as $city => $time_offset) {
            list($time_in_city, $offset) = $time_offset;

      ?>
        <dl>
          <dt>
            <?php echo $city; ?>
          </dt>
          <dd>
            <?php echo $time_in_city; ?>
          </dd>
        </dl>
      <?php } // end foreach ?>
    </div>

  </body>
</html>
