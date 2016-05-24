<?php
$tz_idents = timezone_identifiers_list();
// $tz_idents = DateTimeZone::listIdentifiers();

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
        foreach($tz_idents as $zone) {
          $dt->setTimeZone(new DateTimeZone($zone));
          $time_in_tz = $dt->format('g:i a');
      ?>
        <dl>
          <dt>
            <?php echo $zone; ?>
          </dt>
          <dd>
            <?php echo $time_in_tz; ?>
          </dd>
        </dl>
      <?php } // end foreach ?>
    </div>

  </body>
</html>
